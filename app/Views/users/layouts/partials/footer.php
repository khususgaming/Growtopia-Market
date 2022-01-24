<footer class="text-center">
    <b>Copyright &copy <?= Date('Y') ?> My Growtopia<b><br>
    <small>All sprites and related graphics are owned by Growtopia (Ubisoft)<br>
    My Growtopia is in no way affiliated with Growtopia (Ubisoft)<br>
    From Growtopian to Growtopian with &#10084;</small>
</footer>

<script>
    // When the user scrolls the page, execute navbarDown
    window.onscroll = function() {
        navbarDown()
    };
    // Get the navbar
    var navbar = document.getElementById("navbarTop");
    var brand = document.getElementById("navbarBrand");
    // Get the offset position of the navbar
    var sticky = navbar.offsetTop;
    // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function navbarDown() {
        if (window.pageYOffset > 0) {
            navbar.classList.add("affix");
            brand.classList.add("brandcolor");
        } else {
            navbar.classList.remove("affix");
            brand.classList.remove("brandcolor");
        }
    } 
</script>

<!-- Jquery dan Bootsrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>