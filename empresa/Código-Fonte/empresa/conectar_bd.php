<!-- Ligação à Base de Dados -->
<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'bd_empresa';

$connection = mysqli_connect($host, $user, $pass, $database);
if (!$connection){
	die("Database connection failed: " . mysqli_connect_error());
}

$db_select = mysqli_select_db($connection, $database);
if (!$db_select) {
	die("Database selection failed: " . mysqli_error($connection));
}

?>
