@extends('backend.layout.admin_layout')
@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Laporan Belum Selesai</h4>
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
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $index => $data)
                                    <tr>
                                        <th>{{ $index + 1 }}</th>
                                        <td>{{ $data->id_akun }}</td> <!-- ini nanti kita ganti jadi nama, kalau ada relasi -->
                                        <td>
                                            @if($data->status == 'dikirim')
                                                <span class="badge badge-secondary">Dikirim</span>
                                            @elseif($data->status == 'diterima')
                                                <span class="badge badge-info">Diterima</span>
                                            @elseif($data->status == 'diproses')
                                                <span class="badge badge-warning">Diproses</span>
                                            @endif
                                        </td>
                                        <td>{{ $data->kategori }}</td>
                                        <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="{{ route('laporan.edit', $data->id_laporan) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('laporan.selesai', $data->id_laporan) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm">Selesai</button>
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
