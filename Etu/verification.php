<?php


	function verification($id,$mdp){
		
			$lecture=file('./data/bdd.csv');
			$found= FALSE;
			for ($i=0; $i < sizeof($lecture) ; $i++) { 
				$Rlignes= explode(";", $lecture[$i]);
				if ($id==$Rlignes[2] && md5($id.$mdp)==$Rlignes[3]) {
	        		$found=TRUE;
	    		}
	    
			}
			return $found;
		}


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
