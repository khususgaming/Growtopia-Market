<?= $this->extend('admins/layouts/user_edit_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-6 mx-auto">
    <?php if(isset($validation)) { ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php } ?>
        <form action="" method="post" id="userEdit">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="hidden" name="username" class="form-control" value="<?= $user['user_name'] ?>">
                <input type="text" class="form-control" value="<?= $user['user_name'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" id="inputEmail" value="<?= $user['user_email'] ?>" readonly onfocus="this.removeAttribute('readonly');">
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
            data-action='submit'>Update</button>
            <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
