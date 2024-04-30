<?php
	session_start();
	// Elimino il token di autenticazione dalla sessione, in modo checkdate
	// fallista il controllo per l'accesso all'area riservata
	// vedi: if (!isset($_SESSION["AUTENTICATO"])) (home_riservata.php)
	// https://www.php.net/manual/en/function.unset.php
	// https://www.w3schools.com/php/func_var_unset.asp
	unset($_SESSION["AUTENTICATO"]);
	header("Location: ../index.php");
?>