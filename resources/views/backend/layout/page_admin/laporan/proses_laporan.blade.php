@extends('backend.layout.admin_layout')
@section('admin')
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
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
                                                @if ($data->status == 'dikirim')
                                                    <span class="badge badge-secondary">DIKIRIM</span>
                                                @elseif($data->status == 'diterima')
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
                                                    <button type="submit" class="btn btn-warning btn-sm" title="Proses">
                                                        <i class="fas fa-cogs"></i> Proses
                                                    </button>
                                                </form>
                                                <form action="{{ route('laporan.selesai', $data->id_laporan) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Apakah laporan {{ $data->detail_pelapor->nama ?? 'Tanpa Nama' }} sudah selesai?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-hijau btn-sm">Selesai</button>
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
