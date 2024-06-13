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

    /* datepicker */
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
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="d-flex align-items-center mb-3">
                <a href="<?php echo site_url('Karyawan'); ?>" class="d-flex align-items-center text-danger">
                    <i class="ti-arrow-circle-left mr-2" style="font-size: 24px;"></i>
                    <h4 style="color:#de4444; margin-left: 10px;">Tambah Karyawan</h4>
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php echo $this->session->flashdata('message'); ?>
                    <form method="post" action="<?php echo site_url('Karyawan/create'); ?>">
                        <!-- Form untuk data karyawan -->
                        <div class="form-group">
                            <label for="nama" class="col-form-label" style="color:#3e3c3c; font-weight:bold;">Nama
                                Karyawan<span class="required">*</span></label>
                            <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama Karyawan"
                                value="<?php echo set_value('nama'); ?>">
                            <?php echo form_error('nama', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="row transparent-bg">
                            <!-- Form untuk nomor pekerja -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="no_pekerja" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">
                                        Nomor Pekerja<span class="required">*</span>
                                    </label>
                                    <input class="form-control" type="text" id="no_pekerja" name="no_pekerja"
                                        placeholder="Nomor Pekerja" value="<?php echo set_value('no_pekerja'); ?>"
                                        maxlength="8" oninput="validateInput(event)">
                                    <?php echo form_error('no_pekerja', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <!-- Form untuk jabatan -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="jabatan" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Jabatan<span
                                            class="required">*</span></label>
                                    <select class="js-example-basic-single" id="jabatan" name="jabatan"
                                        data-minimum-results-for-search="Infinity" style="border-radius: 15px;"
                                        onchange="checkDepartemenVisibility()">
                                        <option selected disabled>Pilih Jabatan</option>
                                        <option value="Staf" <?php echo set_select('jabatan', 'Staf'); ?>>Staf</option>
                                        <option value="Supervisor" <?php echo set_select('jabatan', 'Supervisor'); ?>>
                                            Supervisor</option>
                                        <option value="Tim Manager" <?php echo set_select('jabatan', 'Tim Manager'); ?>>
                                            Tim Manager</option>
                                        <option value="Manager" <?php echo set_select('jabatan', 'Manager'); ?>>Manager
                                        </option>
                                        <option value="General Manager" <?php echo set_select('jabatan', 'General Manager'); ?>>General Manager</option>
                                        <option value="Direktur" <?php echo set_select('jabatan', 'Direktur'); ?>>
                                            Direktur</option>
                                    </select>
                                    <?php echo form_error('jabatan', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row transparent-bg">
                            <!-- Form untuk departemen -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="departemen" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Departemen<span
                                            class="required">*</span></label>
                                    <select class="js-example-basic-single" id="departemen" name="departemen"
                                        style="border-radius: 15px;" data-minimum-results-for-search="Infinity">
                                        <option selected disabled>Pilih Departemen</option>
                                        <option value="HCM" <?php echo set_select('departemen', 'HCM'); ?>>HCM</option>
                                        <option value="ICT" <?php echo set_select('departemen', 'ICT'); ?>>ICT</option>
                                        <option value="Marketing" <?php echo set_select('departemen', 'Marketing'); ?>>
                                            Marketing</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Form untuk tanggal lahir -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="tanggal_lahir" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">
                                        Tanggal Lahir<span class="required">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input name="tanggal_lahir" id="tanggal_lahir" class="form-control datepicker"
                                            type="text" value="<?php echo set_value('tanggal_lahir'); ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-white icon" id="datepicker-trigger">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form untuk golongan upah -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="golongan_upah" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Golongan Upah<span
                                            class="required">*</span></label>
                                    <select class="js-example-basic-single" id="golongan_upah" name="golongan_upah"
                                        data-minimum-results-for-search="Infinity" style="border-radius: 15px;">
                                        <option selected disabled>Pilih Golongan Upah</option>
                                        <option value="1" <?php echo set_select('golongan_upah', '1'); ?>>1</option>
                                        <option value="2" <?php echo set_select('golongan_upah', '2'); ?>>2</option>
                                        <option value="3" <?php echo set_select('golongan_upah', '3'); ?>>3</option>
                                        <option value="4" <?php echo set_select('golongan_upah', '4'); ?>>4</option>
                                        <option value="5" <?php echo set_select('golongan_upah', '5'); ?>>5</option>
                                        <option value="6" <?php echo set_select('golongan_upah', '6'); ?>>6</option>
                                    </select>
                                    <?php echo form_error('golongan_upah', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- Form untuk data user -->
                        <div class="form-group">
                            <label for="akses" class="col-form-label">Akses<span class="required">*</span></label>
                            <select class="js-example-basic-single" id="akses" name="akses" style="border-radius: 15px;"
                                data-minimum-results-for-search="Infinity">
                                <option selected disabled>Pilih Role</option>
                                <option value="3" <?php echo set_select('akses', '3'); ?>>Admin HCM</option>
                                <option value="2" <?php echo set_select('akses', '2'); ?>>Pengaju</option>
                            </select>
                            <?php echo form_error('akses', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email<span class="required">*</span></label>
                            <input class="form-control" type="email" placeholder="Email" id="email" name="email"
                                value="<?php echo set_value('email'); ?>">
                            <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password<span class="required">*</span></label>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Password" id="password"
                                    name="password">
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" style="cursor: pointer;">
                                        <i id="togglePassword" class="fa fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="retype_password" class="col-form-label">Confirm Password<span
                                    class="required">*</span></label>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Confirm Password"
                                    id="retype_password" name="retype_password">
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" style="cursor: pointer;">
                                        <i id="togglePassword2" class="fa fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            <?php echo form_error('retype_password', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group text-center">
                            <a href="<?php echo site_url('Karyawan'); ?>"><button type="button"
                                    class="btn btn-secondary mr-3">Batal</button></a>
                            <button type="submit" name="submit" value="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function checkDepartemenVisibility() {
        var jabatan = document.getElementById("jabatan").value;
        var departemen = document.getElementById("departemen");

        if (jabatan === "General Manager" || jabatan === "Direktur") {
            departemen.disabled = true;
            departemen.value = "";
        } else {
            departemen.disabled = false;
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword2');
        const passwordInput = document.querySelector('#retype_password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
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

<script>
    function validateInput(event) {
        const input = event.target;
        const value = input.value;

        // Hanya izinkan angka
        const numbersOnly = /^[0-9]*$/;

        if (!numbersOnly.test(value)) {
            // Jika tidak valid, hapus karakter yang tidak valid
            input.value = value.replace(/[^0-9]/g, '');
        }
    }
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