<style>
    .opsi {
        margin-left: 3px;
        font-style: italic;
    }

    .select2-container {
        width: 100% !important;
        border-radius: 30px !important;
    }

    .select2-container--default .select2-selection--single {
        border-radius: 10px !important;
    }

    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px) !important;
        /* Sesuaikan tinggi dengan form-control */
        border: 1px solid #bdbaba !important;
        /* Warna border  */
    }

    .select2-container .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 2px) !important;
        /* Sesuaikan tinggi dengan form-control */
    }

    /*dropdown select2 */
    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: calc(2.25rem + 2px) !important;
        /* Sesuaikan line-height */
    }

    .select2-selection__rendered {
        color: #333;
        /* warna teks untuk opsi yang dipilih */
    }

    /*dropdown item */
    .select2-container .select2-results__option {
        padding: 8px 12px !important;
        /* Sesuaikan padding */
    }

    /* dropdown item terpilih */
    .select2-container .select2-results__option--highlighted {
        background-color: #6495ED !important;
        /* Warna background saat dihover */
    }

    .col-form-label {
        color: #3e3c3c;
        font-weight: bold;
    }

    .datepicker-input {
        height: 38px !important;
        border-radius: 10px 0px 0px 10px !important;
    }

    .icon {
        border-radius: 0px 10px 10px 0px !important;
    }

     /* CSS untuk datepicker */
     .datepicker.dropdown-menu {
        max-width: 300px;
        text-align: center;
    }

    .datepicker.dropdown-menu .datepicker-months table,
    .datepicker.dropdown-menu .datepicker-years table {
        width: 100%;
        table-layout: fixed;
    }

    .datepicker.dropdown-menu .datepicker-months td,
    .datepicker.dropdown-menu .datepicker-months th,
    .datepicker.dropdown-menu .datepicker-years td,
    .datepicker.dropdown-menu .datepicker-years th {
        width: 33%;
        text-align: center;
        padding: 5px;
    }

    .datepicker.dropdown-menu .datepicker-months td span,
    .datepicker.dropdown-menu .datepicker-years td span {
        display: inline-block;
        width: 100%;
    }

    .datepicker.dropdown-menu .datepicker-years td,
    .datepicker.dropdown-menu .datepicker-years th {
        width: 25%;
    }

    .datepicker.dropdown-menu .datepicker-years td span {
        display: inline-block;
        width: 100%;
    }

    .datepicker .datepicker-days .day.active,
    .datepicker .datepicker-days .day.active,
    .datepicker .datepicker-days .day:hover {
        background-color: rgba(0, 123, 255, 0.7);
        /* Warna biru dengan opacity 70% */
        color: white;
        border-radius: 15%;
    }

    .datepicker .datepicker-days .today {
        background-color: rgba(240, 173, 78, 0.7);
        /* Warna oranye dengan opacity 70% */
        color: white;
        border-radius: 15%;
    }

    .datepicker .datepicker-days .today:hover {
        background-color: rgba(236, 151, 31, 0.7);
        /* Warna oranye lebih gelap dengan opacity 70% */
    }
</style>

