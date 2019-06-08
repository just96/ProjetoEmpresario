<?php
session_start();
unset($_SESSION['role']);
session_destroy();
header("Location:../utilizador/log.php");
exit();
?>