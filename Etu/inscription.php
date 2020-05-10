<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Formulaire</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>Formulaire d'inscription</h1>
		<a href="index.php"><img src="./images_html/house.webp" class="logo"></a>
	</header>
	<div class="cadre">
	<h2>Remplissez ces champs pour vous inscrire</h2>
	<form action="inscription.php" method="get">
		Vos nom  et prénom :<input placeholder="Nom" type="text" name="nom">  <input placeholder="Prénom" type="text" name="prenom">
		<br>
		Votre classe : <br>
		<input type="radio" name="classe" value="LpiWS">LPI-RIWS
		<input type="radio" name="classe" value="LpiRS">LPI-RS
		<input type="radio" name="classe" value="MIPI">MIPI 
		<br>

		<label>Votre année:</label>
		<select name="groupe">
			<option value="1">1ère année</option>
			<option value="2">2ème année</option>
			<option value="3">3ème année</option>
		</select>
		<br>
		Votre email: 
		<input placeholder="email" type="email" name="ident">

		 Votre mot de passe:
		<input placeholder="mot de passe" type="password" name="mdp">
		<br>
		Confirmez votre mot de passe:
		<input type="password" name="confirm">
		<br>
		<input type="submit" value="Valider" id="sub">
	</form>

	<?php

	include './include/users.inc.php';
	$inscription=souscription();
	echo $inscription

	?>

	


	</div>

</body>
</html>