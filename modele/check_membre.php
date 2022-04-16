<?php
	// on vérifie les informations du membre à la connexion
	function check_membre($pseudo, $mdp)
	{
		global $bdd;
		
		// on demande les informations
		if (!$mdp) // si mdp == false
		{// alors on ne doit vérifier que le pseudo
			$req = $bdd->prepare('SELECT id, pseudo FROM membres WHERE pseudo = ?');
			$req->execute(array($pseudo));
		}
		else
		{
			$req = $bdd->prepare('SELECT id, pseudo FROM membres WHERE pseudo = :pseudo AND mot_de_passe = :mdp');
			$req->execute(array('pseudo' => $pseudo, 'mdp' => $mdp));
		}
		$resultat = $req->fetch();
		$req->closeCursor();
		
		// on retourne le resultat
		return $resultat;
	}
