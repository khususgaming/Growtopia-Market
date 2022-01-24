<?= $this->extend('users/layouts/item_sell_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12 mb-5">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            Welcome to My Growtopia, <strong><?= session()->get('user_name') ?></strong>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <h3>List Item</h3>
        <hr>
        <?php if(isset($validation)):?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif;?>
        <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#addItemModal">+ Add Item</a>
        <div class="row">
            <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item</th>
                        <th scope="col">World</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Price</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($item_sell)) { ?>
                        <tr>
                            <td class="text-center" colspan="7">Data not found</td>
                        </tr>
                    <?php
                    } else {
                        $no = 0;
                        foreach($item_sell as $item) { 
                            $no++;
                    ?>
                        <tr>
                            <th scope="row"><?= $no ?></th>
                            <td><?= $items[$item['item_id'] - 1]['item_title'] ?></td>
                            <td><?= $worlds[$item['world_id'] - 1]['world_name'] ?></td>
                            <td><?= $users[$item['user_id'] - 1]['user_name'] ?></td>
                            <td><?= $item['item_price'] ?></td>
                            <td><?= $item['item_amount'] ?></td>
                            <td>
                                <a href="<?= base_url('item/'.$item['id'].'/edit') ?>" class="btn btn-success mb-3">Edit</a>
                                <a href="<?= base_url('item/'.$item['id'].'/delete') ?>" class="btn btn-danger mb-3">Delete</a>
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
                        <form autocomplete="off" action="<?= base_url('item/create') ?>" method="post" id="formAddItem">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="inputItemName" class="form-label">Item Name</label>
                                    <input list="item_list" type="text" name="item_name" class="form-control" id="inputItemName" onkeyup="itemSuggestion(this.value)">
                                    <div id="item-suggestion"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputWorldName" class="form-label">World Name</label>
                                    <select name="world_name" class="form-control" id="inputWorldName">
                                        <option value="">- Select World -</option>
                                    <?php foreach($user_worlds as $user_world) { ?>
                                        <option value="<?= $user_world['world_name'] ?>"><?= $user_world['world_name'] ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="inputItemPrice" class="form-label">Item Price</label>
                                    <input type="number" min="0" name="item_price" class="form-control" id="inputItemPrice">
                                </div>
                                <div class="mb-3">
                                    <label for="inputItemAmount" class="form-label">Item Amount</label>
                                    <input type="number" min="0" name="item_amount" class="form-control" id="inputItemAmount">
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

            <!-- Data Item -->
            <script>
            function itemSuggestion(item_name) {
                if(item_name.length == 0) {
                    document.getElementById('item-suggestion').innerHTML = '';
                    document.getElementById('item-suggestion').style.border = '0px';
                    document.getElementById('item-suggestion').style.padding = '0px';
                    return;
                }
                var xhr  = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    var innerItem = '';
                    if(this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        response.forEach(function(item) {
                            innerItem += '<option value="' + item.item_title + '">';
                        });
                        document.getElementById('item-suggestion').innerHTML = '<datalist id="item_list">' + innerItem + '</datalist>';
                        document.getElementById('item-suggestion').style.border = '0px';
                        document.getElementById('item-suggestion').style.padding = '0px';
                    } else {
                        document.getElementById('item-suggestion').innerHTML = 'Not Found';
                        document.getElementById('item-suggestion').style.border = '1px solid #A5ACB2';
                        document.getElementById('item-suggestion').style.padding = '5px';
                        document.getElementById('item-suggestion').style.fontSize ='12px';
                    }
                }
                xhr .open('GET', '<?= base_url("api/item") ?>/' + item_name, true);
                xhr .send();
            }
            </script>
        </div>
    </div>
</div>
<?= $this->endSection() ?>