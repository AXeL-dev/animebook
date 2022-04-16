<?php
	if (!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])) // si aucune session active
	{
		header('Location: index.php'); // on va à l'index
	}
?>
<div id="news_box">
	<form>
		<span class="btns" id="btn_fermer" onclick="this.parentNode.style.display = 'none';">x</span>
		<span class="btns" id="btn_agrandir" onclick="var txtArea = this.nextSibling.nextSibling.nextSibling.nextSibling; if (txtArea.style.height != '150px') txtArea.style.height = '150px'; else txtArea.style.height = '90px'">&#9858;</span>
		<br />
		<textarea placeholder="Exprimez-vous"></textarea>
		<br />
		<input id="btn_publier" type="submit" value="publier" />
	</form>
</div>
