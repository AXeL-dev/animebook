<?php
if ($_POST['pseudo'] != '' AND $_POST['mot_de_passe'] != '' AND $_POST['confirm_mot_de_passe'] != '' AND $_POST['email'] != '')
{
	//echo 'voila : ' .isset($_POST['pseudo']);
	// connexion à la base
	include_once('../modele/connexion_sql.php');
	// on vérifie les informations d'inscription
	include_once('../modele/check_membre.php');
	include_once('../modele/add_membre.php');
	$pseudo = htmlspecialchars($_POST['pseudo']); // htmlspecialchars() pour éviter la faille XSS
	$mdp = htmlspecialchars($_POST['mot_de_passe']);
	$confirm_mdp = htmlspecialchars($_POST['confirm_mot_de_passe']);
	$email = htmlspecialchars($_POST['email']);
	
	if ($mdp != $confirm_mdp) // si le mot de passe et la confirmation ne sont pas identique
	{
		header('Location: ../vue/index.php?erreur_inscr=2');
		//header('Location: ../vue/index.php?erreur_type=inscr&erreur=Le mot de passe et la confirmation ne sont pas identique !');
	}
	else
	{
		$membre = check_membre($pseudo, false);

		if (!$membre) // si le membre n'existe pas, on l'ajoute
		{
			$hached_mdp = sha1($mdp); // on hache le mot de passe pour l'ajouter dans la base de données
			add_membre($pseudo, $hached_mdp, $email);
			$membre = check_membre($pseudo, $hached_mdp);
			if ($membre) // si le membre a été créé (autrement on s'en sert pour récupérer l'id)
			{
				// on le connecte (on débute une session)
				session_start();
				$_SESSION['id'] = $membre['id'];
				$_SESSION['pseudo'] = $pseudo;
				header('Location: ../vue/acceuil.php'); // redirection vers l'acceuil
			}
			else
			{
				header('Location: ../vue/index.php?erreur_inscr=3');
				//header('Location: ../vue/index.php?erreur_type=inscr&erreur=Erreur d\'inscription, veuillez réesayer plustard !');
			}
		}
		else
		{
			header('Location: ../vue/index.php?erreur_inscr=4');
			//header('Location: ../vue/index.php?erreur_type=inscr&erreur=Le pseudo que vous avez choisi existe déjà !');
		}
	}
}
else
{
	header('Location: ../vue/index.php?erreur_inscr=1');
	//header('Location: ../vue/index.php?erreur_type=inscr&erreur=Vous devez remplir tout les champs pour vous inscrire !');
}
