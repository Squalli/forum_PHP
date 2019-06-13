<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title><?= $result['data']['titre']?> - FORUM</title>
		<link href="https://fonts.googleapis.com/css?family=Lato:400,400i|Amaranth&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="<?=CSS_PATH."normalize.css"?>">
		<link rel="stylesheet" href="<?=CSS_PATH."style.css"?>">
		<link rel="icon" href="favicon.ico">
	</head>
	<body>
		<div id="wrapper"> 
			<header id="site-header">
				
				<h1 id="site-title">
					<a href="index.php">
						ForumTech'
					</a>
				</h1>
				<?php
					include("menu.php");
				?>
					
				
			</header>
			<div id="breadcrumbs">
				<span>
					<i class="fas fa-home"></i>
					Accueil
				<?php 
					//var_dump($_SESSION);
					foreach($result["data"] as $type => $element){
						if(!is_array($element) && $type != "titre"){
							?>
							<span class="separator"><i class="fas fa-chevron-right fa-xs"></i></span>
							<span>
								<?= $element ?>
							</span>
						<?php
						}
					}
					print $messages;
				?>
			</div>
			<main>
				<?= $page ?>
			</main>
			
			<footer>
				<p>&copy; ForumTech' - 2019 - <a href="index.php?control=forum&action=cgu">Mentions Légales</a></p>
			</footer>
		</div>
		
		<script	src="https://code.jquery.com/jquery-3.4.1.min.js"
		  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
		  crossorigin="anonymous"></script>
		<script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js"></script>
		<script>
			tinymce.init({
				selector: '#newpost',
				statusbar: false,
				//plugins: [ 'quickbars' ],
				menubar: false,
			});
		</script>
		<script src="https://kit.fontawesome.com/1e5edb27fe.js"></script>
		<script src="<?=SCRIPT_PATH."main.js"?>"></script>
	</body>
</html>