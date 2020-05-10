<?php


	include './include/users.inc.php';

	session_start();
	$ident='';
	$pwd='';
	if (isset($_GET['identifiant'])) {
		$ident=$_GET['identifiant'];
	}
	if (isset($_GET['mdp'])){
		$pwd=$_GET['mdp'];
	}

	
	if(verification($ident,$pwd)){
		$_SESSION['identifiant']=$ident;
		$fichier=fopen('./data/logs.txt','a');
		$write_logs= date("Y-m-d H:i:s")." : ".$_SESSION['identifiant']." has been connected."."\n";
		fwrite($fichier, $write_logs);
		fclose($fichier);
		header('Location: ./donnees.php');
	}
	else{
		header('Location: ./connexion.php?error=WrongId');
	}
	
?>
