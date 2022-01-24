<?= $this->extend('admins/layouts/category_edit_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-6 mx-auto">
    <?php if(isset($validation)) { ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php } ?>
        <form action="" method="post" id="categoryEdit">
            <div class="mb-3">
                <label for="inputCategoryTitle" class="form-label">Category Title</label>
                <input type="text" name="category_title" class="form-control" id="inputCategoryTitle" value="<?= $category['category_title'] ?>">
            </div>
            <button type="submit" class="btn btn-primary g-recaptcha" 
            data-sitekey="6LeSaUUaAAAAAJZ8aTfoCQgyN0-3aK7ROprZtsVN" 
            data-callback='onSubmit' 
            data-action='submit'>Update</button>
            <a href="<?= base_url('admin/category') ?>" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
