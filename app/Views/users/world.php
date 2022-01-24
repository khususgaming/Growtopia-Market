<?= $this->extend('users/layouts/world_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12 mb-5">
        <a href="<?= base_url('category/world/'.$category_title) ?>" class="btn btn-secondary">Back</a>
        <div class="row">
        <?php
        if(!empty($world)) {
        ?>
            <div class="col-md-12 jumbotron m-3 p-3">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Owner</h3>
                        <?= $user['user_name'] ?>
                        <h3>Information</h3>
                        <?= $world['world_info'] ?>
                    </div>
                    <div class="col-md-6">
                        <h3>Image</h3>
                        <?php
                        $image_url = "https://s3.amazonaws.com/world.growtopiagame.com/".$world['world_name'].".png";
                        if(!file_exists($image_url)) {
                            $image_url = "https://www.publicdomainpictures.net/pictures/280000/velka/not-found-image-15383864787lu.jpg";
                        }
                        ?>
                        <a href="<?= $image_url ?>"><img src="<?= $image_url ?>" class="img-fluid" alt="<?= $world['world_name'] ?>" width="400" height="400"></a>
                    </div>
                </div>
            </div>
            <h3>Item Sale</h3>
            <?php
            foreach($item_sell as $item) {
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="card">
                            <h5 class="text-center font-weight-bold">Name</h5>
                            <hr class="p-0 m-0">
                            <div class="card-body text-center p-1">
                                <?= $items[$item['item_id'] - 1]['item_title'] ?>
                            </div>
                            <hr class="p-0 m-0">
                            <h5 class="text-center font-weight-bold">Price</h5>
                            <hr class="p-0 m-0">
                            <div class="card-body text-center p-1">
                                <?= $item['item_price'].'/'.$item['item_price'] ?>
                            </div>
                        </div>
                    </div>
                </div>
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