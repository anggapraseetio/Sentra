<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMobile;
use App\Models\User;
use App\Models\UserMobile;
use Illuminate\Http\Request;

class ChatControllerMobile extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:akun,id_akun',
            'receiver_id' => 'required|exists:akun,id_akun',
            'message' => 'required|string',
        ]);

        $chat = ChatMobile::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
        $notificationController = new NotificationControllerMobile();
        $notificationRequest = new Request([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
        $notificationResponse = $notificationController->newMessage($notificationRequest);

        return response()->json($chat, 201);
    }

    // Mengambil riwayat chat antara user dan admin
    public function getChats($userId)
    {
        try {
            $chats = ChatMobile::where('sender_id', $userId)
                ->orWhere('receiver_id', $userId)
                ->orderBy('sent_at', 'asc')
                ->get()
                ->map(function ($chat) {
                    return [
                        'id_chat' => $chat->id_chat,
                        'sender_id' => $chat->sender_id,
                        'receiver_id' => $chat->receiver_id,
                        'message' => $chat->message,
                        'sent_at' => $chat->sent_at,
                        'is_read' => $chat->is_read ? 1 : 0,
                        'is_notified' => $chat->is_notified ? 1 : 0,
                    ];
                });

            return response()->json($chats);
        } catch (\Exception $e) {
            \Log::error('Error in getChats: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch chats'], 500);
        }
    }



    // Update status pesan telah dibaca
    public function markAsRead($chatId)
    {
        $chat = ChatMobile::where('id_chat', $chatId)->firstOrFail();
        $chat->update(['is_read' => 1]);

        return response()->json($chat);
    }
    public function getConversations($userId)
    {
        $conversations = ChatMobile::where('receiver_id', $userId)
            ->groupBy('sender_id', 'receiver_id')
            ->selectRaw('MAX(id_chat) as latest_chat_id')
            ->get()
            ->map(function ($chat) use ($userId) {
                $latestChat = ChatMobile::find($chat->latest_chat_id);
                $otherUserId = $latestChat->sender_id == $userId ? $latestChat->receiver_id : $latestChat->sender_id;
                $otherUser = UserMobile::select('nama')->where('id_akun', $otherUserId)->first();
                return [
                    'user_id' => $otherUserId,
                    'name' => $otherUser->nama,
                    'last_message' => $latestChat->message,
                    'time' => $latestChat->sent_at,
                    'is_online' => false,
                ];
            });

        return response()->json($conversations);
    }

}
