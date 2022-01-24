<?= $this->extend('users/layouts/login_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-6 mx-auto">
    <?php if(session()->getFlashdata('msg')) { ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
    <?php } ?>
        <form action="<?= base_url('auth') ?>" method="post" id="formLogin">
            <div class="mb-3">
                <label for="inputUsername" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="inputUsername" value="<?= set_value('username') ?>" readonly onfocus="this.removeAttribute('readonly');">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword" readonly onfocus="this.removeAttribute('readonly');">
            </div>
            <button type="submit" class="btn btn-primary g-recaptcha" 
            data-sitekey="6LeSaUUaAAAAAJZ8aTfoCQgyN0-3aK7ROprZtsVN" 
            data-callback='onSubmit' 
            data-action='submit'>Login</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>