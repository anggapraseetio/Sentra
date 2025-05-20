@extends('backend.layout.admin_layout')
@section('admin')
    @if (session('success'))
        <div class="alert alert-custom-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>LAPORAN SELESAI</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('selesai') }}">Selesai</a></li>
                </ol>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" id="searchNama" class="form-control" placeholder="Cari Nama Pelapor...">
            </div>
            <div class="col-md-2">
                <select id="filterKategori" class="form-control">
                    <option value="">Semua Kategori</option>
                    <option value="Kekerasan Fisik">Kekerasan Fisik</option>
                    <option value="Kekerasan Psikis">Kekerasan Psikis</option>
                    <option value="Kekerasan Seksual">Kekerasan Seksual</option>
                    <option value="Penelantaran">Penelantaran</option>
                    <option value="Eksploitasi">Eksploitasi</option>
                    <option value="TPPO">TPPO</option>
                    <option value="unset">Tidak Disetting</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="laporanTable" class="table table-striped text-center table-responsive-sm">
                                <thead class="custom-font-sidebar bg-ijo">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelapor</th>
                                        <th>Status</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $index => $data)
                                        <tr>
                                            <th>{{ $index + 1 }}</th>
                                            <td>{{ $data->detail_pelapor->nama ?? '-' }}</td>
                                            <td>
                                                @if ($data->status == 'selesai')
                                                    <span class="badge badge-success">SELESAI</span>
                                                @endif
                                            </td>
                                            <td>{{ $data->kategori }}</td>
                                            <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <!-- Tombol Preview -->
                                                <a href="{{ route('laporan.show', $data->id_laporan) }}"
                                                    class="btn btn-hijau btn-sm" title="Preview">
                                                    Preview
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('laporan.destroy', $data->id_laporan) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan {{ $data->detail_pelapor->nama ?? 'Tanpa Nama' }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            const table = $('#laporanTable').DataTable({
                dom: 'rt',
                ordering: false,
            });

            // Search berdasarkan nama pelapor (kolom ke-1)
            $('#searchNama').on('keyup', function() {
                table.column(1).search(this.value).draw();
            });

            // Filter berdasarkan status (kolom ke-2)
            $('#filterKategori').on('change', function() {
                table.column(3).search(this.value).draw();
            });
        });
    </script>
@endpush
