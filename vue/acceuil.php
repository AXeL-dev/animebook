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
		<link href="acceuil_style.css" rel="stylesheet" type="text/css" />
		<link href="chat_box_style.css" rel="stylesheet" type="text/css" />
		<link href="posts_style.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<?php
			include('acceuil_header.php');
			include('posts.php');
			include('chat_box.php');
		?>
	</body>
</html>
