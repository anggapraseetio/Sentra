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
                    <h4>LAPORAN BELUM SELESAI</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('laporan_proses') }}">Diproses</a></li>
                </ol>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" id="searchNama" class="form-control" placeholder="Cari Nama Pelapor...">
            </div>
            <div class="col-md-2">
                <select id="filterStatus" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="DITERIMA">Diterima</option>
                    <option value="DIPROSES">Diproses</option>
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
                                                @if ($data->status == 'diterima')
                                                    <span class="badge badge-info">DITERIMA</span>
                                                @elseif($data->status == 'diproses')
                                                    <span class="badge badge-warning">DIPROSES</span>
                                                @endif
                                            </td>
                                            <td>{{ $data->kategori }}</td>
                                            <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <form action="{{ route('laporan.proseskan', $data->id_laporan) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-warning btn-sm"
                                                        title="Proses">Proses</button>
                                                </form>
                                                <form action="{{ route('laporan.selesai', $data->id_laporan) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Apakah laporan {{ $data->detail_pelapor->nama ?? 'Tanpa Nama' }} sudah selesai?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-hijau btn-sm"
                                                        {{ $data->status == 'diterima' ? 'disabled title=Proses-Laporan' : '' }}>
                                                        Selesai
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
            $('#filterStatus').on('change', function() {
                table.column(2).search(this.value).draw();
            });
        });
    </script>
@endpush
