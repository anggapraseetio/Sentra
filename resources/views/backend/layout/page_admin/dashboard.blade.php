@extends('backend.layout.admin_layout')
@section('admin')

    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Dashboard</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-ijo d-flex justify-content-between align-items-center">
                        <h4 class="card-title">TRACKING LAPORAN MASUK</h4>
                        <div class="form-group mb-0">
                            <select class="form-control" id="tahun-filter" onchange="updateChart()">
                                @foreach ($tahun_list as $tahun)
                                    <option value="{{ $tahun }}" {{ $tahun == $tahun_aktif ? 'selected' : '' }}>
                                        {{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="laporanAreaChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Kekerasan Fisik</div>
                            <div class="stat-digit"> <i class="fa fa-file-text-o"></i> {{ $data_kekerasan_fisik_total }}
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: {{ $persen_kekerasan_fisik }}%"
                                role="progressbar" aria-valuenow="{{ $persen_kekerasan_fisik }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Kekerasan Psikis</div>
                            <div class="stat-digit"> <i class="fa fa-file-text-o"></i> {{ $kekerasan_psikis }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary" style="width: {{ $persen_kekerasan_psikis }}%"
                                role="progressbar" aria-valuenow="{{ $persen_kekerasan_psikis }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Kekerasan Seksual</div>
                            <div class="stat-digit"> <i class="fa fa-file-text-o"></i> {{ $kekerasan_seksual }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" style="width: {{ $persen_kekerasan_seksual }}%"
                                role="progressbar" aria-valuenow="{{ $persen_kekerasan_seksual }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Penelantaran</div>
                            <div class="stat-digit"> <i class="fa fa-file-text-o"></i> {{ $penelantaran }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" style="width: {{ $persen_penelantaran }}%"
                                role="progressbar" aria-valuenow="{{ $persen_penelantaran }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Eksploitasi</div>
                            <div class="stat-digit"> <i class="fa fa-file-text-o"></i> {{ $eksploitasi }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info" style="width: {{ $persen_eksploitasi }}%"
                                role="progressbar" aria-valuenow="{{ $persen_eksploitasi }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">TPPO</div>
                            <div class="stat-digit"> <i class="fa fa-file-text-o"></i> {{ $tppo }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" style="width: {{ $persen_tppo }}%"
                                role="progressbar" aria-valuenow="{{ $persen_tppo }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Chart Area -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var myAreaChart;
        var chartData = {
            labels: {!! json_encode($bulan) !!},
            datasets: [{
                    label: 'Kekerasan Fisik',
                    data: {!! json_encode($data_kekerasan_fisik) !!},
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(40, 167, 69, 1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Kekerasan Psikis',
                    data: {!! json_encode($data_kekerasan_psikis) !!},
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(0, 123, 255, 1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Kekerasan Seksual',
                    data: {!! json_encode($data_kekerasan_seksual) !!},
                    backgroundColor: 'rgba(255, 193, 7, 0.2)',
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(255, 193, 7, 1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Penelantaran',
                    data: {!! json_encode($data_penelantaran) !!},
                    backgroundColor: 'rgba(220, 53, 69, 0.2)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(220, 53, 69, 1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Eksploitasi',
                    data: {!! json_encode($data_eksploitasi) !!},
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(153, 102, 255, 1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'TPPO',
                    data: {!! json_encode($data_tppo) !!},
                    backgroundColor: 'rgba(255, 102, 0, 0.2)',
                    borderColor: 'rgba(255, 102, 0, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(255, 102, 0, 1)',
                    tension: 0.4,
                    fill: true
                }
            ]
        };

        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('laporanAreaChart').getContext('2d');
            myAreaChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Jumlah Laporan Selesai Per Kategori - Tahun ' + {{ $tahun_aktif }}
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        },
                    },
                    scales: {
                        x: {
                            grid: {
                                display: true
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: true
                            }
                        }
                    }
                }
            });
        });

        function updateChart() {
            var tahun = document.getElementById('tahun-filter').value;
            window.location.href = "{{ route('dashboard') }}?tahun=" + tahun;
        }
    </script>
@endsection
