<?= $this->extend('admins/layouts/user_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12 mb-5">
        <h3>List User</h3>
        <hr>
    <?php if(isset($validation)) { ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php } ?>
        <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#addUserModal">+ Add User</a>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($users)) { ?>
                        <tr>
                            <td class="text-center" colspan="4">Data not found</td>
                        </tr>
                    <?php
                    } else {
                        $no = 0;
                        foreach($users as $user) {
                            $no++;
                    ?>
                        <tr>
                            <th scope="row"><?= $no ?></th>
                            <td><?= $user['user_name'] ?></td>
                            <td><?= $user['user_email'] ?></td>
                            <td>
                                <a href="<?= base_url('admin/user/'.$user['user_id'].'/edit') ?>" class="btn btn-success mb-3">Edit</a>
                                <a href="<?= base_url('admin/user/'.$user['user_id'].'/delete') ?>" class="btn btn-danger mb-3">Delete</a>
                            </td>
                        </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Modal Add User -->
            <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalTitle">Add User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('admin/user/create') ?>" method="post" id="formAddUser">
                            <div class="modal-body">
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
