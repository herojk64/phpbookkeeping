<?php 

include_once("./session_start.php");
include_once("./header.php");
include_once("./nav.php");

if(!isset($_GET['id'])){
    header("location:./books.php");
    exit();
}

$id= $_GET["id"];

include_once("./functions.php");

$book = new Books();

$data = $book->getBookById($id);

?>
<main class="container mt-4">
<div class="row">
<div class="col-sm-12 col-md-4">
<img src="./assets/<?php echo $data['avatar']; ?>" class="img-thumbnail">
</div>
<div class="col">
    <article class="text-primary-cs">
        <header class="h1 text-center mb-4"><?php echo $data['name'] ?></header>
        <header>Writter: <?php echo $data["writer"]?></header>
        <p>Description: <?php echo $data['description'];?></p>
        <p>Created at: <?php echo date("Y/m/d",strtotime($data['createdAt']));?></p>
        
    </article>
</div>
</div>

<div class="row mt-5 mb-5">
    <div class="col">
    <div id="pdfdisplayer"  height="600" class="w-90 ratio ratio-16x9"></div>
    </div>
</div>

</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.12/pdfobject.js" integrity="sha512-I6am7LdwcOMDrXQBfJ6VQiqARVrGM9desGYl3ss/NkXjuNRkLSTzcMXjzVyH6U4W2UoIOikiFV28cos/gWCdDA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>PDFObject.embed("./assets/<?php echo $data['filename']; ?>", "#pdfdisplayer");</script>

<?php 

include_once("./footer.php");
?>