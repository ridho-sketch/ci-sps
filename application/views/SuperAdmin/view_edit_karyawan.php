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
                        <?php echo form_open('SuperAdmin/edit_karyawan/' . $karyawan['id_karyawan']); ?>
                        <div class="form-group">
                            <label for="nama" class="col-form-label" style="color:#3e3c3c; font-weight:bold;">Nama
                                Karyawan<span class="required">*</span></label>
                            <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama Karyawan"
                                value="<?php echo $karyawan['nama']; ?>">
                        </div>
                        <div class="row transparent-bg">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="no_pekerja" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Nomor Pekerja<span
                                            class="required">*</span></label>
                                    <input class="form-control" type="text" id="no_pekerja" name="no_pekerja"
                                        placeholder="Nomor Pekerja" value="<?php echo $karyawan['no_pekerja']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="departemen" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Departemen<span
                                            class="required">*</span></label>
                                    <select class="custom-select" id="departemen" name="departemen"
                                        style="border-radius: 15px;">
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
                        </div>
                        <div class="row transparent-bg">
                            <div class="col-sm-4">
                            <div class="form-group">
                                    <label for="jabatan" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Jabatan<span
                                            class="required">*</span></label>
                                            <select class="custom-select" id="jabatan" name="jabatan" style="border-radius: 15px;">
                                        <option value="" selected disabled>Pilih Golongan Upah</option>
                                        <option value="Staf" <?php if ($karyawan['jabatan'] == "Staf") echo 'selected'; ?>>Staf</option>
                                        <option value="Supervisor" <?php if ($karyawan['jabatan'] == "Supervisor") echo 'selected'; ?>>Supervisor</option>
                                        <option value="Tim Manager" <?php if ($karyawan['jabatan'] == "Tim Manager") echo 'selected'; ?>>Tim Manager</option>
                                        <option value="Manager" <?php if ($karyawan['jabatan'] == "Manager") echo 'selected'; ?>>Manager</option>
                                        <option value="General Manager" <?php if ($karyawan['jabatan'] == "General Manager") echo 'selected'; ?>>General Manager</option>
                                        <option value="Direktur" <?php if ($karyawan['jabatan'] == "Direktur") echo 'selected'; ?>>Direktur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Tanggal Lahir<span
                                            class="required">*</span></label>
                                    <input class="form-control" type="date" name="tanggal_lahir" id="tanggalLahir"
                                        value="<?php echo $karyawan['tanggal_lahir']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="golongan_upah" class="col-form-label"
                                        style="color:#3e3c3c; font-weight:bold;">Golongan Upah<span
                                            class="required">*</span></label>
                                            <select class="custom-select" id="golongan_upah" name="golongan_upah" style="border-radius: 15px;">
                                        <option value="" selected disabled>Pilih Golongan Upah</option>
                                        <option value="1" <?php if ($karyawan['golongan_upah'] == "1") echo 'selected'; ?>>1</option>
                                        <option value="2" <?php if ($karyawan['golongan_upah'] == "2") echo 'selected'; ?>>2</option>
                                        <option value="3" <?php if ($karyawan['golongan_upah'] == "3") echo 'selected'; ?>>3</option>
                                        <option value="4" <?php if ($karyawan['golongan_upah'] == "4") echo 'selected'; ?>>4</option>
                                        <option value="5" <?php if ($karyawan['golongan_upah'] == "5") echo 'selected'; ?>>5</option>
                                        <option value="6" <?php if ($karyawan['golongan_upah'] == "6") echo 'selected'; ?>>6</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" style="text-align:right;">
                        <a href="<?php echo site_url('SuperAdmin/daftar_karyawan'); ?>"><button type="button" class="btn btn-secondary mb-3" >Batal</button></a>
                                            <a><button type="submit" class="btn btn-success mb-3" style>Simpan</button></a>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>