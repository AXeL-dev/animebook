<?php
if ($_POST['pseudo'] != '' AND $_POST['mot_de_passe'] != '' AND $_POST['confirm_mot_de_passe'] != '' AND $_POST['email'] != '')
{
	//echo 'voila : ' .isset($_POST['pseudo']);
	// connexion à la base
	include_once('../modele/connexion_sql.php');
	// on vérifie les informations d'inscription
	include_once('../modele/check_membre.php');
	include_once('../modele/update_membre.php');
	$pseudo = htmlspecialchars($_POST['pseudo']); // htmlspecialchars() pour éviter la faille XSS
	$mdp = htmlspecialchars($_POST['mot_de_passe']);
	$confirm_mdp = htmlspecialchars($_POST['confirm_mot_de_passe']);
	$email = htmlspecialchars($_POST['email']);
	
	if ($mdp != $confirm_mdp) // si le mot de passe et la confirmation ne sont pas identique
	{
		header('Location: ../vue/config.php?erreur_inscr=2');
	}
	else
	{
		$membre = check_membre($pseudo, false);
		session_start(); // pour pouvoir accéder aux variables de session

		if ($_SESSION['pseudo'] == $pseudo || !$membre) // si les pseudo (nouveau/ancien) sont identiques (pas de changements), et le membre/nouveau pseudo n'existe pas, on peut modifier le courant sans craindre d'avoir un double pseudo ds la bdd
		{
			$hached_mdp = sha1($mdp); // on hache le mot de passe pour l'ajouter dans la base de données
			update_membre($_SESSION['pseudo'], $pseudo, $hached_mdp, $email);
			$membre = check_membre($pseudo, $hached_mdp);
			if ($membre) // si le membre a été mit à jour
			{
				// on met à jour les variables de session
				//$_SESSION['id'] = $membre['id'];
				$_SESSION['pseudo'] = $pseudo;
				header('Location: ../vue/config.php?erreur_inscr=0'); // inscription réussi
			}
			else
			{
				header('Location: ../vue/config.php?erreur_inscr=3');
			}
		}
		else
		{
			header('Location: ../vue/config.php?erreur_inscr=4');
		}
	}
}
else
{
	header('Location: ../vue/config.php?erreur_inscr=1');
}
