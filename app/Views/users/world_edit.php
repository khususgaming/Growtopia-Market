<?= $this->extend('users/layouts/world_edit_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-6 mx-auto">
    <?php if(isset($validation)) { ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php } ?>
        <form action="" method="post" id="worldEdit">
            <div class="mb-3">
                <label for="inputWorldName" class="form-label">World Name</label>
                <input type="text" name="world_name" class="form-control" id="inputWorldName" value="<?= $world['world_name'] ?>">
            </div>
            <div class="mb-3">
                <label for="inputWorldCategory" class="form-label">World Category</label>
                <select name="world_category" class="form-control" id="inputWorldCategory">
                    <option value="<?= $world['category_id'] ?>"><?= $world_categories[$world['category_id']-1]['category_title'] ?></option>
                    <?php
                    foreach($world_categories as $world_category) { 
                        if($world_category['category_id'] == $world['category_id']) {
                            continue;
                        } else {
                            echo '<option value="'.$world_category['category_id'].'">'.$world_category['category_title'].'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputWorldInfo" class="form-label">World Info</label>
                <textarea type="text" name="world_info" class="form-control" id="inputWorldInfo" rows="3"><?= $world['world_info'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary g-recaptcha" 
            data-sitekey="6LeSaUUaAAAAAJZ8aTfoCQgyN0-3aK7ROprZtsVN" 
            data-callback='onSubmit' 
            data-action='submit'>Update</button>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
