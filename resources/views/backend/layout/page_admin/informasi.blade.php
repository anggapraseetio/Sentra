@extends('backend.layout.admin_layout')
@section('admin')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>INFORMASI</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('informasi.index') }}">Menu</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('informasi.index') }}">Informasi</a></li>
                </ol>
            </div>
        </div>

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-custom-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form
                                action="{{ isset($informasi) ? route('informasi.update', $informasi->id_informasi) : route('informasi.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($informasi))
                                    @method('PUT')
                                @endif

                                <h5>JUDUL INFORMASI</h5>
                                <div class="form-group">
                                    <input type="text" name="judul"
                                        class="form-control input-default @error('judul') is-invalid @enderror"
                                        placeholder="Masukkan Judul Informasi"
                                        value="{{ isset($informasi) ? $informasi->judul : old('judul') }}">
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5>DESKRIPSI INFORMASI</h5>
                                <div class="form-group">
                                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4"
                                        placeholder="Masukkan Deskripsi Informasi">{{ isset($informasi) ? $informasi->deskripsi : old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5>UPLOAD GAMBAR</h5>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="gambar"
                                            class="custom-file-input @error('gambar') is-invalid @enderror" id="customFile">
                                        <label class="custom-file-label" for="customFile">
                                            {{ isset($informasi) && $informasi->gambar ? $informasi->gambar : 'Pilih gambar' }}
                                        </label>
                                        @error('gambar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tombol Simpan/Update -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-hijau">
                                        {{ isset($informasi) ? 'Update' : 'Simpan' }}
                                    </button>
                                    @if (isset($informasi))
                                        <a href="{{ route('informasi.index') }}" class="btn btn-danger ml-2">Batal</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="searchJudul" class="form-control" placeholder="Cari judul informasi...">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="InformasiTable" class="table table-striped text-center table-responsive-sm">
                                <thead class="custom-font-sidebar bg-ijo">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Informasi</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($informasiList as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ Str::limit($item->deskripsi, 100) }}</td>
                                            <td>
                                                @if ($item->gambar)
                                                    <img src="{{ asset('uploads/informasi/' . $item->gambar) }}"
                                                        alt="{{ $item->judul }}"
                                                        style="max-width: 100px; max-height: 100px;">
                                                @else
                                                    Tidak ada gambar
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('informasi.edit', $item->id_informasi) }}"
                                                    class="btn btn-warning btn-sm"> Edit
                                                </a>
                                                <form action="{{ route('informasi.destroy', $item->id_informasi) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus
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
        // Custom file input label
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        $(document).ready(function() {
            const table = $('#InformasiTable').DataTable({
                dom: 'rt',
                ordering: false,
            });

            // Search berdasarkan nama pelapor (kolom ke-1)
            $('#searchJudul').on('keyup', function() {
                table.column(1).search(this.value).draw();
            });
        });
    </script>
@endpush
