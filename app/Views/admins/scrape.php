<?= $this->extend('admins/layouts/scrape_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12 mb-5">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Note:</strong><br>
            <ul>
                <li>Item-Category it makes Category join Item, like Item has more 1 Category.</li>
                <li>Update Item and Category first before updating Item-Category. Please wait until the update is successful.</li>
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <h3>Item</h3>
        <hr>
    <?php if(session()->getFlashdata('item_response')) { ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('item_response') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
        <a href="<?= base_url('admin/scrape/item') ?>" class="btn btn-success mb-3">Update Item</a>
        <h3>Category</h3>
        <hr>
    <?php if(session()->getFlashdata('category_response')) { ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('category_response') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
        <a href="<?= base_url('admin/scrape/category') ?>" class="btn btn-success mb-3">Update Category</a>
        <h3>Item-Category</h3>
        <hr>
    <?php if(session()->getFlashdata('mixed_response')) { ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('mixed_response') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
        <a href="<?= base_url('admin/scrape/mixed') ?>" class="btn btn-success mb-3">Update Item-Category</a>
    </div>
</div>
<?= $this->endSection() ?>
