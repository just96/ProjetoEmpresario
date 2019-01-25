<?php
session_start();
	// verifica se existe sessao do utiliador 
if (!isset($_SESSION['Utilizador']) && !isset($_SESSION['id']) ){

	header("Location:../utilizador/log.php" );

}
session_unset();
session_destroy();
header("Location:../utilizador/log.php");

?>