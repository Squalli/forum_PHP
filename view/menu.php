	
	<?php 
		if(Session::getUser()){
			?>
			<nav id="user-menu">
				<span class="user-profile-button">
					<img src="<?= IMG_PATH."avatars/".Session::getUser()->getAvatar()?>" class="medium-img">
					<strong><?= Session::getUser()?></strong>
				</span>
				<a title="Mon profil" href='index.php?control=profil'>
					<i class="fas fa-user-edit fa-2x"></i>
				</a>
				<a title="Déconnexion" href='index.php?control=security&action=logout'>
					<i class="fas fa-power-off fa-2x"></i>
				</a>
			</nav>
			<?php
		} 
		else{
			?>
			<nav id="offline-menu">
				<a class="pill-link" href="index.php?control=security&action=login">
					<i class="fas fa-sign-in-alt"></i>&nbsp;Connexion
				</a>
				<a class="pill-link" href="index.php?control=security&action=register">
					<i class="fas fa-user-plus"></i>&nbsp;Inscription
				</a>
			</nav>
			<?php
		}
	?>
	