<div class="col-lg-6 col-ml-12 mx-auto mb-4">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center">
                    <a href="<?php echo site_url('SuratPengajuan'); ?>" class="d-flex align-items-center"
                        style="text-decoration: none; color: #de4444;">
                        <i class="ti-arrow-circle-left" style="font-size: 24px; color:#de4444"></i>
                        <h4 style="color:#de4444; margin-left: 10px;">Edit Surat Pengajuan</h4>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <?php echo form_open('SuratPengajuan/edit_surat/' . $pengajuan['id_pengajuan']); ?>
                        <div class="form-group">
                            <label for="nomor_surat" class="col-form-label">Nomor Surat</label>
                            <input class="form-control" type="text" placeholder="Nomor Surat" id="nomor_surat"
                                name="nomor_surat" value="<?php echo $nomor_surat; ?>" disabled>
                            <?php echo form_error('nomor_surat', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nama_karyawan" class="col-form-label">Nama Karyawan<span
                                    class="required">*</span></label>
                            <select class="js-example-basic-single" name="id_karyawan" id="id_karyawan">
                                <option selected disabled>Pilih Karyawan</option>
                                <?php foreach ($karyawan as $row): ?>
                                    <option value="<?php echo $row['id_karyawan']; ?>" <?php if ($pengajuan['id_karyawan'] == $row['id_karyawan'])
                                           echo 'selected'; ?>>
                                        <?php echo $row['nama']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('id_karyawan', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="row transparent-bg">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="judul_pengajuan" class="col-form-label">Judul Pengajuan<span
                                            class="required">*</span></label>
                                    <input class="form-control" type="text" name="judul_pengajuan" id="judul_pengajuan"
                                        placeholder="Judul Pengajuan"
                                        value="<?php echo empty(set_value('judul_pengajuan')) ? $pengajuan['judul_pengajuan'] : set_value('judul_pengajuan'); ?>">
                                    <?php echo form_error('judul_pengajuan', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Tujuan
                                        Pengajuan<span class="required">*</span></label>
                                    <select class="js-example-basic-single" style="border-radius: 15px;"
                                        name="jenis_pengajuan" id="jenis_pengajuan"
                                        data-minimum-results-for-search="Infinity" disabled>
                                        <option value="" selected disabled>Pilih Tujuan Pengajuan</option>
                                        <option value="Dinas Dalam Negri" <?php if ($pengajuan['jenis_pengajuan'] == "Dinas Dalam Negri")
                                            echo 'selected'; ?>>Dinas Dalam Negri</option>
                                        <option value="Dinas Luar Negri" <?php if ($pengajuan['jenis_pengajuan'] == "Dinas Luar Negri")
                                            echo 'selected'; ?>>Dinas Luar Negri</option>
                                    </select>
                                    <?php echo form_error('jenis_pengajuan', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row transparent-bg">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kota_asal" class="col-form-label">Kota
                                        Asal<span class="required">*</span></label>
                                    <input class="form-control" type="text" placeholder="Kota Asal" id="kota_asal"
                                        name="kota_asal" value="<?php echo empty(set_value('kota_asal')) ? $pengajuan['kota_asal'] : set_value('kota_asal'); ?>">
                                    <?php echo form_error('kota_asal', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6" id="dalamNegri">
                                <div class="form-group">
                                    <label for="kota_tujuan" class="col-form-label">Kota Tujuan<span
                                            class="required">*</span></label>
                                    <select class="js-example-basic-single" style="border-radius: 15px;"
                                        name="kota_tujuan" id="kota_tujuan" onchange="check()">
                                        <option selected disabled>Pilih Kota</option>
                                        <?php foreach ($kota as $row): ?>
                                            <option value="<?php echo 'Kota ' . $row['kota']; ?>" <?php if ($pengajuan['kota_tujuan'] == ('Kota ' . $row['kota']))
                                                     echo 'selected'; ?>>
                                                <?php echo 'Kota ' . $row['kota']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                        <option value="lain">Lainnya</option>
                                    </select>
                                    <?php echo form_error('kota_tujuan', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="luarNegri" style="display:none;">
                            <label class="col-form-label">Kota Tujuan Lainnya<span class="required">*</span></label>
                            <input class="form-control" type="text" placeholder="Kota Tujuan" value="<?php echo empty(set_value('kota_tujuan')) ? $pengajuan['kota_tujuan'] : set_value('kota_tujuan'); ?>">
                            <?php echo form_error('kota_tujuan', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="row transparent-bg mt-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tanggal_mulai" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">
                                        Tanggal Mulai<span class="required">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input name="tanggal_mulai" id="tanggal_mulai" class="form-control datepicker"
                                            type="text"
                                            value="<?php echo empty(set_value('tanggal_mulai')) ? $pengajuan['tanggal_mulai'] : set_value('tanggal_mulai'); ?>">
                                        <span class="input-group-text bg-white icon" id="datepicker-trigger-mulai">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <?php echo form_error('tanggal_mulai', '<div class="text-danger">', '</div>'); ?>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tanggal_kembali" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">
                                        Tanggal Kembali<span class="required">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input name="tanggal_kembali" id="tanggal_kembali"
                                            class="form-control datepicker" type="text"
                                            value="<?php echo empty(set_value('tanggal_kembali')) ? $pengajuan['tanggal_kembali'] : set_value('tanggal_kembali'); ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-white icon"
                                                id="datepicker-trigger-kembali">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <?php echo form_error('tanggal_kembali', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row transparent-bg">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Kendaraan<span class="required">*</span></label>
                                    <select class="js-example-basic-single" style="border-radius: 15px;"
                                        name="kendaraan" id="kendaraan" data-minimum-results-for-search="Infinity">
                                        <option selected disabled>Pilih Kendaraan</option>
                                        <option value="Kendaraan Pribadi" <?php if ($pengajuan['kendaraan'] == "Kendaraan Pribadi")
                                            echo 'selected'; ?>>Kendaraan Pribadi</option>
                                        <option value="Mobil" <?php if ($pengajuan['kendaraan'] == "Mobil")
                                            echo 'selected'; ?>>Mobil</option>
                                        <option value="Kereta Api" <?php if ($pengajuan['kendaraan'] == "Kereta Api")
                                            echo 'selected'; ?>>Kereta Api</option>
                                        <option value="Kapal" <?php if ($pengajuan['kendaraan'] == "Kapal")
                                            echo 'selected'; ?>>Kapal</option>
                                        <option value="Pesawat" <?php if ($pengajuan['kendaraan'] == "Pesawat")
                                            echo 'selected'; ?>>Pesawat</option>
                                    </select>
                                    <?php echo form_error('kendaraan', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="penanggung_biaya" class="col-form-label">Penanggung Biaya<span
                                            class="required">*</span></label>
                                    <input class="form-control" type="text" placeholder="Penanggung Biaya"
                                        id="penanggung_biaya" name="penanggung_biaya"
                                        value="<?php echo empty(set_value('penanggung_biaya')) ? $pengajuan['penanggung_biaya'] : set_value('penanggung_biaya'); ?>">
                                    <?php echo form_error('penanggung_biaya', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-form-label">Keterangan<span
                                    class="opsi">(opsional)</span></label>
                            <input class="form-control" type="text" placeholder="Keterangan" id="keterangan"
                                name="keterangan" value="<?php echo empty(set_value('keterangan')) ? $pengajuan['keterangan'] : set_value('keterangan'); ?>">
                        </div>
                        <div class="form-group" id="pengikutContainer">
                            <label for="pengikut" class="col-form-label">
                                Pengikut<span class="opsi">(opsional)</span>
                            </label>
                        </div>
                        <div class="col-12 mt-4" style="text-align:center;">
                            <a href="<?php echo site_url('SuratPengajuan'); ?>"><button type="button"
                                    class="btn btn-secondary mb-3">Batal</button></a>
                            <button type="submit" name="submit" class="btn btn-success mb-3">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var dalamNegri = document.getElementById('dalamNegri');
    var luarNegri = document.getElementById('luarNegri');
    var kotaTersimpan = '<?php echo $pengajuan['kota_tujuan']; ?>';

    var kotaAda = false;

    <?php foreach ($kota as $row): ?>
        if ('Kota <?php echo $row['kota']; ?>' === kotaTersimpan) {
            kotaAda = true;
        }
    <?php endforeach; ?>

    if (!kotaAda) {
        dalamNegri.querySelector('select').name = "";
        dalamNegri.querySelector('select').id = "";
        luarNegri.style.display = 'inline';
        luarNegri.querySelector('input').name = "kota_tujuan";
        luarNegri.querySelector('input').id = "kota_tujuan";
        luarNegri.querySelector('input').value = kotaTersimpan;

    } else {
        dalamNegri.style.display = 'inline';
        dalamNegri.querySelector('select').name = "kota_tujuan";
        dalamNegri.querySelector('select').name = "kota_tujuan";
        luarNegri.style.display = 'none';
        luarNegri.querySelector('input').name = "";
        luarNegri.querySelector('input').id = "";
    }

    function check() {
        var jenis = document.getElementById('kota_tujuan').value;

        if (jenis === 'lain') {
            dalamNegri.querySelector('select').name = "";
            dalamNegri.querySelector('select').id = "";
            luarNegri.style.display = 'inline';
            luarNegri.querySelector('input').name = "kota_tujuan";
            luarNegri.querySelector('input').id = "kota_tujuan";
        } else {
            dalamNegri.style.display = 'inline';
            dalamNegri.querySelector('select').name = "kota_tujuan";
            dalamNegri.querySelector('select').id = "kota_tujuan";
            luarNegri.style.display = 'none';
            luarNegri.querySelector('input').name = "";
            luarNegri.querySelector('input').id = "";
        }
    }
</script>

<script>
    var counter = 0;
    var pengikutData = <?php echo json_encode($pengikut); ?>;
    var listPengikut = <?php echo json_encode($listpengikut); ?>;

    console.log(pengikutData);
    console.log(listPengikut);

    function initSelect2(selector) {
        $(selector).select2({
            placeholder: 'Pilih Karyawan',
            templateSelection: function (data, container) {
                if (data.disabled) {
                    return $('<span style="color: #696969;">' + data.text + '</span>');
                }
                return data.text;
            }
        });
    }

    function tambahSelect() {
        counter++;
        var container = document.getElementById("pengikutContainer");
        var newDiv = document.createElement("div");
        newDiv.className = "row transparent-bg";
        newDiv.id = "kolomPengikut" + counter;

        var selectDiv = document.createElement("div");
        selectDiv.className = "col-sm-4 mb-2";
        var newSelect = document.createElement("select");
        newSelect.className = "pengikut-select";
        newSelect.style.borderRadius = "15px";
        newSelect.style.height = "40px";
        newSelect.name = "pengikut[]";
        newSelect.id = "pengikut" + counter;

        var defaultOption = document.createElement("option");
        defaultOption.text = "Pilih Karyawan";
        defaultOption.selected = true;
        defaultOption.disabled = true;

        newSelect.appendChild(defaultOption);

        listPengikut.forEach(function (pengikut) {
            var option = document.createElement("option");
            option.value = pengikut.id_karyawan;
            option.text = pengikut.nama;
            if (pengikutData[counter - 1] && pengikutData[counter - 1].id_karyawan == pengikut.id_karyawan) {
                option.selected = true;
            }
            newSelect.appendChild(option);
        });

        selectDiv.appendChild(newSelect);

        var inputDiv = document.createElement("div");
        inputDiv.className = "col-sm-5 mb-2";
        var newInput = document.createElement("input");
        newInput.className = "form-control";
        newInput.type = "text";
        newInput.placeholder = "Keterangan Pengikut";
        newInput.id = "keterangan_pengikut" + counter;
        newInput.name = "keterangan_pengikut[]";
        newInput.value = pengikutData[counter - 1] ? pengikutData[counter - 1].keterangan : '';

        inputDiv.appendChild(newInput);

        var tambahDiv = document.createElement("div");
        tambahDiv.className = "col-sm-2 mb-2";
        var newButtonTambah = document.createElement("button");
        newButtonTambah.className = "btn btn-outline-danger btn-sm";
        newButtonTambah.type = "button";
        newButtonTambah.style.marginRight = "1px";
        newButtonTambah.innerHTML = "<i class='ti-plus'></i>";
        newButtonTambah.onclick = function () { tambahSelect(); };

        var hapusDiv = document.createElement("div");
        hapusDiv.className = "col-sm-1 mb-2";
        var newButtonHapus = document.createElement("button");
        newButtonHapus.className = "btn btn-outline-danger btn-sm";
        newButtonHapus.type = "button";
        newButtonHapus.innerHTML = "<i class='ti-trash'></i>";
        newButtonHapus.onclick = function () { hapusSelect(newDiv); };

        tambahDiv.appendChild(newButtonTambah);
        hapusDiv.appendChild(newButtonHapus);

        newDiv.appendChild(selectDiv);
        newDiv.appendChild(inputDiv);
        newDiv.appendChild(hapusDiv);
        if (counter === 1) { newDiv.appendChild(tambahDiv); }

        container.appendChild(newDiv);

        // Initialize Select2 on the new select element
        initSelect2(newSelect);
    }

    function hapusSelect(element) {
        var container = document.getElementById("pengikutContainer");
        var divId = element.id;

        if (divId === "kolomPengikut1") {
            var select = element.querySelector("select");
            var input = element.querySelector("input");

            $(select).val(null).trigger('change'); // Reset Select2 value
            input.value = "";
        } else {
            element.remove();
        }
    }

    $(document).ready(function () {
        // Add initial selects based on existing data
        for (var i = 0; i < pengikutData.length; i++) {
            tambahSelect();
        }

        // Add an extra empty select if no data exists
        if (pengikutData.length === 0) {
            tambahSelect();
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
        })

        $('#datepicker-trigger').on('click', function () {
            $('#tanggal_mulai').focus();
        });
        $('#datepicker-trigger').on('click', function () {
            $('#tanggal_kembali').focus();
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2({
            templateSelection: function (data, container) {
                if (data.disabled) {
                    return $('<span style="color: #696969;">' + data.text + '</span>');
                }
                return data.text;
            }
        });
    });
</script>