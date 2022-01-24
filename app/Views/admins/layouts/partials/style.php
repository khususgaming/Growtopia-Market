<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
<!-- Custom CSS -->
<style>
    body {
        background-color: #66ccff;
    }
    .body-content {
        background-color: white;
        /* Make footer responsive with the content */
        min-height: 100vh;
        display: flex;
        flex-direction: column; 
        justify-content: space-between;
    }
    header {
        background: url('https://s3.eu-west-1.amazonaws.com/cdn.growtopiagame.com/website/resources/assets/images/grow_header.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background-position: 0% 8.5%;
        background-color: #66ccff;
        margin-top: 5vh;
        padding: 5vh;
    }
    .navbar { 
        -webkit-transition: padding 0.2s ease;
        -moz-transition: padding 0.2s ease;
        -o-transition: padding 0.2s ease;
        transition: padding 0.2s ease;
    }
    .brandcolor {
        color: red !important;
    }
    #navbarTop {
        background: url('https://s3.eu-west-1.amazonaws.com/cdn.growtopiagame.com/website/resources/assets/images/grow_header.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background-position: 0% 8.5%;
    }
    #navbarTop.navbar.navbar-light.navbar-expand-sm.fixed-top.affix {
        background-image: url('');
    }
    #navbarTop .navbar-brand {
        color: white;
    }
    #navbarTop .navbar-text,
    #navbarTop .nav-link {
        color: black;
    }
    #navbarTop .nav-link:hover {
        color: #ff6633;
        text-decoration: underline;
    }
    #navbarNav.navbar-collapse.collapsing ul.navbar-nav,
    #navbarNav.navbar-collapse.collapse.show ul.navbar-nav {
        padding-left: 12px;
        background-color: white;
    }
    .affix {
        /* Navbar changer */
        background-color: white !important;
        padding-top: 0.2em !important;
        padding-bottom: 0.2em !important;
        border-bottom: 2px solid #66ccff;
        opacity: 0.8;
        -webkit-transition: padding 0.2s linear;
        -moz-transition: padding 0.2s linear;
        -o-transition: padding 0.2s linear;
        transition: padding 0.2s linear;
    }
    .content {
        min-height: 65vh;
        padding-top: 4vh;
    }
    footer{
        background: linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.5)),
            url('https://s3.eu-west-1.amazonaws.com/cdn.growtopiagame.com/website/resources/assets/images/grow_header.jpg');
        background-position: 0% 90%;
        margin-top: 4vh;
        padding: 25px;
    }
    .img-item {
        width: 50px;
        height: 50px;
    }
    .grecaptcha-badge {
        z-index: 99999;
    }
</style>
