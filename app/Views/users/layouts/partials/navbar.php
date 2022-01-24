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
            <?php if(session()->get('u_logged_in')) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('item') ?>">Item</a>
                </li>
            <?php } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownTools" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tools
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownTools">
                        <a class="nav-link dropdown-item" href="<?= base_url('farming-calculator') ?>">Farming Calculator</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('about') ?>">About</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMember" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if(session()->get('u_logged_in')) { ?>
                        <?= session()->get('user_name') ?>
                    <?php } else { ?>
                        Member
                    <?php } ?>
                    </a>
                <?php if(session()->get('u_logged_in')) { ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMember">
                        <a class="nav-link dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a>
                    </div>
                <?php } else { ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMember">
                        <a class="nav-link dropdown-item" href="<?= base_url('auth/login') ?>">Login</a>
                        <a class="nav-link dropdown-item" href="<?= base_url('auth/register') ?>">Register</a>
                    </div>
                <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
