<?php 

include_once("./session_start.php");
include_once("./header.php");
include_once("./nav.php");

if(!isset($_SESSION['admin']) && $_SESSION["admin"]){
    session_unset();
    session_destroy();
    header("location:./index.php");
}

?>
<div class="container pt-3">
  <div class="row">
<nav class="col-lg-2 col-4">
    <ul class="nav flex-column">
        <li class="nav-item"><a href="./admin.php" class="nav-link text-primary-cs">Book List</a></li>
        <li class="nav-item"><a href="./admin.php?add_books" class="nav-link text-primary-cs">Add Books</a></li>
    </ul>
</nav>
<main class="col">
    <?php
    if(isset($_GET['add_books'])){
        include_once("./add_books.php");
    }elseif(isset($_GET['edit'])){
        include_once("./edit_books.php");
    }else{
        include_once("./books_list.php");
    }
    ?>
</main>
  </div>
</div>
<?php
include_once("./footer.php");
?>