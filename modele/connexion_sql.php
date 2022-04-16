<?php
	// connexion à la base de données
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=animebook', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
// Pas la peine de fermer la balise php, ça évite d'avoir des problèmes avec setcookie(); par exemple
