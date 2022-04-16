<?php
	// on ajoute un membre
	function add_membre($pseudo, $mdp, $email)
	{
		global $bdd;
		
		// on demande les informations
		$req = $bdd->prepare('INSERT INTO membres(pseudo, mot_de_passe, email, date_inscription) VALUES(:pseudo, :mdp, :email, NOW())');
		$req->execute(array('pseudo' => $pseudo, 'mdp' => $mdp, 'email' => $email));
		$resultat = $req->fetch();
		$req->closeCursor();
		
		// on retourne le resultat
		return $resultat;
	}
