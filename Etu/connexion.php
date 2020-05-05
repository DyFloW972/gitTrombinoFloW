<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>	
		<h1>Connexion à l'espace</h1>
		<a href="index.php"><img src="./images_html/house.webp" class="logo"></a>
	</header>
	<div class="cadre">
		<h2>Connectez vous pour avoir accès à vos données</h2>
		<?php
		if (isset($_GET['error'])) {
			echo "<p style='color: red; text-align: center;'>Identifiant ou mot de passe incorrect. Veuillez réessayer.</p>";
		}?>
		<form  action="./verification.php" method="get">
		Votre identifiant : <input placeholder="email" type="email" name="identifiant">
		Votre mot de passe : <input placeholder="mot de passe" type="password" name="mdp">
		<input type="submit" value="Valider" id="sub">
	    </form>
	<p class="souscription">Pas encore Inscrit? <a class="form" href="inscription.php"><strong>Cliquez ici</strong>
	</a></p>

	</div>
</body>
</html>