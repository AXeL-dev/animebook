<?php
if ($_POST['pseudo'] != '' AND $_POST['mot_de_passe'] != '')
{
	// connexion à la base
	include_once('../modele/connexion_sql.php');
	// on vérifie les informations du membre (pseudo, mdp) dans la base de données
	include_once('../modele/check_membre.php');
	$pseudo = htmlspecialchars($_POST['pseudo']); // htmlspecialchars() pour éviter la faille XSS
	$mdp = sha1(htmlspecialchars($_POST['mot_de_passe'])); // on hache le mot de passe
	$membre = check_membre($pseudo, $mdp);

	if (!$membre) // si le membre n'existe pas
	{
		// on retourne à l'index en spécifiant l'erreur
		header('Location: ../vue/index.php?erreur_cnx=2');
		//header('Location: ../vue/index.php?erreur_type=cnx&erreur=Pseudo ou mot de passe incorrect !');
		//$_GET['erreur'] = 'Pseudo ou mot de passe incorrect !';
		//include_once('../vue/index.php');
	}
	else
	{
		// vérification fini , on affiche la vue (l'acceuil du compte du membre)
		//include_once('../vue/acceuil.php');
		session_start();
		$_SESSION['id'] = $membre['id'];
		$_SESSION['pseudo'] = $pseudo;
		header('Location: ../vue/acceuil.php');
	}
}
else
{
	header('Location: ../vue/index.php?erreur_cnx=1');
	//header('Location: ../vue/index.php?erreur_type=cnx&erreur=Veuillez saisir un pseudo et un mot de passe !');
}
