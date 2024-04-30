<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="d-flex align-items-center mb-3">
                <a href="<?php echo site_url('SuperAdmin/daftar_karyawan'); ?>" class="d-flex align-items-center text-danger">
                    <i class="ti-arrow-circle-left mr-2" style="font-size: 24px;"></i>
                    <h4 style="color:#de4444; margin-left: 10px;">Tambah Karyawan</h4>
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>
                    <?php echo $this->session->flashdata('message'); ?>
                    <form method="post" action="<?php echo site_url('SuperAdmin/tambah_karyawan'); ?>">
                        <!-- Form untuk data karyawan -->
                        <div class="form-group">
                            <label for="nama" class="col-form-label" style="color:#3e3c3c; font-weight:bold;">Nama
                                Karyawan<span class="required">*</span></label>
                            <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama Karyawan"
                                value="<?php echo set_value('nama'); ?>" required>
                        </div>
                        <div class="row transparent-bg">
                            <!-- Form untuk nomor pekerja -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="no_pekerja" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Nomor Pekerja<span
                                            class="required">*</span></label>
                                    <input class="form-control" type="text" id="no_pekerja" name="no_pekerja"
                                        placeholder="Nomor Pekerja" value="<?php echo set_value('no_pekerja'); ?>">
                                </div>
                            </div>
                            <!-- Form untuk departemen -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="departemen" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Departemen<span
                                            class="required">*</span></label>
                                    <select class="custom-select" id="departemen" name="departemen"
                                        style="border-radius: 15px;">
                                        <option selected disabled>Pilih Departemen</option>
                                        <option value="HCM" <?php echo set_select('departemen', 'HCM'); ?>>HCM</option>
                                        <option value="ICT" <?php echo set_select('departemen', 'ICT'); ?>>ICT</option>
                                        <option value="Marketing" <?php echo set_select('departemen', 'Marketing'); ?>>
                                            Marketing</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row transparent-bg">
                            <!-- Form untuk jabatan -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="jabatan" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Jabatan<span
                                            class="required">*</span></label>
                                    <select class="custom-select" id="jabatan" name="jabatan"
                                        style="border-radius: 15px;">
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
                                </div>
                            </div>
                            <!-- Form untuk tanggal lahir -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Tanggal Lahir<span
                                            class="required">*</span></label>
                                    <input class="form-control" type="date" name="tanggal_lahir" id="tanggalLahir"
                                        value="<?php echo set_value('tanggal_lahir'); ?>" required>
                                </div>
                            </div>
                            <!-- Form untuk golongan upah -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="golongan_upah" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Golongan Upah<span
                                            class="required">*</span></label>
                                    <select class="custom-select" id="golongan_upah" name="golongan_upah"
                                        style="border-radius: 15px;">
                                        <option selected disabled>Pilih Golongan Upah</option>
                                        <option value="1" <?php echo set_select('golongan_upah', '1'); ?>>1</option>
                                        <option value="2" <?php echo set_select('golongan_upah', '2'); ?>>2</option>
                                        <option value="3" <?php echo set_select('golongan_upah', '3'); ?>>3</option>
                                        <option value="4" <?php echo set_select('golongan_upah', '4'); ?>>4</option>
                                        <option value="5" <?php echo set_select('golongan_upah', '5'); ?>>5</option>
                                        <option value="6" <?php echo set_select('golongan_upah', '6'); ?>>6</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Form untuk data user -->
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email<span class="text-danger">*</span></label>
                            <input class="form-control" type="email" placeholder="Email" id="email" name="email"
                                value="<?php echo set_value('email'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Password" id="password"
                                    name="password">
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" style="cursor: pointer;">
                                        <i id="togglePassword" class="fa fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="retype_password" class="col-form-label">Confirm Password<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Confirm Password"
                                    id="retype_password" name="retype_password">
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" style="cursor: pointer;">
                                        <i id="togglePassword2" class="fa fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir form untuk data user -->

                        <div class="form-group text-center">
                            <a href="<?php echo site_url('SuperAdmin/daftar_karyawan'); ?>"><button type="button" class="btn btn-secondary mr-3"
                               >Batal</button></a>
                            <button type="submit" name="submit" value="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>