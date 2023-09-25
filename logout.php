<?php 
include_once("./session_start.php");
session_unset();
session_destroy();
header("location:./index.php");
?>