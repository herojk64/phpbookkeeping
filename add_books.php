<?php 

include_once("./session_start.php");


if(!isset($_SESSION['admin']) && $_SESSION["admin"]){
    session_unset();
    session_destroy();
    header("location:./index.php");
}

?>
<div class="container">
<form id="form_add_book">
    <div class="mb-2">
        <label for="name" class="form-label">Name:<span class="text-danger" id="nameError"></span></label>
        <input type="text" class="name form-control" id="name" placeholder="Enter name of book" />
    </div>
    <div class="mb-2">
        <label for="writter_name" class="form-label">Writter Name:<span class="text-danger" id="writterError"></span></label>
        <input type="text" class="writter_name form-control" id="writter_name" placeholder="Enter name of Writter" />
    </div>
    <div class="mb-2">
        <label for="description" class="form-label">Description:<span class="text-danger" id="descriptionError"></span></label>
        <textarea class="description form-control" id="description" placeholder="Description" rows="5" cols="5" style="resize: none;" ></textarea>
    </div>
    <div class="mb-2">
        <label for="avatar" class="form-label">Avatar:<span class="text-danger" id="avatarError"></span></label>
        <input type="file" class="avatar form-control" id="avatar" />
    </div>
    <div class="mb-2">
        <label for="book_file" class="form-label">Name:<span class="text-danger" id="bookError"></span></label>
        <input type="file" class="book_file form-control" id="book_file" />
    </div>
    <button type="submit" class="btn btn-primary bg-primary mb-3 w-100">Submit</button>
</form>
</div>