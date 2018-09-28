<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Admin</b>"LTE"</a>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <div class="text-danger text-center">
            <?= $login_error?>
        </div>
        <form action="<?= base_url('auth/login')?>" method="post">
            <?php echo form_error('identity')?>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="username" name="identity">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <?php echo form_error('password')?>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <?php echo  form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());  ?>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>
    </div>
</div>