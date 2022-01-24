<?= $this->extend('admins/layouts/category_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12 mb-5">
        <!-- Category Item -->
        <h3>Item</h3>
        <hr>
    <?php if(isset($validation_item)) { ?>
        <div class="alert alert-danger"><?= $validation_item->listErrors() ?></div>
    <?php } ?>
        <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#addItemModal">+ Add Item</a>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Title</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($item_categories)) { ?>
                        <tr>
                            <td class="text-center" colspan="3">Data not found</td>
                        </tr>
                    <?php
                    } else {
                        $no = 0;
                        foreach($item_categories as $item_category) {
                            $no++;
                    ?>
                        <tr>
                            <th scope="row"><?= $no ?></th>
                            <td><?= $item_category['category_title'] ?></td>
                            <td>
                                <a href="<?= base_url('admin/category/'.$item_category['category_id'].'/edit?p=item') ?>" class="btn btn-success mb-3">Edit</a>
                                <a href="<?= base_url('admin/category/'.$item_category['category_id'].'/delete?p=item') ?>" class="btn btn-danger mb-3">Delete</a>
                            </td>
                        </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Add Item -->
            <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addItemModalTitle">Add Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('admin/category/create') ?>" method="post" id="formAddItem">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="inputCategoryTitle" class="form-label">Category Title</label>
                                    <input type="text" name="category_title" class="form-control" id="inputCategoryTitle" value="<?= set_value('category_title') ?>" readonly onfocus="this.removeAttribute('readonly');">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="submit_item" class="btn btn-primary g-recaptcha" 
                                    data-sitekey="6LeSaUUaAAAAAJZ8aTfoCQgyN0-3aK7ROprZtsVN" 
                                    data-callback='onSubmitItem' 
                                    data-action='submit'>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category World -->
        <h3>World</h3>
        <hr>
    <?php if(isset($validation_world)) { ?>
        <div class="alert alert-danger"><?= $validation_world->listErrors() ?></div>
    <?php } ?>
        <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#addWordModal">+ Add World</a>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Title</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php if(empty($world_categories)) { ?>
                        <tr>
                            <td class="text-center" colspan="3">Data not found</td>
                        </tr>
                <?php
                } else {
                    $no = 0;
                    foreach($world_categories as $world_category) {
                        $no++;
                ?>
                        <tr>
                            <th scope="row"><?=$no ?></th>
                            <td><?= $world_category['category_title'] ?></td>
                            <td>
                                <a href="<?= base_url('admin/category/'.$world_category['category_id'].'/edit?p=world') ?>" class="btn btn-success mb-3">Edit</a>
                                <a href="<?= base_url('admin/category/'.$world_category['category_id'].'/delete?p=world') ?>" class="btn btn-danger mb-3">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } 
                ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Add World -->
            <div class="modal fade" id="addWordModal" tabindex="-1" role="dialog" aria-labelledby="addWorldModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addWorldModalTitle">Add World</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('admin/category/create') ?>" method="post" id="formAddWorld">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="inputCategoryTitle" class="form-label">Category Title</label>
                                    <input type="text" name="category_title" class="form-control" id="inputCategoryTitle" value="<?= set_value('category_title') ?>" readonly onfocus="this.removeAttribute('readonly');">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="submit_world" class="btn btn-primary g-recaptcha" 
                                    data-sitekey="6LeSaUUaAAAAAJZ8aTfoCQgyN0-3aK7ROprZtsVN" 
                                    data-callback='onSubmitWorld' 
                                    data-action='submit'>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
