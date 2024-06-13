<footer>
    <div class="footer-area-login">
        <p>© 2024 Bumi Siak Pusako</p>
    </div>
</footer>

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

<!-- jquery latest version -->
<script src="<?= base_url('assets/') ?>js/vendor/jquery-2.2.4.min.js"></script>
<!-- bootstrap 4 js -->
<script src="<?= base_url('assets/') ?>js/popper.min.js"></script>
<script src="<?= base_url('assets/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/') ?>js/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/') ?>js/metisMenu.min.js"></script>
<script src="<?= base_url('assets/') ?>js/jquery.slimscroll.min.js"></script>
<script src="<?= base_url('assets/') ?>js/jquery.slicknav.min.js"></script>

<!-- others plugins -->
<script src="<?= base_url('assets/') ?>js/plugins.js"></script>
<script src="<?= base_url('assets/') ?>js/scripts.js"></script>

</body>

</html>