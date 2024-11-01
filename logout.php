<?php
require_once 'core/auth.php'; 

requireAuth(); 

session_start();
session_unset();
session_destroy();

header("Location: login.php");
exit;
?>