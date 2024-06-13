<style>
    .flash-msg-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        background-color: #ffffff;
        color: #ff0000;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .close-btn {
    position: absolute;
    top: 10px;
    left: 10px;
    cursor: pointer;
    font-size: 20px;
    color: #ff0000;; 
}
</style>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="login-area login-bg">
        <div class="container" style="width:auto;">
            <div class="login-box ptb--100">
                <form method="post" action="<?php echo site_url('Login/autentikasi'); ?>">
                    <div class="login-form-head">
                        <h4>Log In</h4>
                        <p>Silahkan lakukan login!</p>
                    </div>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label class="w3-text-blue"><b>Email</b></label>
                            <input class="w3-input w3-border w3-sand" name="email" type="username">
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label class="w3-text-blue"><b>Password</b></label>
                            <input class="w3-input w3-border w3-sand" name="pass" id="password" type="password">
                            <div class="text-danger"></div>
                            <i class="fa fa-eye-slash" id="togglePassword" style="position: absolute;
                                top: 30%;
                                right: 30px;
                                transform: translateY(-50%);
                                cursor: pointer;">
                            </i>
                        </div>
                        <div class="submit-btn-area mt-5">
                            <button type="submit">LOGIN <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if ($this->session->flashdata('msg')): ?>
        <div class="flash-msg-container">
            <?php echo $this->session->flashdata('msg'); ?>
            <span class="close-btn" onclick="closeFlashMsg()">&times;</span>
        </div>
    <?php endif; ?>

    <script>
        function closeFlashMsg() {
            var flashMsg = document.querySelector('.flash-msg-container');
            flashMsg.style.display = 'none';
        }
    </script>