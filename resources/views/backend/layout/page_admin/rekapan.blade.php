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

    <!-- Filter Form -->
    <form method="GET" action="{{ route('rekapan') }}" class="bg-white shadow rounded-lg p-4 mb-6 flex flex-wrap gap-4">
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-input px-4 py-2 rounded border" placeholder="Tanggal Mulai">
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-input px-4 py-2 rounded border" placeholder="Tanggal Akhir">
        <input type="text" name="search" value="{{ request('search') }}" class="form-input px-4 py-2 rounded border" placeholder="Cari nama/NIK pelapor">
        <select name="kategori" class="form-select px-4 py-2 rounded border">
            <option value="">Semua Kategori</option>
            <option value="pelapor" {{ request('kategori') == 'pelapor' ? 'selected' : '' }}>Pelapor</option>
            <option value="terlapor" {{ request('kategori') == 'terlapor' ? 'selected' : '' }}>Terlapor</option>
            <option value="anak" {{ request('kategori') == 'anak' ? 'selected' : '' }}>Anak</option>
            <option value="penerima" {{ request('kategori') == 'penerima' ? 'selected' : '' }}>Penerima</option>
            <option value="kasus" {{ request('kategori') == 'kasus' ? 'selected' : '' }}>Kasus</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
    </form>

    <!-- Export Buttons -->
    <form method="POST" action="{{ route('rekapan.export') }}" class="flex gap-4 mb-6">
        @csrf
        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
        <input type="hidden" name="search" value="{{ request('search') }}">
        <input type="hidden" name="kategori" value="{{ request('kategori') }}">

        <button type="submit" name="export_type" value="simple" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Simple Export
        </button>
        <button type="submit" name="export_type" value="multi" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
            Multi Sheet Export
        </button>
    </form>

    <!-- Data Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 table-auto text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">NIK</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Kategori</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($dataLaporan as $laporan)
                    <tr>
                        <td class="px-4 py-2">{{ $laporan->id_laporan }}</td>
                        <td class="px-4 py-2">{{ $laporan->nama ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $laporan->nik ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $laporan->created_at ? $laporan->created_at->format('Y-m-d') : '-' }}</td>
                        <td class="px-4 py-2 capitalize">{{ $laporan->kategori }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
            $('#statusFilter').val('');
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
            $('#exportStatus').val($('#statusFilter').val());

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
