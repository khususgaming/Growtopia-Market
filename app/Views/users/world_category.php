<?= $this->extend('users/layouts/world_category_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12 mb-5">
        <a href="<?= base_url() ?>" class="btn btn-secondary">Back</a>
        <div class="row">
        <?php
        if(!empty($worlds)) {
            $world_count = 0;
            foreach($worlds as $world) {
        ?>
            <div class="col-sm-2 mr-0 p-3 text-center">
                <div class="card">
                    <a class="text-decoration-none" href="<?= base_url('world/'.$world['world_name']) ?>">
                        <h5 class="text-center font-weight-bold">World</h5>
                        <hr class="p-0 m-0">
                        <div class="card-body text-center p-1">
                            <?= $world['world_name'] ?>
                        </div>
                    </a>
                </div>
            </div>
        <?php
                $world_count++;
            }
            if($world_count == 0) {
        ?>
                <div class="col-md-12 text-center">
                    Data not found
                </div>
        <?php
            }
        } else {
        ?>
            <div class="col-md-12 text-center">
                Data not found
            </div>
        <?php
        }
        ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>