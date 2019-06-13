	<?php
		$sujets    = $result['data']['sujets'];
		$categorie = $result['data']['categorie'];
	?>
	
	<h2><a href="index.php?control=forum&action=index">
			<i class="fas fa-caret-left"></i>
		</a>
		<?= $categorie ?> - <em><?=$categorie->getNbSujets()?>&nbsp;<?= $categorie->getNbSujets() > 1 ? "sujets" : "sujet"?></em>
	</h2>
	<p id="submenu">
		
		<a class="pill-link" href="index.php?control=forum&action=ajouterTopic&id=<?= $categorie->getId() ?>">
			Nouveau sujet
		</a>
	</p>
	<?php
		
		if(!empty($sujets)){
			?>
			<table>
				<thead>
					<tr>
						<th colspan=2>Nom</th>
						<th>Créé par</th>
						<th>Date</th>
						<th>Nombre de messages</th>
						<th>Nombre de vues</th>
						<th colspan=2></th>
					</tr>
				</thead>
			<tbody>
			<?php
			foreach($sujets as $sujet){
				?>
				<tr class="tr-link">
					
						<?= $sujet->getEditable() == 0 ? "<td class='lock'><i class='fas fa-lock'></i></td>" : "<td></td>"?>
					
					<td class="td-title">
						<a href="index.php?control=forum&action=voirTopic&id=<?=$sujet->getId()?>">
							<?= $sujet->getTitre() ?>
						</a>
						
					</td>
					
					<td class="td-center">
						<a href="index.php?control=profil&action=voir&id=<?=$sujet->getUser()->getId()?>">
							<?= $sujet->getUser() ?>
						</a>
					</td>
					<td class="td-center"><?= $sujet->getDatecreation() ?></td>
					<td class="td-center"><?= $sujet->getNbMessages() ?></td>
					<td class="td-center"><?= $sujet->getNbVues() ?></td>
					<?php
					if(Session::isAdmin() || Session::getUser() === $sujet->getUser()){
						?>
						<td class="td-update">
							<a href="index.php?control=forum&action=modifier&id=<?=$sujet->getId() ?>">
								<i class="fas fa-edit fa-2x"></i>
							</a>
						</td>
						<td class="td-delete">
							<a class="ajax-link" 
							   href="index.php?control=forum&action=lock&id=<?=$sujet->getId()?>" 
							   data-action="lock" data-target="<?= $sujet->getId()?>">
							   <?php
								if($sujet->getEditable()){
									echo "<i class='fas fa-lock fa-2x'></i>";
								}
								else{
									echo "<i class='fas fa-unlock fa-2x'></i>";
								}
								?>
							</a>
						</td>
						<?php
					}
					else{
						?>
						<td colspan=2></td>
						<?php
					}	
					?>
				</tr>	
				<?php
			}
			?>
				</tbody>
		
			</table>
			<?php
		}
		else{
			?>
			<p class="td-center">Aucun sujet dans cette catégorie</p>
			<?php
		}
		
	?>
