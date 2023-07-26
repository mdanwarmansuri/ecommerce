<?php
include("user_secure.php");
session_unset();
session_destroy();
header('location:3 signin.php');
?>