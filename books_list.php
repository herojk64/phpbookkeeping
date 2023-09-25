<?php

include_once("./session_start.php");


if (!isset($_SESSION['admin']) && $_SESSION["admin"]) {
    session_unset();
    session_destroy();
    header("location:./index.php");
}

?>
<div class="container mb-4">
    <div class="row">
        <div class="col-4 col-lg-6 ms-auto">
            <input class="form-control" id="search_book" placeholder="Search..." />
        </div>
    </div>
</div>

        <div class="table-responsive">


            <table class="table rounded" id="admin_book_list">
                <thead>
                    <tr>
                        <th scope="col">S/n</th>
                        <th scope="col">Name</th>
                        <th scope="col">Writter</th>
                        <th scope="col">Description</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="admin_book_body">
                </tbody>
            </table>
</div>