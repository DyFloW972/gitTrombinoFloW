<?php session_start(),?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Modification</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Modifier vos informations</h1>
	<div class="cadre">
	<h2>Modifiez vos informations ci-dessous</h2>
	<form action="modif.php" method="get">
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
		<input placeholder="email" type="email" name="ident">

		 Votre mot de passe:
		<input placeholder="mot de passe" type="password" name="mdp">

		<br>
		<input type="submit" value="Valider" id="sub">
	</form>

<?php
	if (isset($_GET['ident'])) {
		if ($monfichier = fopen('bdd.csv', 'r'))
	{
    $newcontenu = '';
    // Variable contenant la nouvelle ligne :
    $nouvelle_ligne = $_GET['nom'].";".$_GET['prenom'].";".$_GET['ident'].";".md5($_GET['ident'].$_GET['mdp']).";".$_GET['classe'].";".$_GET['groupe'].";"."\n";
    // Lecture du fichier ligne par ligne :
    while (($ligne = fgets($monfichier)) !== FALSE)
    {
    	$DonLine=explode(";", $ligne);
        // Si le numéro de la ligne est égal au numéro de la ligne à modifier :
        if ($_GET['ident'] == $DonLine[2])
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
    $fichierecriture = fopen('bdd.csv', 'w');
    fputs($fichierecriture, $newcontenu);
    fclose($fichierecriture);
    echo("<p>Données modifiées</p>");
}
}              
?>
		
	</div>

</body>
</html>