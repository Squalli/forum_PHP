
	<h2>Inscription</h2>

	<form method="post" action="index.php?control=security&action=register" enctype="multipart/form-data">
		<input type="email" name="email" placeholder="Votre E-mail...">*<br>
		<input type="text" name="pseudo" placeholder="Votre pseudo...">*<br>
		<input type="password" name="password" placeholder="Votre mot de passe...">*
		<input type="password" name="pass-repeat" placeholder="Répétez le mot de passe...">*<br>
		<label for="sexe">Sexe : 
			<select name="sexe">
				<option selected>-</option>
				<option value="M">Homme</option>
				<option value="F">Femme</option>
			</select>
		</label><br>
		<label for="avatar">Avatar :<input type="file" name="avatar" placeholder="Choisir un avatar..."></label><br>
		<input type="submit" value="Valider">
	</form>

