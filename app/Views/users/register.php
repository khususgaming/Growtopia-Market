<?= $this->extend('users/layouts/register_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-6 mx-auto">
    <?php if(isset($validation)){ ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php } ?>
        <form action="<?= base_url('auth/save') ?>" method="post" id="formRegister">
            <div class="mb-3">
                <label for="inputUsername" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="inputUsername" value="<?= set_value('username') ?>" readonly onfocus="this.removeAttribute('readonly');">
            </div>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" id="inputEmail" value="<?= set_value('email') ?>" readonly onfocus="this.removeAttribute('readonly');">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword" readonly onfocus="this.removeAttribute('readonly');">
            </div>
            <div class="mb-3">
                <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword" readonly onfocus="this.removeAttribute('readonly');">
            </div>
            <button type="submit" class="btn btn-primary g-recaptcha" 
            data-sitekey="6LeSaUUaAAAAAJZ8aTfoCQgyN0-3aK7ROprZtsVN" 
            data-callback='onSubmit' 
            data-action='submit'>Register</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>