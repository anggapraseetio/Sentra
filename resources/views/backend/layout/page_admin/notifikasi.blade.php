<!-- Modal untuk menampilkan semua notifikasi -->
<div class="modal fade" id="allNotificationsModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Daftar Notifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="custom-font-sidebar bg-ijo">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Pesan</th>
                                <th>Waktu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $allNotifikasi = \App\Models\Notifikasi::where('id_akun', Auth::id())
                                                ->where('tipe', 'admin')
                                                ->where('status', 'terkirim')
                                                ->orderBy('created_at', 'desc')
                                                ->get();
                            @endphp
                            
                            @forelse($allNotifikasi as $index => $notif)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $notif->judul }}</td>
                                    <td>{{ $notif->pesan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($notif->created_at)->format('d M Y H:i') }}</td>
                                    <td>
                                        @if(strpos($notif->judul, 'Laporan Baru') !== false)
                                            @php
                                                $id_laporan = intval(explode(' - ', $notif->judul)[0]);
                                            @endphp
                                            <form method="POST" action="{{ route('admin.notifikasi.terima-laporan', ['id_notif' => $notif->id_notif, 'id_laporan' => $id_laporan]) }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-hijau">TERIMA</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin.notifikasi.mark-read', $notif->id_notif) }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-info">Tandai Dibaca</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada notifikasi yang belum dibaca</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div> --}}
        </div>
    </div>
</div>