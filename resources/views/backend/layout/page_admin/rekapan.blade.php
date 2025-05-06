@extends('backend.layout.admin_layout')

@section('admin')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Rekapan Laporan</h4>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari nama/NIK...">
        </div>
        <div class="col-md-3">
            <input type="date" id="startDate" class="form-control">
        </div>
        <div class="col-md-3">
            <input type="date" id="endDate" class="form-control">
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('rekapan.export') }}" class="btn btn-success">
                <i class="fas fa-file-excel me-2"></i>Export Excel
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="rekapanTable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        var table = $('#rekapanTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('rekapan.data') }}",
                data: function (d) {
                    d.search = $('#searchInput').val();
                    d.start_date = $('#startDate').val();
                    d.end_date = $('#endDate').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nama', name: 'nama' },
                { data: 'nik', name: 'nik' },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'kategori', name: 'kategori' },
            ],
            pageLength: 10
        });

        $('#searchInput, #startDate, #endDate').on('change keyup', function () {
            table.draw();
        });
    });
</script>
@endpush

@endsection
