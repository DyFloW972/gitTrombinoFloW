<?php
session_start();
$_SESSION['ident']=$_GET['ident'];
function verification(){
	$lecture=file('bdd.csv');
	$found= FALSE;
	for ($i=0; $i < sizeof($lecture) ; $i++) { 
		$Rlignes= explode(";", $lecture[$i]);
		$Rlignes[1]=str_replace("\n","",$Rlignes[1]);
		if ($_GET['ident']==$Rlignes[2] && md5($_GET['ident'].$_GET['mdp'])==$Rlignes[3]) {
	        $found=TRUE;
	    }
	    
	}
	if ($found==TRUE){
	    header("Location: ./donnees.php");
	    exit();
	}
	else{
	    header("Location: ./connexion.html");
	    exit();
	}
}
verification()
?>