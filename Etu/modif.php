<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Modification</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>Modifier vos informations</h1>
		<a href="index.php"><img src="./images_html/house.webp" class="logo"></a>
		<a href="donnees.php"><img src="./images_html/fleche.png" class="logo" id="arrow"></a>
	</header>
	<div class="cadre">
	<h2>Modifiez vos informations ci-dessous</h2>
	<form action="modif.php" method="get" enctype="multipart/form-data">
		Vos nom  et prénom :<input placeholder="Nom" type="text" name="nom" value="<?php echo $_SESSION['nom'];?>">  <input placeholder="Prénom" type="text" name="prenom" value="<?php echo $_SESSION['prenom'];?>">
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
		<input placeholder="email" type="email" name="ident" value="<?php echo $_SESSION['identifiant'];?>">

		 Votre mot de passe:
		<input placeholder="mot de passe" type="password" name="mdp">
		<br>
		<input type="submit" value="Valider" id="sub">
		<br>


	</form>

<?php
	if (isset($_GET['ident'])) {
		if ($monfichier = fopen('./data/bdd.csv', 'r'))
	{
    $newcontenu = '';
    // Variable contenant la nouvelle ligne :
    $nouvelle_ligne = $_GET['nom'].";".$_GET['prenom'].";".$_GET['ident'].";".md5($_GET['ident'].$_GET['mdp']).";".$_GET['classe'].";".$_GET['groupe'].";"."\n";
    // Lecture du fichier ligne par ligne :
    while (($ligne = fgets($monfichier)) !== FALSE)
    {
    	$DonLine=explode(";", $ligne);
        // Si le numéro de la ligne est égal au numéro de la ligne à modifier :
        if ($_SESSION['identifiant'] == $DonLine[2])
        {
            $newcontenu = $newcontenu . $nouvelle_ligne;
        }
        // Sinon, on réécri la ligne
        else
        {
            $newcontenu = $newcontenu . $ligne;
        }   
    }
    fclose($monfichier);
    $fichierecriture = fopen('./data/bdd.csv', 'w');
    fputs($fichierecriture, $newcontenu);
    fclose($fichierecriture);

	$_SESSION['identifiant']=$_GET['ident'];
	$fichier=fopen('./data/logs.txt','a');
	$write_logs= date("Y-m-d H:i:s")." : ".$_SESSION['identifiant']." modified his informations."."\n";
	fwrite($fichier, $write_logs);
	fclose($fichier);
	echo("<p style='text-align: center;'>Données modifiées</p>");
    
}
}


?>
   
		
	</div>

</body>
</html>