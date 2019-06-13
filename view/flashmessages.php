	<?php
	
	foreach(Session::getFlashes() as $type => $list){
		?>
		<div class="message <?= $type ?>">
		<?php
			foreach($list as $msg){
				echo "<p>".$msg."</p>";
			}
		?>
		</div>
		<?php
	}
	?>