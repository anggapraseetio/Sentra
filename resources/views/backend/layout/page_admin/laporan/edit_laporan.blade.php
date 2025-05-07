@extends('backend.layout.admin_layout')
@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('laporan.update', $laporan->id_laporan) }}" method="POST"
                            id="step-form-horizontal" class="step-form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4 class="card-title">-DATA LAPORAN-</h4>
                            </div>
                            <br><br>
                            <div>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-12 mb-10">
                                            <div class="form-group">
                                                <label>ID Laporan</label>
                                                <input type="text" name="id" class="form-control form-control-lg"
                                                    value="{{ $laporan->id_laporan }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-10">
                                            <div class="form-group">
                                                <label>Kategori Laporan</label>
                                                <select name="kategori_laporan" class="form-control form-control-lg">
                                                    <option value="Kekerasan Fisik"
                                                        {{ $laporan->kategori_laporan == 'Kekerasan Fisik' ? 'selected' : '' }}>
                                                        Kekerasan Fisik
                                                    </option>
                                                    <option value="Kekerasan Psikis"
                                                        {{ $laporan->kategori_laporan == 'Kekerasan Psikis' ? 'selected' : '' }}>
                                                        Kekerasan Psikis
                                                    </option>
                                                    <option value="Kekerasan Seksual"
                                                        {{ $laporan->kategori_laporan == 'Kekerasan Seksual' ? 'selected' : '' }}>
                                                        Kekerasan Seksual
                                                    </option>
                                                    <option value="Penelantaran"
                                                        {{ $laporan->kategori_laporan == 'Penelantaran' ? 'selected' : '' }}>
                                                        Penelantaran
                                                    </option>
                                                    <option value="Eksploitasi"
                                                        {{ $laporan->kategori_laporan == 'Eksploitasi' ? 'selected' : '' }}>
                                                        Eksploitasi
                                                    </option>
                                                    <option value="TPPO"
                                                        {{ $laporan->kategori_laporan == 'TPPO' ? 'selected' : '' }}>
                                                        TPPO
                                                    </option>
                                                    <option value="Lainnya"
                                                        {{ $laporan->kategori_laporan == 'Lainnya' ? 'selected' : '' }}>
                                                        Lainnya
                                                    </option>
                                                    <option value="unset"
                                                        {{ $laporan->kategori_laporan == 'unset' ? 'selected' : '' }}>
                                                        -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-10">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control form-control-lg"
                                                    value="{{ $laporan->created_at->format('Y-m-d') }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <br>
                                <h4>IDENTITAS PELAPOR</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>NIK Pelapor</label>
                                            <input type="text" name="pelapor[nik]" class="form-control"
                                                value="{{ optional($laporan->detail_pelapor)->nik }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Nama Pelapor</label>
                                            <input type="text" name="pelapor[nama]" class="form-control"
                                                value="{{ optional($laporan->detail_pelapor)->nama }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Alamat Pelapor</label>
                                            <input type="text" name="pelapor[alamat]" class="form-control"
                                                value="{{ optional($laporan->detail_pelapor)->alamat }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Hubungan dengan Korban</label>
                                            <input type="text" name="pelapor[hubungan]" class="form-control"
                                                value="{{ optional($laporan->detail_pelapor)->hubungan_dengan_korban }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Nomor Telepon Pelapor</label>
                                            <input type="text" name="pelapor[telepon]" class="form-control"
                                                value="{{ optional($laporan->detail_pelapor)->no_telp }}">
                                        </div>
                                    </div>
                                </section>
                                <br>
                                <h4>PENERIMA MANFAAT</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>NIK Penerima Manfaat</label>
                                            <input type="text" name="penerima[nik]" class="form-control"
                                                value="{{ optional($laporan->detail_penerima_manfaat)->nik }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="penerima[nama]" class="form-control"
                                                value="{{ optional($laporan->detail_penerima_manfaat)->nama }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Tempat Lahir</label>
                                            <input type="text" name="penerima[ttl]" class="form-control"
                                                value="{{ optional($laporan->detail_penerima_manfaat)->tempat_lahir }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="penerima[tanggal]" class="form-control"
                                                value="{{ optional($laporan->detail_penerima_manfaat)->tanggal_lahir }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Umur</label>
                                            <input type="number" name="penerima[umur]" class="form-control"
                                                value="{{ optional($laporan->detail_penerima_manfaat)->umur }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Jenis Kelamin</label>
                                            <select name="penerima[jk]" class="form-control">
                                                <option value="Laki-laki"
                                                    {{ optional($laporan->detail_penerima_manfaat)->jk == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-Laki</option>
                                                <option value="Perempuan"
                                                    {{ optional($laporan->detail_penerima_manfaat)->jk == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Pekerjaan</label>
                                            <input type="text" name="penerima[pekerjaan]" class="form-control"
                                                value="{{ optional($laporan->detail_penerima_manfaat)->pekerjaan }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Agama</label>
                                            <select name="penerima[agama]" class="form-control">
                                                @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'lainnya'] as $agama)
                                                    <option value="{{ $agama }}"
                                                        {{ optional($laporan->detail_penerima_manfaat)->agama == $agama ? 'selected' : '' }}>
                                                        {{ $agama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Pendidikan</label>
                                            <select name="penerima[pendidikan]" class="form-control">
                                                @foreach (['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'S1', 'S2', 'S3', 'Lainnya'] as $pendidikan)
                                                    <option value="{{ $pendidikan }}"
                                                        {{ optional($laporan->detail_penerima_manfaat)->pendidikan == $pendidikan ? 'selected' : '' }}>
                                                        {{ $pendidikan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Alamat</label>
                                            <input type="text" name="penerima[alamat]" class="form-control"
                                                value="{{ optional($laporan->detail_penerima_manfaat)->alamat }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Hubungan dengan Terlapor</label>
                                            <input type="text" name="penerima[hubungan_terlapor]" class="form-control"
                                                value="{{ optional($laporan->detail_penerima_manfaat)->hubungan_dengan_terlapor }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Nomor Telepon</label>
                                            <input type="text" name="penerima[telepon]" class="form-control"
                                                value="{{ optional($laporan->detail_penerima_manfaat)->notelp }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Informasi Tambahan</label>
                                            <input type="text" name="penerima[informasi_tambahan]"
                                                class="form-control"
                                                value="{{ optional($laporan->detail_penerima_manfaat)->informasi_tambahan }}">
                                        </div>
                                    </div>
                                </section>
                                <br>

                                @if ($laporan->detail_penerima_manfaat)
                                    <h4>INFORMASI ANAK</h4>
                                    <section id="anak-wrapper">
                                        @php
                                            $informasiAnak =
                                                optional($laporan->detail_penerima_manfaat)->informasi_anak ??
                                                collect();
                                        @endphp
                                        @foreach ($laporan->detail_penerima_manfaat->informasi_anak as $index => $anak)
                                            <h6>*ANAK KE-{{ $index + 1 }}</h6>
                                            <div class="row mb-4 border rounded p-3">
                                                <div class="col-md-6 mb-3">
                                                    <label>Nama</label>
                                                    <input type="text" name="anak[{{ $index }}][nama]"
                                                        class="form-control" value="{{ $anak->nama }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Tanggal Lahir</label>
                                                    <input type="date" name="anak[{{ $index }}][tanggal]"
                                                        class="form-control" value="{{ $anak->tanggal_lahir }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Umur</label>
                                                    <input type="number" name="anak[{{ $index }}][umur]"
                                                        class="form-control" value="{{ $anak->umur }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Jenis Kelamin</label>
                                                    <select name="anak[{{ $index }}][jenis_kelamin]"
                                                        class="form-control" required>
                                                        <option value="Laki-laki"
                                                            {{ $anak->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                                            Laki-Laki</option>
                                                        <option value="Perempuan"
                                                            {{ $anak->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                            Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Pendidikan</label>
                                                    <select name="anak[{{ $index }}][pendidikan]"
                                                        class="form-control" required>
                                                        @foreach (['Tidak Sekolah', 'PAUD', 'TK', 'SD', 'SMP', 'SMA', 'Lainnya'] as $pendidikan)
                                                            <option value="{{ $pendidikan }}"
                                                                {{ $anak->pendidikan == $pendidikan ? 'selected' : '' }}>
                                                                {{ $pendidikan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Agama</label>
                                                    <select name="anak[{{ $index }}][agama]" class="form-control"
                                                        required>
                                                        @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'lainnya'] as $agama)
                                                            <option value="{{ $agama }}"
                                                                {{ $anak->agama == $agama ? 'selected' : '' }}>
                                                                {{ $agama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Status</label>
                                                    <select name="anak[{{ $index }}][status]" class="form-control"
                                                        required>
                                                        <option value="Anak Kandung"
                                                            {{ $anak->status == 'Anak Kandung' ? 'selected' : '' }}>Anak
                                                            Kandung</option>
                                                        <option value="Anak Angkat"
                                                            {{ $anak->status == 'Anak Angkat' ? 'selected' : '' }}>Anak
                                                            Angkat</option>
                                                    </select>
                                                </div>

                                                @if (isset($anak->id))
                                                    <div class="col-12">
                                                        <form action="{{ route('anak.destroy', $anak->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus anak ini?')"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm mt-2">Hapus Anak Ini</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </section>
                                @else
                                    <h4>INFORMASI ANAK</h4>
                                    <section id="anak-wrapper"></section>
                                @endif

                                <!-- Tombol tambah anak -->
                                <button type="button" class="btn btn-success btn-sm mb-3" onclick="tambahAnak()">+
                                    Tambah Anak</button>

                                <!-- Template anak baru -->
                                <template id="anak-template">
                                    <h6>*ANAK BARU</h6>
                                    <div class="row mb-4 border rounded p-3">
                                        <div class="col-md-6 mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="anak[__INDEX__][nama]" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="anak[__INDEX__][tanggal]" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Umur</label>
                                            <input type="number" name="anak[__INDEX__][umur]" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Jenis Kelamin</label>
                                            <select name="anak[__INDEX__][jenis_kelamin]" class="form-control" required>
                                                <option value="">Pilih</option>
                                                <option value="Laki-laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Pendidikan</label>
                                            <select name="anak[__INDEX__][pendidikan]" class="form-control" required>
                                                <option value="">Pilih</option>
                                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                <option value="PAUD">PAUD</option>
                                                <option value="TK">TK</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Agama</label>
                                            <select name="anak[__INDEX__][agama]" class="form-control" required>
                                                <option value="">Pilih</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                                <option value="lainnya">lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Status</label>
                                            <select name="anak[__INDEX__][status]" class="form-control" required>
                                                <option value="">Pilih</option>
                                                <option value="Anak Kandung">Anak Kandung</option>
                                                <option value="Anak Angkat">Anak Angkat</option>
                                            </select>
                                        </div>

                                        <!-- Tombol hapus form baru -->
                                        <div class="col-12">
                                            <button type="button" class="btn btn-danger btn-sm mt-2"
                                                onclick="hapusFormIni(this)">Hapus Form Ini</button>
                                        </div>
                                    </div>
                                </template>

                                @php
                                    $jumlahAnak =
                                        optional(
                                            optional($laporan->detail_penerima_manfaat)->informasi_anak,
                                        )->count() ?? 0;
                                @endphp

                                <!-- JavaScript -->
                                <script>
                                    let indexAnak = {{ $jumlahAnak }};

                                    function tambahAnak() {
                                        const template = document.getElementById('anak-template').innerHTML;
                                        const htmlBaru = template.replace(/__INDEX__/g, indexAnak);
                                        document.getElementById('anak-wrapper').insertAdjacentHTML('beforeend', htmlBaru);
                                        indexAnak++;
                                    }

                                    function hapusFormIni(button) {
                                        button.closest('.row.mb-4').remove();
                                    }

                                    function cekFormAnak() {
                                        const anakInputs = document.querySelectorAll('#anak-wrapper input, #anak-wrapper select');
                                        for (let input of anakInputs) {
                                            if (!input.checkValidity()) {
                                                alert('Semua field anak wajib diisi!');
                                                input.focus();
                                                return false;
                                            }
                                        }
                                        return true;
                                    }
                                </script>

                                <br>
                                <h4>TERLAPOR</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>NIK Terlapor</label>
                                            <input type="text" name="terlapor[nik]" class="form-control"
                                                value="{{ optional($laporan->detail_terlapor)->nik }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="terlapor[nama]" class="form-control"
                                                value="{{ optional($laporan->detail_terlapor)->nama }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Umur</label>
                                            <input type="number" name="terlapor[umur]" class="form-control"
                                                value="{{ optional($laporan->detail_terlapor)->umur }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Alamat</label>
                                            <input type="text" name="terlapor[alamat]" class="form-control"
                                                value="{{ optional($laporan->detail_terlapor)->alamat }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Jenis Kelamin</label>
                                            <select name="terlapor[jk]" class="form-control">
                                                <option value="Laki-laki"
                                                    {{ optional($laporan->detail_terlapor)->jk == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-Laki</option>
                                                <option value="Perempuan"
                                                    {{ optional($laporan->detail_terlapor)->jk == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Hubungan dengan Korban</label>
                                            <input type="text" name="terlapor[hubungan]" class="form-control"
                                                value="{{ optional($laporan->detail_terlapor)->hubungan_dengan_korban }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Informasi Tambahan</label>
                                            <input type="text" name="terlapor[informasi_tambahan]"
                                                class="form-control"
                                                value="{{ optional($laporan->detail_terlapor)->informasi_tambahan }}">
                                        </div>
                                    </div>
                                </section>
                                <br>
                                <h4>DETAIL KASUS</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Tanggal Kejadian</label>
                                            <input type="date" name="kasus[tanggal]" class="form-control"
                                                value="{{ optional($laporan->detail_kasus)->tanggal }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Tempat Kejadian</label>
                                            <input type="text" name="kasus[tempat]" class="form-control"
                                                value="{{ optional($laporan->detail_kasus)->tempat_kejadian }}">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Kronologi Kejadian</label>
                                            <textarea name="kasus[kronologi]" class="form-control" rows="5">{{ optional($laporan->detail_kasus)->kronologi }}</textarea>
                                        </div>
                                        @if (optional($laporan->detail_kasus)->bukti)
                                            <div class="col-md-12 mb-3">
                                                <label>Bukti</label><br>
                                                <img src="{{ asset('storage/' . $laporan->detail_kasus->bukti) }}"
                                                    alt="Bukti Kasus" style="max-width: 300px; height: auto;">
                                            </div>
                                        @endif
                                    </div>
                                </section>
                            </div>
                            <div class="mt-4 text-right">
                                <button type="submit" class="btn btn-hijau">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
