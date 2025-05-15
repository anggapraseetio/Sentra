@extends('backend.layout.admin_layout')
@section('admin')

<title>Informasi</title>

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
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ isset($informasi) ? route('informasi.update', $informasi->id_informasi) : route('informasi.store') }}" 
                              method="POST" 
                              enctype="multipart/form-data">
                            @csrf
                            @if(isset($informasi))
                                @method('PUT')
                            @endif

                            <h6>JUDUL INFORMASI</h6>
                            <div class="form-group">
                                <input type="text" 
                                       name="judul" 
                                       class="form-control input-default @error('judul') is-invalid @enderror" 
                                       placeholder="Masukkan Judul Informasi"
                                       value="{{ isset($informasi) ? $informasi->judul : old('judul') }}">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h6>DESKRIPSI INFORMASI</h6>
                            <div class="form-group">
                                <textarea name="deskripsi" 
                                          class="form-control @error('deskripsi') is-invalid @enderror" 
                                          rows="4" 
                                          placeholder="Masukkan Deskripsi Informasi">{{ isset($informasi) ? $informasi->deskripsi : old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h6>UPLOAD GAMBAR</h6>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" 
                                           name="gambar" 
                                           class="custom-file-input @error('gambar') is-invalid @enderror" 
                                           id="customFile">
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
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($informasi) ? 'Update' : 'Simpan' }} Informasi
                                </button>
                                @if(isset($informasi))
                                    <a href="{{ route('informasi.index') }}" class="btn btn-secondary ml-2">Batal</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Informasi</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($informasiList as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ Str::limit($item->deskripsi, 100) }}</td>
                                        <td>
                                            @if($item->gambar)
                                                <img src="{{ asset('uploads/informasi/' . $item->gambar) }}" 
                                                     alt="{{ $item->judul }}" 
                                                     style="max-width: 100px; max-height: 100px;">
                                            @else
                                                Tidak ada gambar
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('informasi.edit', $item->id_informasi) }}" 
                                                   class="btn btn-primary btn-sm mr-2">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('informasi.destroy', $item->id_informasi) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
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
@endpush