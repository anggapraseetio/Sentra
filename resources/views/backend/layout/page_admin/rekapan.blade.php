@extends('backend.layout.admin_layout')
@section('admin')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Rekapan Laporan</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Basic Datatable</h4>
                        <a href="{{ route('rekapan.export') }}" title="Download Excell">
                            <i class="fas fa-file-excel text-success fs-4"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                @push('scripts')
                                <script>
                                    $(document).ready(function() {
                                        $('#example').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: "{{ route('rekapan.data') }}", columns: [
                                                {data: 'id', name: 'id'},
                                                {data: 'kategori', name: 'kategori'},
                                                {data: 'nama', name: 'nama'},
                                                {data: 'nik', name: 'nik'},
                                                {data: 'tanggal_dibuat', name: 'tanggal_dibuat'},
                                            ]
                                        });
                                    });
                                </script>
                                <thead>
                                    <tr>
                                        <th>ID Laporan</th>
                                        <th>Kategori</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection
