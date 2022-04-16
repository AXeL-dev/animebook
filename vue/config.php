<?php
	session_start();
	if (!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])) // si aucune session active
	{
		header('Location: index.php'); // on va à l'index
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $_SESSION['pseudo']; ?></title>
		<meta charset="utf-8" />
		<link href="index_style.css" rel="stylesheet" type="text/css" />
		<link href="acceuil_header_style.css" rel="stylesheet" type="text/css" />
		<link href="chat_box_style.css" rel="stylesheet" type="text/css" />
		<link href="profil_config_style.css" rel="stylesheet" type="text/css" />
		<link href="error_msg_style.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<?php
			// inclusion du header
			include('acceuil_header.php');
			// si erreur d'inscription
			if (isset($_GET['erreur_inscr'])) // on l'affiche après le header
			{
				$erreur = htmlspecialchars($_GET['erreur_inscr']); // on évite la faille XSS
				switch ($erreur)
				{
					case 0:
						echo '<div class="error_msg">Modifications réussis !</div>'; break;
					case 1:
						echo '<div class="error_msg">Vous devez remplir tout les champs !</div>'; break;
					case 2:
						echo '<div class="error_msg">Le mot de passe et la confirmation ne sont pas identique !</div>'; break;
					case 3:
						echo '<div class="error_msg">Erreur d\'inscription, veuillez réesayer plustard !</div>'; break;
					case 4:
						echo '<div class="error_msg">Le pseudo que vous avez choisi existe déjà !</div>'; break;
				}
			}
			// connexion à la bdd en utilisant un fichier qui contient le code de connexion
			include('../modele/connexion_sql.php');
			// requete
			$req = $bdd->prepare('SELECT * FROM membres WHERE pseudo = ?');
			$req->execute(array(htmlspecialchars($_SESSION['pseudo'])));
		
			// récupération des données ligne par ligne || 1 par 1
			while ($donnees = $req->fetch())
			{
	?>
				<div id="profil_container">
					<img id="profil_avatar" src="<?php echo $donnees['avatar']; ?>" />
					<form action="../controleur/go_update.php" method="post">
						<span>Pseudo</span><input type="text" name="pseudo" value="<?php echo $donnees['pseudo']; ?>" />
						<br />
						<span>Mot de passe</span><input type="password" name="mot_de_passe" value="" />
						<br />
						<span>Confirmation du mot de passe</span><input type="password" name="confirm_mot_de_passe" value="" />
						<br />
						<span>Email</span><input type="text" name="email" value="<?php echo $donnees['email']; ?>" />
						<br />
						<br />
						<input type="submit" value="Enregistrer les modifications" />
					</form>
				</div>
	<?php
			
			}

			$req->closeCursor();
			// inclusion de la chat box
			include('chat_box.php');
		?>
	</body>
</html>
