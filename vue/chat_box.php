<?php
	//session_start(); // pas besoin vu que les fichiers appelant celui la appelle la même fonction
	if (!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])) // si aucune session active
	{
		header('Location: index.php'); // on va à l'index
	}
?>
<div id="chat_box">
	<div id="chat_box_container"></div>
	<span>Chat Box</span>
</div>
