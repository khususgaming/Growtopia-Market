<!--
    $navbar_url_role = array(
        /**
         *  Key it's your name of Role, fill what's label for your role
         **/
        "Gold" => array(
            /**
             *  It's like level, higher for first
             **/
            "rolePower" => 3,

            /**
             *  It's list your url link, make sure you follow the examples
             *  Examples:
             *  "Menu"  =>  "your_url_menu",
             **/
            "Users" => "admin/user",
        ),
        "Silver" =>  array(
            "rolePower" => 2,
            "Users" => "admin/user",
        ),
        "Bronze" => array(
            "rolePower" => 1,
            "Users" => "admin/user",
        ),
    );

    $currentPower = 2;
    foreach ($navbar_url_role as $keys => $values) {
        $rolePower = $values['rolePower'];
        $Users = $values['Users'];
        if($currentPower < $rolePower) continue;
        echo $keys."<br>";
        echo ">".$rolePower."<br>";
        echo ">>".$Users."<br>";
    }
-->

<nav class="navbar navbar-light navbar-expand-sm fixed-top" id="navbarTop">
    <div class="container">
        <a class="navbar-brand" href="#" id="navbarBrand">My Growtopia</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>">Home</a>
                </li>
        <?php if(session()->get('a_logged_in')) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/category') ?>">Category</a>
                </li>
            <?php if(session()->get('admin_role') == "Gold") { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/user') ?>">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/scrape') ?>">Scrape</a>
                </li>
            <?php } ?>
        <?php } ?>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMember" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if(session()->get('a_logged_in')) { ?>
                        <?= session()->get('admin_name') ?>
                    <?php } else { ?>
                        Member
                    <?php } ?>
                    </a>
                <?php if(session()->get('a_logged_in')) { ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMember">
                        <a class="nav-link dropdown-item" href="<?= base_url('admin/auth/logout') ?>">Logout</a>
                    </div>
                <?php } else { ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMember">
                        <a class="nav-link dropdown-item" href="<?= base_url('admin/auth/login') ?>">Login</a>
                    </div>
                <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
