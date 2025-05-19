@extends('backend.layout.admin_layout')

@section('admin')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>REKAPAN</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('rekapan') }}">Rekapan</a></li>
                </ol>
            </div>
        </div>

        <!-- Filter & Export Section -->
        <div class="row mb-3">
            <div class="col-md-6 mb-2">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama/NIK Pelapor...">
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-outline-secondary" id="resetFilter">
                    <i class="fas fa-sync-alt me-1"></i> Reset Filter
                </button>
            </div>
        </div>
        <br>
        <div class="row mb-3">
            <div class="col-md-2 mb-3 mb-md-0">
                <label for="startDate" class="form-label fw-bold">Tanggal Awal</label>
                <input type="date" id="startDate" class="form-control">
            </div>
            <div class="col-md-2 mb-3 mb-md-0">
                <label for="endDate" class="form-label fw-bold">Tanggal Akhir</label>
                <input type="date" id="endDate" class="form-control">
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <label for="exportType" class="form-label fw-bold">Export Data</label>
                <form id="exportForm" method="POST" action="{{ route('rekapan.export') }}">
                    @csrf
                    <input type="hidden" name="search" id="exportSearch">
                    <input type="hidden" name="start_date" id="exportStartDate">
                    <input type="hidden" name="end_date" id="exportEndDate">
                    <input type="hidden" name="kategori" id="exportKategori">

                    <div class="d-grid gap-2"> {{-- Membuat elemen vertikal penuh --}}
                        <select name="export_type" id="exportType" class="form-select w-100 mb-2" required>
                            <option value="">-- Pilih Jenis Export --</option>
                            <option value="simple">Satu Sheet (Menyeluruh)</option>
                            <option value="multi">Multi Sheet (Per Kategori)</option>
                        </select>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-file-excel me-2"></i> Export to Excel
                        </button>
                    </div>
                </form>
            </div>

        </div>


        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-light">
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table id="rekapanTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead class="custom-font-sidebar bg-ijo">
                                    <tr>
                                        <th>ID Laporan</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>NIK Pelapor</th>
                                        <th>Nama Pelapor</th>
                                        <th>NIK Penerima</th>
                                        <th>Nama Penerima</th>
                                        <th>NIK Terlapor</th>
                                        <th>Nama Terlapor</th>
                                        <th>Nama Anak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataLaporan as $p)
                                        <tr>
                                            <td>{{ $p->id_laporan }}</td>
                                            <td>{{ $p->kategori }}</td>
                                            <td>{{ $p->status }}</td>
                                            <td>{{ optional($p->created_at)->format('Y-m-d') }}</td>

                                            <td>{{ $p->detail_pelapor->nik ?? '-' }}</td>
                                            <td>{{ $p->detail_pelapor->nama ?? '-' }}</td>

                                            <td>{{ $p->detail_penerima_manfaat->nik ?? '-' }}</td>
                                            <td>{{ $p->detail_penerima_manfaat->nama ?? '-' }}</td>

                                            <td>{{ $p->detail_terlapor->nik ?? '-' }}</td>
                                            <td>{{ $p->detail_terlapor->nama ?? '-' }}</td>

                                            <td>
                                                {{ optional($p->detail_penerima_manfaat->informasi_anak ?? collect())->pluck('nama')->implode(', ') ?:'-' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center text-warning">Data Tidak Ditemukan!</td>
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
            $(document).ready(function() {
                // Initialize DataTable
                const table = $('#rekapanTable').DataTable({
                    responsive: true,
                    paging: true,
                    dom: 'rt',
                    ordering: false,
                    info: true
                });

                // Filter pencarian di kolom ke-4 dan 5
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    const keyword = $('#searchInput').val().toLowerCase();
                    const col4 = (data[4] || '').toLowerCase(); // Kolom ke-4
                    const col5 = (data[5] || '').toLowerCase(); // Kolom ke-5

                    return col4.includes(keyword) || col5.includes(keyword);
                });

                // Trigger filter saat mengetik
                $('#searchInput').on('keyup', function() {
                    table.draw();
                });

                // Update jumlah data
                const updateCount = () => {
                    const info = table.page.info();
                    $('#dataCount').text(info.recordsDisplay);
                };
                $('#rekapanTable').on('draw.dt', updateCount);
                updateCount();

                // Reset filter
                $('#resetFilter').on('click', function() {
                    $('#searchInput').val('');
                    $('#startDate').val('');
                    $('#endDate').val('');
                    $('#kategoriFilter').val('');
                    table.search('').draw();
                });

                // Export form submission handler
                $('#exportForm').on('submit', function(e) {
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
