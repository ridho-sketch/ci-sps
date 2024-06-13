<style>
    .col-form-label {
        color: #3e3c3c;
        font-weight: bold;
    }
</style>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="d-flex align-items-center mb-3">
                <a href="<?= base_url('User/'); ?>" class="d-flex align-items-center text-danger">
                    <i class="ti-arrow-circle-left mr-2" style="font-size: 24px;"></i>
                    <h4 style="color:#de4444; margin-left: 10px;">Edit Daftar User</h4>
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php echo $this->session->flashdata('message'); ?>
                    <form method="post" action="<?= base_url('User/update/') . $user_data['id']; ?>">
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email<span class="required">*</span></label>
                            <input class="form-control" type="username" placeholder="Email" id="email" name="email"
                                value="<?php echo empty(set_value('email')) ? $user_data['email'] : set_value('email'); ?>">
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
                        <input type="hidden" name="modified_by" value="<?= $userdata['id']; ?>">
                        <input type="hidden" name="modified_date" value="<?= date('Y-m-d H:i:s'); ?>">
                        <div class="form-group text-center">
                            <a href="<?php echo site_url('User/'); ?>"><button type="button"
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