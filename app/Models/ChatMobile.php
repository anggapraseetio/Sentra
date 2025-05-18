<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMobile extends Model
{
    use HasFactory;
    protected $table = 'chats';
    protected $primaryKey = 'id_chat';

    protected $fillable = ['sender_id', 'receiver_id', 'message', 'is_read', 'is_notified'];

    public function sender()
    {
        return $this->belongsTo(UserMobile::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(UserMobile::class, 'receiver_id');
    }
}
