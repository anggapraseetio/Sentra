@extends('backend.layout.admin_layout')

@section('admin')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-dark">Rekapan Laporan</h4>
            </div>
        </div>
    </div>

    <!-- Filter & Export Section -->
    <div class="row mb-4 align-items-center">
        <!-- Filter Form -->
        <div class="col-md-3 mb-3 mb-md-0">
            <label for="searchInput" class="form-label fw-bold">Cari Nama/NIK</label>
            <input type="text" id="searchInput" class="form-control" placeholder="Contoh: Aulia/351817...">
        </div>
        <div class="col-md-2 mb-3 mb-md-0">
            <label for="startDate" class="form-label fw-bold">Tanggal Awal</label>
            <input type="date" id="startDate" class="form-control">
        </div>
        <div class="col-md-2 mb-3 mb-md-0">
            <label for="endDate" class="form-label fw-bold">Tanggal Akhir</label>
            <input type="date" id="endDate" class="form-control">
        </div>

        <!-- Export Section -->
        <div class="col-md-3 mb-3 mb-md-0 text-end">
            <label for="exportType" class="form-label fw-bold">Export Data</label>
            <form id="exportForm" method="POST" action="{{ route('rekapan.export') }}">
                @csrf
                <input type="hidden" name="search" id="exportSearch">
                <input type="hidden" name="start_date" id="exportStartDate">
                <input type="hidden" name="end_date" id="exportEndDate">
                <input type="hidden" name="kategori" id="exportKategori">

                <div class="input-group">
                    <select name="export_type" id="exportType" class="form-select" required>
                        <option value="">-- Pilih Jenis Export --</option>
                        <option value="simple">Satu Sheet (Menyeluruh)</option>
                        <option value="multi">Multi Sheet (Per Kategori)</option>
                    </select>
                    <button type="submit" class="btn btn-success ms-2">
                        <i class="fas fa-file-excel me-2"></i>Export to Excel
                    </button>
                </div>
                <div id="exportLoading" style="display:none;" class="mt-2 text-end">
                    <span class="spinner-border text-success" role="status" aria-hidden="true"></span>
                    <span class="ms-2">Menyiapkan file...</span>
                </div>
            </form>
        </div>
    </div>

    <!-- Reset Filter Button -->
    <div class="row">
        <div class="col-12 text-end mb-4">
            <button type="button" class="btn btn-outline-secondary" id="resetFilter">
                <i class="fas fa-sync-alt me-1"></i> Reset Filter
            </button>
        </div>
    </div>

    <!-- Data Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-light">
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table id="rekapanTable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID Laporan</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataLaporan as $p)
                                <tr>
                                    <td>{{ $p->id_laporan }}</td>
                                    <td>{{ $p->nik ?? '-' }}</td>
                                    <td>{{ $p->nama ?? '-' }}</td>
                                    <td>{{ $p->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $p->kategori }}</td>
                                    <td>{{ $p->status }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-warning">Data Tidak Ditemukan!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <p class="mt-3">Total Data Ditampilkan: <span id="dataCount"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        // Initialize DataTable
        const table = $('#rekapanTable').DataTable({
            responsive: true,
            paging: true,
            ordering: true,
            info: true
        });

        // Filter pencarian manual
        $('#searchInput').on('keyup', function () {
            table.search(this.value).draw();
        });

        // Update jumlah data
        const updateCount = () => {
            const info = table.page.info();
            $('#dataCount').text(info.recordsDisplay);
        };
        $('#rekapanTable').on('draw.dt', updateCount);
        updateCount();

        // Reset filter
        $('#resetFilter').on('click', function () {
            $('#searchInput').val('');
            $('#startDate').val('');
            $('#endDate').val('');
            $('#kategoriFilter').val('');
            table.search('').draw();
        });

        // Export form submission handler
        $('#exportForm').on('submit', function (e) {
            e.preventDefault();

            const exportType = $('#exportType').val();
            if (!exportType) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Silakan pilih jenis export terlebih dahulu.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Isi hidden inputs
            $('#exportSearch').val($('#searchInput').val());
            $('#exportStartDate').val($('#startDate').val());
            $('#exportEndDate').val($('#endDate').val());
            $('#exportKategori').val($('#kategoriFilter').length ? $('#kategoriFilter').val() : '');

            $('#exportLoading').show();

            setTimeout(() => {
                document.getElementById('exportForm').submit();
            }, 0);
        });
    });
</script>
@endpush

@endsection
