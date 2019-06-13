<?php

	$user = $result['data']['user'];
	
?>


<section id="profile">
	<div id="profile-avatar">
		<h2><?= $user ?></h2>
		<figure>
			<img src="<?= IMG_PATH."avatars/".$user->getAvatar() ?>"><br>
			<?php
				if(Session::getUser() == $user){
					?>
					<figcaption>
						<a href="">Modifier mon avatar</a>
					</figcaption>
					<?php
				}
			?>	
		</figure>
	</div>
	<div id="profile-info">
		<dl>
			<dt>Nom d'utilisateur :</dt>
			<dd><?= $user->getPseudo()?></dd>
			<dt>Sexe :</dt>
			<dd><?= $user->getSexe() !== null ? $user->getSexe() : "NC"?></dd>
			<dt>Adresse e-mail :</dt>
			<dd><?= $user->getEmail()?></dd>
			<dt>Membre depuis le :</dt>
			<dd><?= $user->getDateinscription()?></dd>
		
		</dl>
		<?php
		if(Session::getUser() == $user){
			?>
			<p>
				<a href="">Modifier mes informations</a>
			</p>
			<?php
		}
		?>	
	</div>
	
	
	
</section>


