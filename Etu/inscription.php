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
function souscription(){
	if (isset($_GET['ident'])){
		if ($_GET['mdp']==$_GET['confirm']) {
			$contenu=file('./data/bdd.csv');
			$found= FALSE;
			for ($i=0; $i < sizeof($contenu) ; $i++) { 
				$Clignes= explode(";", $contenu[$i]);
				if ($_GET['ident']==$Clignes[2] && md5($_GET['ident'].$_GET['mdp'])==$Clignes[3]) {
	        		$found=TRUE;
	    		}
	    
			}
			if ($found==TRUE){
	    		echo("<p>Utilisateur déjà enregistré</p>") ;
	    
			}
			else{
        		$Fecriture= fopen("./data/bdd.csv", "a");
				fwrite($Fecriture, $_GET['nom'].";".$_GET['prenom'].";".$_GET['ident'].";".md5($_GET['ident'].$_GET['mdp']).";".$_GET['classe'].";".$_GET['groupe'].";"."\n");
				fclose($Fecriture);	

				$file=fopen('./data/logs.txt','a');
				$write_logs= date("Y-m-d H:i:s")." : ".$_GET['ident']." has been registered."."\n";
				fwrite($file, $write_logs);
				fclose($file);
	   			echo "<<p style='text-align: center;'>Nouvel utilisateur inscrit</p>";	    
	        
			}
	
	
	
	}
	else{
		echo "Mots de passe inscrit différent";
	}
}
}

souscription();

?>

	


	</div>

</body>
</html>