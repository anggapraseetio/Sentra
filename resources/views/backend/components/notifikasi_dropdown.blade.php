<!-- notifikasi_dropdown -->
<div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-header">
        <h6 class="text-center bg-ijo text-white px-4 py-1">Notifikasi</h6>
        @if ($count > 0)
            <span class="badge badge-danger">{{ $count }} baru</span>
        @endif
    </div>

    <div class="notification-list" style="max-height: 300px; overflow-y: auto;">
        @forelse($notifikasi as $notif)
            <div class="media dropdown-item">
                <span class="success"><i class="ti-user"></i></span>
                <div class="media-body">
                    <p><strong>{{ $notif->judul }}</strong></p>
                    <p>{{ $notif->pesan }}</p>

                    @if (strpos($notif->judul, 'Laporan Baru') !== false)
                        @php
                            $id_laporan = intval(explode(' - ', $notif->judul)[0]);
                        @endphp
                    @endif
                </div>
                <span class="notify-time">{{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</span>
                <form method="POST"
                    action="{{ route('admin.notifikasi.terima-laporan', ['id_notif' => $notif->id_notif, 'id_laporan' => $id_laporan]) }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-hijau">TERIMA</button>
                </form>
            </div>
        @empty
            <div class="text-center p-3">
                <p>Tidak ada notifikasi baru</p>
            </div>
        @endforelse
    </div>

    @if ($count > 0)
        <div class="text-center p-2 border-top">
            <!-- Ubah link menjadi trigger untuk modal -->
            <a href="#" data-toggle="modal" data-target="#allNotificationsModal" class="small">Lihat Semua
                Notifikasi</a>
        </div>
    @endif
</div>
