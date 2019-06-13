	<?php
		$categories = $result['data']['categories'];
	?>
	<h2>Liste des catégories</h2>
	<table>
		<thead>
			<tr>
				<th>Nom</th>
				<th>Nombre de sujets</th>
				<th>Dernier sujet</th>
				<th colspan=2>Options</th>
			</tr>
		</thead>
		<tbody>
	<?php
		if(!empty($categories)){
			foreach($categories as $categorie){
				?>
				<tr class="tr-link" onclick="window.location='index.php?control=forum&action=sujets&id=<?=$categorie['categorie']->getId()?>';">
					
					<td class="td-nom"><?=$categorie['categorie'] ?></td>
					<td class="td-center"><?= $categorie['categorie']->getNbSujets() ?></td>
					
					<td>
						<a href="index.php?control=forum&action=voirTopic&id=<?=$categorie['lastTopic']->getId() ?>">
							<?=$categorie['lastTopic'] ?>
						</a>
						, par 
						<a href="index.php?control=profil&action=voir&id=<?=$categorie['lastTopic']->getUser()->getId() ?>">
							<?=$categorie['lastTopic']->getUser() ?>
						</a>
					</td>
					<td class="td-update">
						<a href="index.php?control=forum&action=modifier&id=<?=$categorie['categorie']->getId() ?>">
							<i class="fas fa-edit"></i>
						</a>
					</td>
					<td class="td-delete">
						<a href="index.php?control=forum&action=supprimer&id=<?=$categorie['categorie']->getId() ?>"
						   onclick="confirm( 'Etes vous sûr de vouloir supprimer la <?=$categorie['categorie'] ?>?' )">
						   <i class="fas fa-times"></i>
						</a>
					</td>
				</tr>	
				<?php
			}
		}
		else echo "Aucune catégorie dans la base";
		
	?>
		</tbody>
	</table>
	<p>
		<em><?=count($categories)?>&nbsp;<?= count($categories) > 1 ? "catégories" : "catégorie"?></em>
	</p>