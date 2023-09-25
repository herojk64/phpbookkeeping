<?php 

include_once("./session_start.php");
include_once("./header.php");
include_once("./nav.php");

if(!isset($_SESSION['username'])){
    session_unset();
    session_destroy();
    header("location:./index.php");
}

?>

<main class="container mt-5">
    <header class="mt-3">
        <div><b>Name:</b> <?php echo $_SESSION["name"]; ?></div>
        <div><b>Email:</b> <?php echo $_SESSION["email"]; ?></div>
        <div><b>Phone Number:</b> <?php echo $_SESSION["phno"]; ?></div>
    </header>
    <form id="form_profile" class="form w-100 mt-5">
    <div class="mb-4">
        <label for="password" class="form-label">New Password:<span id="passwordError" class="text-danger"></span></label>
        <input type="password" class="password form-control" id="password" placeholder="Enter your new password" />
    </div>
    <div class="mb-4">
        <label for="cpassword" class="form-label">Re-Enter Password:<span id="passwordError" class="text-danger"></span></label>
        <input type="password" class="cpassword form-control" id="cpassword" placeholder="Re-Enter your new password" />
    </div>
    <button type="submit" class="btn btn-primary bg-primary w-100">Change</button>
    </form>
</main>

<?php
include_once("./footer.php");
?>