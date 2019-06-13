<?php
	$categorie = $result['data']['categorie'];

?>

<h2><?= $categorie?> - Ajouter un sujet</h2>

<form action="index.php?control=forum&action=ajouterTopic&id=<?= $categorie->getId()?>" method="post">
	<input type="text" name="titre" placeholder="Titre du sujet"><br>
	<textarea id="newpost" name="message"></textarea><br>
	<input class="pill-link" type="submit" value="Ajouter">
</form>
	