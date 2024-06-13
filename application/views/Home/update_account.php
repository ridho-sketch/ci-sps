<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .toast {
        font-size: 16px;
        width: 900px;
    }
</style>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center">
                    <a href="<?php echo site_url('Home'); ?>" class="text-danger d-flex align-items-center">
                        <i class="ti-arrow-circle-left" style="font-size: 24px; color:#de4444;"></i>
                        <h4 style="color:#de4444; margin-left: 12px;">Edit Akun</h4>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?php echo site_url('Home/update_account'); ?>">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email<span class="text-danger">*</span></label>
                            <input class="form-control" type="email" placeholder="Email" id="email" name="email"
                                value="<?php echo isset($userdata['email']) ? $userdata['email'] : ''; ?>">
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
                            <a href="<?php echo site_url('Home'); ?>"><button type="button"
                                    class="btn btn-secondary mr-3">Batal</button></a>
                            <!-- Modal Button -->
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#exampleModalCenter">Simpan</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Simpan
                                                Perubahan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menyimpan perubahan?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <button type="submit" name="submit" value="submit"
                                                class="btn btn-primary">Ya, Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            // Ganti ikon mata kunci sesuai dengan tipe input password
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
            // Ganti ikon mata kunci sesuai dengan tipe input password
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    });
</script>
<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('msg') == 'success'): ?>
            toastr.success('Data Akun Anda Berhasil diubah!', 'Success');
        <?php endif; ?>
    });
</script>


<?php if ($this->session->flashdata('logout')): ?>
    <script>
        setTimeout(function () {
            window.location.href = "<?php echo base_url('Login/logout'); ?>";
        }, 2300);
    </script>
<?php endif; ?>
