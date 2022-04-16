<?php
	session_start();
	
	// Suppression des variables de session et de la session
	$_SESSION = array();
	session_destroy();
	
	// Suppression des cookies de connexion automatique
	//setcookie('pseudo', '');
	//setcookie('hached_mdp', '');
	
	// redirection vers l'index
	header('Location: ../vue/index.php');

