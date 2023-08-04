<?php 
session_start();

session_unset();
session_destroy();

header("Location: government_login.php");