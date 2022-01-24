<?= $this->extend('admins/layouts/item_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12 mb-5">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            Welcome to My Growtopia, <strong><?= session()->get('admin_name') ?></strong>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <h3>List World</h3>
        <hr>
    <?php if(isset($validation)) { ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php } ?>
        <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#addWorldModal">+ Add World</a>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Category</th>
                        <th scope="col">Information</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($worlds)) { ?>
                        <tr>
                            <td class="text-center" colspan="5">Data not found</td>
                        </tr>
                    <?php
                    } else {
                        $no = 0;
                        foreach($worlds as $world) {
                            $no++;
                    ?>
                        <tr>
                            <th scope="row"><?= $no ?></th>
                            <td><?= $world['world_name'] ?></td>
                            <td><?= $users[$world['user_id']-1]['user_name'] ?></td>
                            <td><?= $world_categories[$world['category_id']-1]['category_title'] ?></td>
                            <td><?= $world['world_info'] ?></td>
                            <td>
                                <a href="<?= base_url('admin/dashboard/'.$world['world_id'].'/edit') ?>" class="btn btn-success mb-3">Edit</a>
                                <a href="<?= base_url('admin/dashboard/'.$world['world_id'].'/delete') ?>" class="btn btn-danger mb-3">Delete</a>
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
            <div class="modal fade" id="addWorldModal" tabindex="-1" role="dialog" aria-labelledby="addWorldModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addWorldModalTitle">Add World</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('admin/dashboard/create') ?>" method="post" id="formAddItem">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="inputWorldName" class="form-label">World Name</label>
                                    <input type="text" name="world_name" class="form-control" id="inputWorldName" value="<?= set_value('world_name') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="inputWorldCategory" class="form-label">World Category</label>
                                    <select name="world_category" class="form-control" id="inputWorldCategory">
                                        <option value="">- Select Category -</option>
                                        <?php foreach($world_categories as $world_category) { ?>
                                            <option value="<?= $world_category['category_id'] ?>"><?= $world_category['category_title'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="inputWorldInfo" class="form-label">World Info</label>
                                    <textarea type="text" name="world_info" class="form-control" id="inputWorldInfo" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary g-recaptcha" 
                                    data-sitekey="6LeSaUUaAAAAAJZ8aTfoCQgyN0-3aK7ROprZtsVN" 
                                    data-callback='onSubmit' 
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
