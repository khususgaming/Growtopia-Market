<?= $this->extend('users/layouts/home_layout') ?>
<?= $this->section('content') ?>
<div class="row">
<?php
if(!empty($world_categories)) {
    foreach($world_categories as $world_category) { ?>
    <div class="col-md-12 mb-5">
        <h3><?= $world_category['category_title'] ?></h3>
        <hr>
        <div class="row">
        <?php
        $world_count = 0;
        foreach($worlds as $world) {
            if($world['category_id'] == $world_category['category_id']) {
                if($world_count == 5) {
        ?>
                    <div class="col-sm-2 pt-4 text-center">
                        <a href="<?= base_url('category/world/'.$world_category['category_title']) ?>">Load More . . .</a>
                    </div>
        <?php
                    break;
                }
        ?>
            <div class="col-sm-2">
                <a class="text-decoration-none" href="<?= base_url('world/'.$world['world_name']) ?>">
                    <div class="card">
                        <h5 class="text-center font-weight-bold">World</h5>
                        <hr class="p-0 m-0">
                        <div class="card-body text-center p-1">
                            <?= $world['world_name'] ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php
                $world_count++;
            }
        }
        if($world_count == 0) {
        ?>
            <div class="col-md-12 text-center">
                Data not found
            </div>
        <?php } ?>
        </div>
    </div>
<?php
    }
}
?>
</div>
<?= $this->endSection() ?>