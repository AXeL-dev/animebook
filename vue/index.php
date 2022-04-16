<!DOCTYPE html>
<html>
	<head>
		<title>Bienvenue sur animebook !</title>
		<meta charset="utf-8" />
		<link href="index_style.css" rel="stylesheet" type="text/css" />
		<link href="error_msg_style.css" rel="stylesheet" type="text/css" />
		<link href="index_header_style.css" rel="stylesheet" type="text/css" />
		<link href="inscription_style.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<?php
			session_start();
			if (isset($_SESSION['id']) AND isset($_SESSION['pseudo'])) // si session active
			{
				header('Location: acceuil.php'); // on va à l'acceuil
			}
			else
			{
				if (isset($_GET['erreur_cnx'])) // si erreur de connexion on l'affiche avant le header
				{
					$erreur = htmlspecialchars($_GET['erreur_cnx']); // on évite la faille XSS
					switch ($erreur)
					{
						case 1:
							echo '<div class="error_msg">Veuillez saisir un pseudo et un mot de passe !</div>'; break;
						case 2:
							echo '<div class="error_msg">Pseudo ou mot de passe incorrect !</div>'; break;
					}
				}

				include('index_header.php'); // on inclus le header (en-tête)

				if (!isset($_GET['erreur_cnx']) AND isset($_GET['erreur_inscr'])) // si erreur d'inscription on l'affiche après le header
				{
					$erreur = htmlspecialchars($_GET['erreur_inscr']); // on évite la faille XSS
					switch ($erreur)
					{
						case 1:
							echo '<div class="error_msg">Vous devez remplir tout les champs pour vous inscrire !</div>'; break;
						case 2:
							echo '<div class="error_msg">Le mot de passe et la confirmation ne sont pas identique !</div>'; break;
						case 3:
							echo '<div class="error_msg">Erreur d\'inscription, veuillez réesayer plustard !</div>'; break;
						case 4:
							echo '<div class="error_msg">Le pseudo que vous avez choisi existe déjà !</div>'; break;
					}
				}

				include('inscription.php'); // on ajoute le formulaire d'inscription
			}
		?>
	</body>
</html>
