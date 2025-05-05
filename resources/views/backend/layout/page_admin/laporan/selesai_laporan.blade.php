@extends('backend.layout.admin_layout')
@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">LAPORAN SELESAI</h1>
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
                                                @elseif($data->status == 'selesai')
                                                    <span class="badge badge-success">SELESAI</span>
                                                @endif
                                            </td>
                                            <td>{{ $data->kategori }}</td>
                                            <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <!-- Tombol Preview -->
                                                <a href="{{ route('laporan.show', $data->id_laporan) }}"
                                                    class="btn btn-info btn-sm" title="Preview">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('laporan.destroy', $data->id_laporan) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan {{ $data->detail_pelapor->nama ?? 'Tanpa Nama' }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
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
