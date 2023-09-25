<?php 

include_once("./session_start.php");
include_once("./header.php");
include_once("./nav.php");

if(isset($_SESSION['username'])){
    header("location:./index.php");
}

?>
<div class="container-lg ">

    <form id="form_login" class="mx-auto mt-5 w-75">
        <div class="mb-4">
        <label for="username" class="form-label">
            Username or Email:
        <span class="text-danger" id="usernameError"></span>
    </label>
    <input type="text" id="username" name="username" class="username form-control" placeholder="Enter your username or email" />
    </div>
    <div class="mb-4">
        <label for="password" class="form-label">
            Password:
            <span class="text-danger" id="passwordError"></span>
            
        </label>
        <input type="password" id="password" name="password" class="password form-control" placeholder="Enter your Password" />
    </div>
    <div class="text-danger mb-4" id="errorDisp"></div>
    <button type="submit" class="btn btn-primary bg-primary w-100 mb-4">Login</button>
    <div>Dont have an account yet? <a href="./signup.php">Create Account</a></div>
</form>

</div>

<?php
include_once("./footer.php");
?>