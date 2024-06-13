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
                    <a href="<?php echo site_url('Karyawan/'); ?>" class="d-flex align-items-center">
                        <i class="ti-arrow-circle-left" style="font-size: 24px; color:#de4444"></i>
                        <h4 style="color:#de4444; margin-left: 10px;">Edit Data Karyawan</h4>
                    </a>
                </div>
            </div>
            <?php echo $this->session->flashdata('message'); ?>
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <?php echo form_open('Karyawan/update/' . $karyawan['id_karyawan']); ?>
                        <div class="form-group">
                            <label for="nama" class="col-form-label" style="color:#3e3c3c; font-weight:bold;">Nama
                                Karyawan<span class="required">*</span></label>
                            <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama Karyawan"
                            value="<?php echo empty(set_value('nama')) ? $karyawan['nama'] : set_value('nama'); ?>">
                                <?php echo form_error('nama', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="row transparent-bg">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="no_pekerja" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Nomor Pekerja<span
                                            class="required">*</span></label>
                                    <input class="form-control" type="text" id="no_pekerja" name="no_pekerja"
                                        placeholder="Nomor Pekerja" value="<?php echo empty(set_value('no_pekerja')) ? $karyawan['no_pekerja'] : set_value('no_pekerja'); ?>">
                                    <?php if ($this->session->flashdata('no_pekerja_message')): ?>
                                        <div class="invalid-feedback" style="display: block;">
                                            <?php echo $this->session->flashdata('no_pekerja_message'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php echo form_error('no_pekerja', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="jabatan" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Jabatan<span
                                            class="required">*</span></label>
                                    <select class="js-example-basic-single" id="jabatan" name="jabatan"
                                        style="border-radius: 15px;" data-minimum-results-for-search="Infinity">
                                        <option value="" selected disabled>Pilih Jabatan</option>
                                        <option value="Staf" <?php if ($karyawan['jabatan'] == "Staf")
                                            echo 'selected'; ?>>Staf</option>
                                        <option value="Supervisor" <?php if ($karyawan['jabatan'] == "Supervisor")
                                            echo 'selected'; ?>>Supervisor</option>
                                        <option value="Tim Manager" <?php if ($karyawan['jabatan'] == "Tim Manager")
                                            echo 'selected'; ?>>Tim Manager</option>
                                        <option value="Manager" <?php if ($karyawan['jabatan'] == "Manager")
                                            echo 'selected'; ?>>Manager</option>
                                        <option value="General Manager" <?php if ($karyawan['jabatan'] == "General Manager")
                                            echo 'selected'; ?>>General Manager</option>
                                        <option value="Direktur" <?php if ($karyawan['jabatan'] == "Direktur")
                                            echo 'selected'; ?>>Direktur</option>
                                    </select>
                                    <?php echo form_error('jabatan', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row transparent-bg">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="departemen" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Departemen<span
                                            class="required">*</span></label>
                                    <select class="js-example-basic-single" id="departemen" name="departemen"
                                        style="border-radius: 15px;" data-minimum-results-for-search="Infinity">
                                        <option value="" selected disabled>Pilih Departemen</option>
                                        <option value="HCM" <?php if ($karyawan['departemen'] == "HCM")
                                            echo 'selected'; ?>>HCM</option>
                                        <option value="ICT" <?php if ($karyawan['departemen'] == "ICT")
                                            echo 'selected'; ?>>ICT</option>
                                        <option value="Marketing" <?php if ($karyawan['departemen'] == "Marketing")
                                            echo 'selected'; ?>>Marketing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="tanggal_lahir" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">
                                        Tanggal Lahir<span class="required">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input name="tanggal_lahir" id="tanggal_lahir" value="<?php echo empty(set_value('tanggal_lahir')) ? $karyawan['tanggal_lahir'] : set_value('tanggal_lahir'); ?>"
                                            class="form-control datepicker" type="text" >
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-white icon" id="datepicker-trigger">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <?php echo form_error('tanggal_lahir', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="golongan_upah" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Golongan Upah<span
                                            class="required">*</span></label>
                                    <select class="js-example-basic-single" id="golongan_upah" name="golongan_upah"
                                        style="border-radius: 15px;" data-minimum-results-for-search="Infinity">
                                        <option value="" selected disabled>Pilih Golongan Upah</option>
                                        <option value="1" <?php if ($karyawan['golongan_upah'] == "1")
                                            echo 'selected'; ?>>1</option>
                                        <option value="2" <?php if ($karyawan['golongan_upah'] == "2")
                                            echo 'selected'; ?>>2</option>
                                        <option value="3" <?php if ($karyawan['golongan_upah'] == "3")
                                            echo 'selected'; ?>>3</option>
                                        <option value="4" <?php if ($karyawan['golongan_upah'] == "4")
                                            echo 'selected'; ?>>4</option>
                                        <option value="5" <?php if ($karyawan['golongan_upah'] == "5")
                                            echo 'selected'; ?>>5</option>
                                        <option value="6" <?php if ($karyawan['golongan_upah'] == "6")
                                            echo 'selected'; ?>>6</option>
                                    </select>
                                    <?php echo form_error('golongan_upah', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4" style="text-align:center;">
                            <a href="<?php echo site_url('Karyawan'); ?>"><button type="button"
                                    class="btn btn-secondary mb-3">Batal</button></a>
                            <button type="submit" class="btn btn-success mb-3">Simpan</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

    $(document).ready(function () {
        $('.js-example-basic-single').select2({
            templateSelection: function (data, container) {
                if (data.disabled) {
                    return $('<span style="color: #696969;">' + data.text + '</span>');
                }
                return data.text;
            }
        });

        // Fungsi untuk menonaktifkan dan mengatur nilai Departemen
        function disableDepartemen() {
            var selectedJabatan = $('#jabatan').val();
            var $departemenSelect = $('#departemen');

            // Cek jika jabatan yang dipilih adalah "Direktur" atau "General Manager"
            if (selectedJabatan === 'Direktur' || selectedJabatan === 'General Manager') {
                // Set nilai Departemen menjadi kosong
                $departemenSelect.val(null).trigger('change.select2');
                // Nonaktifkan pilihan Departemen dan set nilai null
                $departemenSelect.prop('disabled', true).attr('disabled', 'disabled');
            } else {
                // Aktifkan kembali pilihan Departemen
                $departemenSelect.prop('disabled', false).removeAttr('disabled');
            }
        }

        // Panggil fungsi saat halaman dimuat
        disableDepartemen();

        // Panggil fungsi saat jabatan berubah
        $('#jabatan').on('change', function () {
            disableDepartemen();
        });
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
            $('#tanggal_lahir').focus();
        });
    });

</script>