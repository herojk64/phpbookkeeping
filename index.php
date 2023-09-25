<?php

include_once("./session_start.php");
include_once("./header.php");


?>
<main class="home_background">

    <?php
    include_once("./nav.php");
    ?>
    <header class="mt-5 mx-auto w-100 text-center">
        <h1 class="mt-5">Online Book keeping</h1>
        <p>Find and read all there is!</p>
        <button class="btn home_readnow">
            <?php
            if (isset($_SESSION['username'])) {
            ?>
                <a href="./books.php">
                    Read Now
                </a>
            <?php
            } else {
            ?>
                <a href="./signup.php">
                    Read Now
                </a>
            <?php
            }
            ?>
        </button>
    </header>
</main>


<?php
include_once("./footer.php");
?>