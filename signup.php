<?php 

include_once("./session_start.php");
include_once("./header.php");
include_once("./nav.php");

?>
<div>

    <form id="form_signup" class="mx-auto mt-2 w-75 text-primary-cs">
        <div class="mb-3">
            <label for="name" class="form-label">
                Name:
                <span class="text-danger" id="nameError"></span>
            </label>
            <input type="text" id="name" name="name" class="name form-control" placeholder="Enter your name" />
        </div>
    <div class="mb-3">
    <label for="email" class="form-label">
        Email:
        <span class="text-danger" id="emailError"></span>
        </label>
        <input type="email" id="email" name="email" class="email form-control" placeholder="Enter your email" />
    </div>
    <div class="mb-3">
    <label for="username" class="form-label">
    Username:
        <span class="text-danger" id="usernameError"></span>
    </label>
        <input type="text" id="username" name="username" class="username form-control" placeholder="Enter your username" />
    </div>
    <div class="mb-3">
        <label for="phno" class="form-label">
            Phone Number:
            <span class="text-danger" id="phnoError"></span>
        </label>
        <input type="text" id="phno" name="phno" class="phno form-control" placeholder="Enter your phno" />
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">
            Password:
            <span class="text-danger" id="passwordError"></span>
        </label>
        <input type="password" id="password" name="password" class="password form-control" placeholder="Enter your password" />
    </div>
    <div class="mb-3">
        <label for="cpassword" class="form-label">
            Re-Enter Password:
            <span class="text-danger" id="cpasswordError"></span>
        </label>
        <input type="password" id="cpassword" name="cpassword" class="cpassword form-control" placeholder="Re-Enter your password" />
    </div>
    <div id="errorDisp" class="text-dangers mb-3"></div>
    <div class="mb-3">Already have an Account? <a href="./login.php">Login!</a></div>
    <button type="submit" class="btn btn-primary bg-primary w-100 mb-3">Sign Up</button>
</form>

</div>

<?php
include_once("./footer.php");
?>