<!-- notifikasi_dropdown -->
<div class="dropdown-menu dropdown-menu-right p-0" style="width: 100%; max-width: 350px;">
    <div class="bg-ijo text-white text-center py-2 px-3">
        <strong>Notifikasi</strong>
        @if ($count > 0)
            <span class="badge badge-danger ml-2">{{ $count }} baru</span>
        @endif
    </div>

    <div class="notification-list" style="max-height: 300px; overflow-y: auto;">
        @forelse($notifikasi as $notif)
            @php
                $id_laporan = null;
                if (strpos($notif->judul, 'Laporan Baru') !== false) {
                    $id_laporan = intval(explode(' - ', $notif->judul)[0]);
                }
            @endphp
            <div class="media dropdown-item align-items-start py-2 px-3 border-bottom">
                <span class="success mr-2"><i class="ti-user"></i></span>
                <div class="media-body" style="width: 100%;">
                    <p class="mb-1 font-weight-bold" style="font-size: 0.9rem;">{{ $notif->judul }}</p>
                    <p class="mb-2 text-muted" style="font-size: 0.85rem;">{{ $notif->pesan }}</p>

                    <div class="d-flex justify-content-between align-items-center">
                        {{-- Hapus waktu jika tampilannya mengganggu --}}
                        {{-- <span class="text-muted small">{{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</span> --}}
                        <form method="POST"
                            action="{{ route('admin.notifikasi.terima-laporan', ['id_notif' => $notif->id_notif, 'id_laporan' => $id_laporan]) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-hijau">TERIMA</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center p-3">
                <p class="mb-0">Tidak ada notifikasi baru</p>
            </div>
        @endforelse
    </div>

    @if ($count > 0)
        <div class="text-center p-2 border-top">
            <a href="#" data-toggle="modal" data-target="#allNotificationsModal" class="small">Lihat Semua
                Notifikasi</a>
        </div>
    @endif
</div>
