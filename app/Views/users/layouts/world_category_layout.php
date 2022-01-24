<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $this->include('users/layouts/partials/style') ?>
        <title><?= $category_title ?> | My Growtopia</title>
    </head>
    <body>
        <div class="body-content">
            <?= $this->include('users/layouts/partials/navbar') ?>
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="h1"><?= $category_title ?></h1>
                        </div>
                    </div>
                </div>
            </header>
            <div class="content">
                <div class="container">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
            <?= $this->include('users/layouts/partials/footer') ?>
        </div>
    </body>
</html>