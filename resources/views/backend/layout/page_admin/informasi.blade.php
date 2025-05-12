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
                    <li class="breadcrumb-item"><a href="{{ route('selesai') }}">Menu</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('selesai') }}">Informasi</a></li>
                </ol>
            </div>
        </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-6 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form>
                            <H6>JUDUL NFORMASI</H6>
                            <div class="form-group">
                                <input type="text" class="form-control input-default " placeholder="input-default">
                            </div>
                            <H6>DESKRIPSI INFORMASI</H6>
                            <div class="form-group">
                                <textarea class="form-control" rows="4" id="comment"></textarea>
                            </div>
                            <H6>UPLOAD GAMBAR</H6>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection