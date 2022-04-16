<!-- vu qu'on se connecte à la base de données pour ramener des informations, il faut mettre le code de vérification de session dans cette page aussi -->
<?php
	//session_start(); // pas besoin vu que les fichiers appelant celui la appelle la même fonction
	if (!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])) // si aucune session active
	{
		header('Location: index.php'); // on va à l'index
	}
?>
<div class="header">
	<h1>animebook</h1>
	<ul class="navbar">
		<li id="sub_menu">
			<img id="drop_down" src="icones/down.png" />
			<ul>
				<img class="sub_menu_up" src="icones/sub_menu_up.png" />
				<li><a href="config.php"><img src="icones/config.png" />Parametres</a></li>
				<li><a href="../controleur/go_deconnexion.php"><img src="icones/logout.png" />Déconnexion</a></li>
			</ul>
		</li>
<?php
	if (isset($_SESSION['pseudo'])) // si session active
	{
		// connexion à la bdd en utilisant un fichier qui contient le code de connexion
		include('../modele/connexion_sql.php');
		// requete
		$req = $bdd->prepare('SELECT avatar FROM membres WHERE pseudo = ?');
		$req->execute(array(htmlspecialchars($_SESSION['pseudo'])));
		
		// récupération des données ligne par ligne || 1 par 1
		while ($donnees = $req->fetch())
		{
?>
		<li><a href="profil.php"><img class="image_with_right_marge" src="<?php echo $donnees['avatar'];  ?>" /><?php echo $_SESSION['pseudo']; ?></a></li>
<?php
			
		}

		$req->closeCursor();
	}
?>
		<li><a href="acceuil.php"><img class="image_with_right_marge" src="icones/home.png" />Acceuil</a></li>
	</ul>
</div>
