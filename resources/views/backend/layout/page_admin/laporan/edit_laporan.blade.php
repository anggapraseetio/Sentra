@extends('backend.layout.admin_layout')
@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Edit Laporan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('laporan.update', $laporan->id_laporan) }}" method="POST"
                            id="step-form-horizontal" class="step-form-horizontal">
                            @csrf
                            @method('PUT')
                            <div>
                                <h4>Laporan</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <div class="form-group">
                                                <label>ID Laporan</label>
                                                <input type="text" name="id" class="form-control form-control-lg"
                                                    value="{{ $laporan->id_laporan }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <div class="form-group">
                                                <label>Kategori Laporan</label>
                                                <select name="kategori_laporan" class="form-control form-control-lg">
                                                    <option value="kdrt"
                                                        {{ $laporan->kategori_laporan == 'kdrt' ? 'selected' : '' }}>KDRT
                                                    </option>
                                                    <option value="pelecehan"
                                                        {{ $laporan->kategori_laporan == 'pelecehan' ? 'selected' : '' }}>
                                                        Pelecehan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control form-control-lg"
                                                    value="{{ $laporan->tanggal }}">
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h4>Identitas Pelapor</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>NIK Pelapor</label>
                                            <input type="text" name="pelapor[nik]" class="form-control"
                                                value="{{ optional($laporan->pelapor)->nik }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Nama Pelapor</label>
                                            <input type="text" name="pelapor[nama]" class="form-control"
                                                value="{{ optional($laporan->pelapor)->nama }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Umur Pelapor</label>
                                            <input type="number" name="pelapor[umur]" class="form-control"
                                                value="{{ optional($laporan->pelapor)->umur }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Alamat Pelapor</label>
                                            <input type="text" name="pelapor[alamat]" class="form-control"
                                                value="{{ optional($laporan->pelapor)->alamat }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Hubungan dengan Korban</label>
                                            <input type="text" name="pelapor[hubungan]" class="form-control"
                                                value="{{ optional($laporan->pelapor)->hubungan }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Nomor Telepon Pelapor</label>
                                            <input type="text" name="pelapor[telepon]" class="form-control"
                                                value="{{ optional($laporan->pelapor)->telepon }}">
                                        </div>
                                    </div>
                                </section>

                                <h4>Penerima Manfaat</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>NIK Penerima</label>
                                            <input type="text" name="penerima[nik]" class="form-control"
                                                value="{{ optional($laporan->penerimaManfaat)->nik }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="penerima[nama]" class="form-control"
                                                value="{{ optional($laporan->penerimaManfaat)->nama }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Tempat, Tanggal Lahir</label>
                                            <input type="text" name="penerima[ttl]" class="form-control"
                                                value="{{ optional($laporan->penerimaManfaat)->ttl }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Umur</label>
                                            <input type="number" name="penerima[umur]" class="form-control"
                                                value="{{ optional($laporan->penerimaManfaat)->umur }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Jenis Kelamin</label>
                                            <select name="penerima[jk]" class="form-control">
                                                <option value="Laki-Laki"
                                                    {{ optional($laporan->penerimaManfaat)->jk == 'Laki-Laki' ? 'selected' : '' }}>
                                                    Laki-Laki</option>
                                                <option value="Perempuan"
                                                    {{ optional($laporan->penerimaManfaat)->jk == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Pekerjaan</label>
                                            <input type="text" name="penerima[pekerjaan]" class="form-control"
                                                value="{{ optional($laporan->penerimaManfaat)->pekerjaan }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Agama</label>
                                            <select name="penerima[agama]" class="form-control">
                                                @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha'] as $agama)
                                                    <option value="{{ $agama }}"
                                                        {{ optional($laporan->penerimaManfaat)->agama == $agama ? 'selected' : '' }}>
                                                        {{ $agama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Pendidikan</label>
                                            <select name="penerima[pendidikan]" class="form-control">
                                                @foreach (['SD', 'SMP', 'SMA', 'Kuliah'] as $pendidikan)
                                                    <option value="{{ $pendidikan }}"
                                                        {{ optional($laporan->penerimaManfaat)->pendidikan == $pendidikan ? 'selected' : '' }}>
                                                        {{ $pendidikan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Alamat</label>
                                            <input type="text" name="penerima[alamat]" class="form-control"
                                                value="{{ optional($laporan->penerimaManfaat)->alamat }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Hubungan dengan Terlapor</label>
                                            <input type="text" name="penerima[hubungan_terlapor]" class="form-control"
                                                value="{{ optional($laporan->penerimaManfaat)->hubungan_terlapor }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Nomor Telepon</label>
                                            <input type="text" name="penerima[telepon]" class="form-control"
                                                value="{{ optional($laporan->penerimaManfaat)->telepon }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Informasi Tambahan</label>
                                            <input type="text" name="penerima[informasi_tambahan]"
                                                class="form-control"
                                                value="{{ optional($laporan->penerimaManfaat)->informasi_tambahan }}">
                                        </div>
                                    </div>
                                </section>

                                <h4>Terlapor</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>NIK Terlapor</label>
                                            <input type="text" name="terlapor[nik]" class="form-control"
                                                value="{{ optional($laporan->terlapor)->nik }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="terlapor[nama]" class="form-control"
                                                value="{{ optional($laporan->terlapor)->nama }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Umur</label>
                                            <input type="number" name="terlapor[umur]" class="form-control"
                                                value="{{ optional($laporan->terlapor)->umur }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Alamat</label>
                                            <input type="text" name="terlapor[alamat]" class="form-control"
                                                value="{{ optional($laporan->terlapor)->alamat }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Jenis Kelamin</label>
                                            <select name="terlapor[jk]" class="form-control">
                                                <option value="Laki-Laki"
                                                    {{ optional($laporan->terlapor)->jk == 'Laki-Laki' ? 'selected' : '' }}>
                                                    Laki-Laki</option>
                                                <option value="Perempuan"
                                                    {{ optional($laporan->terlapor)->jk == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Hubungan dengan Terlapor</label>
                                            <input type="text" name="terlapor[hubungan]" class="form-control"
                                                value="{{ optional($laporan->terlapor)->hubungan }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Informasi Tambahan</label>
                                            <input type="text" name="terlapor[informasi_tambahan]"
                                                class="form-control"
                                                value="{{ optional($laporan->terlapor)->informasi_tambahan }}">
                                        </div>
                                    </div>
                                </section>

                                <h4>Detail Kasus</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Tanggal Kejadian</label>
                                            <input type="date" name="kasus[tanggal]" class="form-control"
                                                value="{{ optional($laporan->detailKasus)->tanggal }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Tempat Kejadian</label>
                                            <input type="text" name="kasus[tempat]" class="form-control"
                                                value="{{ optional($laporan->detailKasus)->tempat }}">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Kronologi Kejadian</label>
                                            <textarea name="kasus[kronologi]" class="form-control" rows="5">{{ optional($laporan->detailKasus)->kronologi }}</textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Bukti</label>
                                            <input type="text" name="kasus[bukti]" class="form-control"
                                                value="{{ optional($laporan->detailKasus)->bukti }}">
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="mt-4 text-right">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
