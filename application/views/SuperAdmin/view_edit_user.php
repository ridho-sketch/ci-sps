<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="d-flex align-items-center mb-3">
                <a href="<?= base_url('SuperAdmin/daftar_user'); ?>" class="d-flex align-items-center text-danger">
                    <i class="ti-arrow-circle-left mr-2" style="font-size: 24px;"></i>
                    <h4 style="color:#de4444; margin-left: 10px;">Edit Daftar User</h4>
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?php echo $this->session->flashdata('message'); ?>
                    <form method="post" action="<?= base_url('SuperAdmin/edit_user/') . $user_data['id']; ?>">
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email<span class="text-danger">*</span></label>
                            <input class="form-control" type="username" placeholder="Email" id="email" name="email"
                                value="<?= $user_data['email']; ?>">
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
                        <input type="hidden" name="modified_by" value="<?= $userdata['id']; ?>">
                        <input type="hidden" name="modified_date" value="<?= date('Y-m-d H:i:s'); ?>">
                        <div class="form-group text-center">
                            <a href="<?php echo site_url('SuperAdmin/daftar_user'); ?>"><button type="button"
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
    // Setel nilai input password dan confirm password menjadi kosong saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("password").value = "";
        document.getElementById("retype_password").value = "";
    });

    // Fungsi untuk menampilkan atau menyembunyikan password
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var retypePasswordInput = document.getElementById("retype_password");
        var passwordToggle = document.querySelectorAll(".toggle-password");

        // Mengubah tipe input menjadi 'text' atau 'password' tergantung dari status saat ini
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            retypePasswordInput.type = "text";
            passwordToggle.forEach(function (element) {
                element.querySelector("i").classList.remove("fa-eye-slash");
                element.querySelector("i").classList.add("fa-eye");
            });
        } else {
            passwordInput.type = "password";
            retypePasswordInput.type = "password";
            passwordToggle.forEach(function (element) {
                element.querySelector("i").classList.remove("fa-eye");
                element.querySelector("i").classList.add("fa-eye-slash");
            });
        }
    }

    // Menambahkan event listener untuk setiap ikon mata
    document.querySelectorAll(".toggle-password").forEach(function (element) {
        element.addEventListener("click", togglePassword);
    });
</script>