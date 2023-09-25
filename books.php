<?php 

include_once("./session_start.php");
include_once("./header.php");
include_once("./nav.php");

?>

<main class="container w-100 mt-3">
    <div class="row">
        <div class="col-6 col-lg-6 ms-auto">
                <input type="text" name="search" id="search" class="form-control" placeholder="search.." />
        </div>
    </div>    
    <div class="row gap-2 mt-2 mx-auto hstack justify-content-center" id="client_book_side">
        
    </div>
</main>


<?php
include_once("./footer.php");
?>