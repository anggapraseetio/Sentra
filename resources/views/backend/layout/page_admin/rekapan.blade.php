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

    <!-- Filter & Export -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-3 mb-3">
            <label for="searchInput" class="form-label fw-bold">Cari Nama/NIK</label>
            <input type="text" id="searchInput" class="form-control" placeholder="Contoh: Aulia/351817...">
        </div>
        <div class="col-md-2 mb-3">
            <label for="startDate" class="form-label fw-bold">Tanggal Awal</label>
            <input type="date" id="startDate" class="form-control">
        </div>
        <div class="col-md-2 mb-3">
            <label for="endDate" class="form-label fw-bold">Tanggal Akhir</label>
            <input type="date" id="endDate" class="form-control">
        </div>
        <div class="col-md-2 mb-3">
            <label for="kategoriFilter" class="form-label fw-bold">Kategori</label>
            <select id="kategoriFilter" class="form-select">
                <option value="">Semua Kategori</option>
                <option value="Fisik">Kekerasan Fisik</option>
                <option value="Psikis">Kekerasan Psikis</option>
            </select>
        </div>

        <!-- Export Form -->
        <div class="col-md-3">
            <label for="exportType" class="form-label fw-bold">Export Data</label>
            <form id="exportForm" action="{{ route('rekapan.export') }}" method="POST" class="d-flex gap-2">
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
                    <button type="submit" class="btn btn-success" id="exportButton">
                        <i class="fas fa-file-excel me-2"></i>Export to Excel
                    </button>
                </div>
            </form>
            <div id="exportLoading" style="display:none;" class="mt-2 text-end">
                <span class="spinner-border text-success" role="status"></span>
                <span class="ms-2">Menyiapkan file...</span>
            </div>
        </div>
    </div>

    <!-- Reset Filter -->
    <div class="row">
        <div class="col-12 text-end mb-4">
            <button type="button" class="btn btn-outline-secondary" id="resetFilter">
                <i class="fas fa-sync-alt me-1"></i> Reset Filter
            </button>
        </div>
    </div>

    <!-- Tabel Data -->
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
        const table = $('#rekapanTable').DataTable({
            responsive: true,
            paging: true,
            ordering: true,
            info: true
        });

        $('#searchInput').on('keyup', function () {
            table.search(this.value).draw();
        });

        const updateCount = () => {
            const info = table.page.info();
            $('#dataCount').text(info.recordsDisplay);
        };
        table.on('draw', updateCount);
        updateCount();

        $('#resetFilter').on('click', function () {
            $('#searchInput').val('');
            $('#startDate').val('');
            $('#endDate').val('');
            $('#kategoriFilter').val('');
            table.search('').columns().search('').draw();
        });

        $('#exportForm').on('submit', function (e) {
            const exportType = $('#exportType').val();
            if (!exportType) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Silakan pilih jenis export terlebih dahulu.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            $('#exportSearch').val($('#searchInput').val());
            $('#exportStartDate').val($('#startDate').val());
            $('#exportEndDate').val($('#endDate').val());
            $('#exportKategori').val($('#kategoriFilter').val());

            $('#exportLoading').show();
            $('#exportButton').prop('disabled', true);

            setTimeout(() => {
                $('#exportForm').off('submit').submit();
            }, 300);
        });
    });
</script>
@endpush

@endsection
