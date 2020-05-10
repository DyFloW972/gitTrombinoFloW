<?php
session_start();
include './include/donnees.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Données personnelles</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
</head>
<body>
	<header>
		<h1>Vos données personnelles</h1>
		<a href="index.php"><img src="./images_html/house.webp" class="logo"></a>
		<a href="destroy.php"><img src="./images_html/destroy.png" class="logo" id="arrow"></a>

	</header>
	<div class="cadre">
		<p>Sélectionner/changer photo de profil</p>
		<form class="upload" method="post" enctype="multipart/form-data" action="donnees.php">
			<input type="file" name="fichier" size="30">
			<input type="submit" name="upload" value="Uploader">
		</form>
		<?php
			$identite=recup();
		
			$_SESSION['nom']=$identite[0];
			$_SESSION['prenom']=$identite[1];
			$_SESSION['mdp']=$identite[3];

		?>

		
		<h2>Fiche identitaire de <?php echo $identite[1]; ?></h2>




		<?php 
			if( isset($_POST['upload']) ){
    			$content_dir = 'images/'; // dossier où sera déplacé le fichier

    			$tmp_file = $_FILES['fichier']['tmp_name'];

    			if( !is_uploaded_file($tmp_file) ){
        			exit("Le fichier est introuvable");
    			}

    			$type_file = $_FILES['fichier']['type'];

    			if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'png')){
        			exit("Le fichier n'est pas une image adéquate");
    			}
				if ($_FILES['fichier']['type'] == 'image/jpeg') { $extention = '.jpg'; }
				if ($_FILES['fichier']['type'] == 'image/jpg') { $extention = '.jpg'; }
				if ($_FILES['fichier']['type'] == 'image/png') { $extention = '.jpg'; }
				

    // on copie le fichier dans le dossier de destination
    			$name_file = $identite[2].$extention;

    			if( !move_uploaded_file($tmp_file, $content_dir . $name_file) ){
        			exit("Impossible de copier le fichier dans $content_dir");
    			}
    			$fichier=fopen('./data/logs.txt','a');
				$write_logs= date("Y-m-d H:i:s")." : ".$_SESSION['identifiant']." put a new profile photo."."\n";
				fwrite($fichier, $write_logs);
				fclose($fichier);

			}
		

		?>
<img src="<?php echo 'images/' . basename($_SESSION['identifiant'].".jpg");?>" alt='image to upload'>

		
		<p id="infos"><strong>Nom</strong> : <?php echo $identite[0]; ?></p>
		

		<p id="infos"><strong>Prénom</strong> : <?php echo $identite[1]; ?></p>
		
		<p id="infos"><strong>Adresse mail</strong> : <?php echo $identite[2]; ?></p>
		

		<p id="infos"><strong>Classe </strong>: <?php echo $identite[4]."-". $identite[5] ;?> </p>

		<p class="souscription">Vous voulez modifier vos informations? <a class="form" href="modif.php"><strong>Cliquez ici</strong>
	</a></p>

		


	</div>

</body>
</html>