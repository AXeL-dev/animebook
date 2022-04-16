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
	</head>

	<body>
		<?php
			// inclusion du header
			include('acceuil_header.php');
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
					<form>
						<span>Pseudo</span><input type="text" readonly="true" value="<?php echo $donnees['pseudo']; ?>" />
						<br />
						<span>Email</span><input type="text" readonly="true" value="<?php echo $donnees['email']; ?>" />
						<br />
						<span>Date d'inscription</span><input type="text" readonly="true" value="<?php echo $donnees['date_inscription']; ?>" />
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
