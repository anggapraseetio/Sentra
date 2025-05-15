@extends('backend.layout.admin_layout')
@section('admin')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>PRIVIEW LAPORAN</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('selesai') }}">Laporan</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('selesai') }}">Selesai</a></li>
                    <li class="breadcrumb-item active"><a href="">Priview</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header bg-ijo">
                            <h4 class="card-title">LAPORAN</h4>
                        </div>
                        <br><br>
                        <div>
                            <section>
                                <div class="row">
                                    <div class="col-lg-12 mb-10">
                                        <div class="form-group">
                                            <label class="font-weight-bold">ID Laporan</label>
                                            <p class="form-control form-control-lg">{{ $laporan->id_laporan }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-10">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kategori Laporan</label>
                                            <p class="form-control form-control-lg">
                                                {{ $laporan->kategori_laporan != 'unset' ? $laporan->kategori_laporan : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-10">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal</label>
                                            <p class="form-control form-control-lg">
                                                {{ $laporan->created_at->format('d-m-Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <br>
                            <div class="card-header bg-light">
                                <h4 class="mb-0">IDENTITAS PELAPOR</h4>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">NIK Pelapor</label>
                                            <p class="form-control">{{ optional($laporan->detail_pelapor)->nik }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Nama Pelapor</label>
                                            <p class="form-control">{{ optional($laporan->detail_pelapor)->nama }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Alamat Pelapor</label>
                                            <p class="form-control">{{ optional($laporan->detail_pelapor)->alamat }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Hubungan dengan Korban</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_pelapor)->hubungan_dengan_korban }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Nomor Telepon Pelapor</label>
                                            <p class="form-control">{{ optional($laporan->detail_pelapor)->no_telp }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h4 class="mb-0">PENERIMA MANFAAT</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">NIK Penerima Manfaat</label>
                                            <p class="form-control">{{ optional($laporan->detail_penerima_manfaat)->nik }}
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Nama</label>
                                            <p class="form-control">{{ optional($laporan->detail_penerima_manfaat)->nama }}
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Tempat Lahir</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_penerima_manfaat)->tempat_lahir }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Tanggal Lahir</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_penerima_manfaat)->tanggal_lahir }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Umur</label>
                                            <p class="form-control">{{ optional($laporan->detail_penerima_manfaat)->umur }}
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Jenis Kelamin</label>
                                            <p class="form-control">{{ optional($laporan->detail_penerima_manfaat)->jk }}
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Pekerjaan</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_penerima_manfaat)->pekerjaan }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Agama</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_penerima_manfaat)->agama }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Pendidikan</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_penerima_manfaat)->pendidikan }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Alamat</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_penerima_manfaat)->alamat }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Hubungan dengan Terlapor</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_penerima_manfaat)->hubungan_dengan_terlapor }}
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Nomor Telepon</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_penerima_manfaat)->notelp }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Informasi Tambahan</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_penerima_manfaat)->informasi_tambahan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($laporan->detail_penerima_manfaat && $laporan->detail_penerima_manfaat->informasi_anak->count() > 0)
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h4 class="mb-0">INFORMASI ANAK</h4>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($laporan->detail_penerima_manfaat->informasi_anak as $index => $anak)
                                            <div class="border rounded p-3 mb-4">
                                                <h6 class="font-weight-bold mb-3">ANAK KE-{{ $index + 1 }}</h6>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="font-weight-bold">Nama</label>
                                                        <p class="form-control">{{ $anak->nama }}</p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="font-weight-bold">Tanggal Lahir</label>
                                                        <p class="form-control">{{ $anak->tanggal_lahir }}</p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="font-weight-bold">Umur</label>
                                                        <p class="form-control">{{ $anak->umur }}</p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="font-weight-bold">Jenis Kelamin</label>
                                                        <p class="form-control">{{ $anak->jenis_kelamin }}</p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="font-weight-bold">Pendidikan</label>
                                                        <p class="form-control">{{ $anak->pendidikan }}</p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="font-weight-bold">Agama</label>
                                                        <p class="form-control">{{ $anak->agama }}</p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="font-weight-bold">Status</label>
                                                        <p class="form-control">{{ $anak->status }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h4 class="mb-0">TERLAPOR</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">NIK Terlapor</label>
                                            <p class="form-control">{{ optional($laporan->detail_terlapor)->nik }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Nama</label>
                                            <p class="form-control">{{ optional($laporan->detail_terlapor)->nama }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Umur</label>
                                            <p class="form-control">{{ optional($laporan->detail_terlapor)->umur }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Alamat</label>
                                            <p class="form-control">{{ optional($laporan->detail_terlapor)->alamat }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Jenis Kelamin</label>
                                            <p class="form-control">{{ optional($laporan->detail_terlapor)->jk }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Hubungan dengan Korban</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_terlapor)->hubungan_dengan_korban }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Informasi Tambahan</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_terlapor)->informasi_tambahan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h4 class="mb-0">DETAIL KASUS</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Tanggal Kejadian</label>
                                            <p class="form-control">{{ optional($laporan->detail_kasus)->tanggal }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="font-weight-bold">Tempat Kejadian</label>
                                            <p class="form-control">
                                                {{ optional($laporan->detail_kasus)->tempat_kejadian }}</p>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="font-weight-bold">Kronologi Kejadian</label>
                                            <div class="p-3 bg-light rounded">
                                                {!! nl2br(e(optional($laporan->detail_kasus)->kronologi)) !!}
                                            </div>
                                        </div>
                                        @if (optional($laporan->detail_kasus)->bukti)
                                            <div class="col-md-12 mb-3">
                                                <label class="font-weight-bold">Bukti</label><br>
                                                <img src="{{ asset('storage/' . $laporan->detail_kasus->bukti) }}"
                                                    alt="Bukti Kasus" class="img-fluid" style="max-width: 300px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-right">
                            <a href="{{ route('selesai') }}" class="btn btn-hijau">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
