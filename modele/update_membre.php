<?php
	// on met à jour un membre
	function update_membre($current_pseudo, $pseudo, $mdp, $email)
	{
		global $bdd;
		
		// on demande les informations
		$req = $bdd->prepare('UPDATE membres SET pseudo = :pseudo, mot_de_passe = :mdp, email = :email WHERE pseudo = :current_pseudo');
		$req->execute(array('pseudo' => $pseudo, 'mdp' => $mdp, 'email' => $email, 'current_pseudo' => $current_pseudo));
	}
