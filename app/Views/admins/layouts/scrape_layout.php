<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $this->include('admins/layouts/partials/style') ?>
        <title>Scrape | My Growtopia</title>
    </head>
    <body>
        <div class="body-content">
            <?= $this->include('admins/layouts/partials/navbar') ?>
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="h1">Scrape</h1>
                        </div>
                    </div>
                </div>
            </header>
            <div class="content">
                <div class="container">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
            <?= $this->include('admins/layouts/partials/footer') ?>
        </div>
    </body>
</html>