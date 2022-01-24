<?= $this->extend('users/layouts/item_edit_layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-6 mx-auto">
    <?php if(isset($validation)) { ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php } ?>
        <form action="" method="post" id="itemEdit">
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
            <button type="submit" class="btn btn-primary g-recaptcha" 
            data-sitekey="6LeSaUUaAAAAAJZ8aTfoCQgyN0-3aK7ROprZtsVN" 
            data-callback='onSubmit' 
            data-action='submit'>Update</button>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Back</a>
        </form>
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
<?= $this->endSection() ?>
