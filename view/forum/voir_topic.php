	<?php
		$messages  = $result['data']['messages'];
		$sujet     = $result['data']['sujet'];
		$categorie = $result['data']['categorie'];
	?>
	
	<h2>
		<a href="index.php?control=forum&action=sujets&id=<?= $categorie->getId()?>">
			<i class="fas fa-caret-left"></i>
		</a>
		<?= $sujet ?> - <em><?=$sujet->getNbMessages()?>&nbsp;<?= $sujet->getNbMessages() > 1 ? "messages" : "message"?></em>
	</h2>
	
	<p id="submenu">
		<?php 
			if(Session::isAdmin() || $sujet->getUser() == Session::getUser()){
			?>
			<a class="pill-link" href="index.php?control=forum&action=lock&id=<?= $sujet->getId() ?>">
				<?= $sujet->getEditable() ? 
					"<i class='fas fa-lock'></i>&nbsp;Clore ce sujet" : 
					"<i class='fas fa-unlock'></i>&nbsp;Réactiver ce sujet"
				?>
			</a>
			<?php
		}
		?>
	</p>
	<?php
		
		if(!empty($messages)){
			?>
			
			<?php
			foreach($messages as $message){
				?>
				<article class="post">
					<header class="post-header">
						<a class="user-profile-button" href="index.php?control=profil&action=voir&id=<?=$message->getUser()->getId()?>">
							<img src="<?= IMG_PATH."avatars/".$message->getUser()->getAvatar()?>" class="mini-img">
							<strong><?= $message->getUser()?></strong>
						</a><br>
						<em><?= $message->getDatecreation() ?></em>
					</header>
					
					<div class="post-text">
						<?= $message->getText(); ?>
						<?php 
						if(Session::isAdmin() || $message->getUser() == Session::getUser()){
							?>
							<div class="edit-message">
								<a class="pill-link" href="index.php?control=forum&action=editMessage&id=<?=$message->getId() ?>">
									<i class="fas fa-edit"></i>&nbsp;Modifier
								</a>
							</div>
							<?php
						}
						?>
					</div>
					
				</article>
				<hr>	
				<?php
			}
		}
		else{
			?>
			<p class="td-center">Aucun message dans ce sujet</p>
			<?php
		}
		
	if(Session::getUser() && $sujet->getEditable()){
		?>
		<form method="post" action="index.php?control=forum&action=ajouterPost&id=<?= $sujet->getId()?>">
			<textarea id="newpost" name="message"></textarea><br>
			<input class="pill-link" type="submit" value="Envoyer le message">
		</form>
		
		<?php
	}
	elseif(!$sujet->getEditable()){
		?>
		<p>Le sujet est clos !</p>
		<?php
	}
	else{
		?>
		<p>Vous devez être connecté pour pouvoir répondre !</p>
		<?php
	}
?>
	
