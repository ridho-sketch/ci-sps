<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="d-flex align-items-center mb-3">
                <a href="<?php echo site_url('SuperAdmin/daftar_user'); ?>" class="d-flex align-items-center text-danger">
                    <i class="ti-arrow-circle-left mr-2" style="font-size: 24px;"></i>
                    <h4 style="color:#de4444; margin-left: 10px;">Tambah User Super Admin</h4>
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?php echo $this->session->flashdata('message'); ?>
                    <form method="post" action="<?php echo site_url('SuperAdmin/tambah_superadmin'); ?>">
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email<span class="text-danger">*</span></label>
                            <input class="form-control" type="username" placeholder="Email" id="email" name="email"
                                value="">
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
                        <div class="form-group text-center">
                            <a href="<?php echo site_url('SuperAdmin/daftar_user'); ?>"><button type="button"
                                    class="btn btn-secondary mr-3">Cancel</button></a>
                            <button type="submit" name="submit" value="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>