<?php
function souscription(){
	$contenu=file('bdd.csv');
	$found= FALSE;
	for ($i=0; $i < sizeof($contenu) ; $i++) { 
		$Clignes= explode(";", $contenu[$i]);
		$Clignes[1]=str_replace("\n","",$Clignes[1]);
		if ($_GET['ident']==$Clignes[2] && md5($_GET['ident'].$_GET['mdp'])==$Clignes[3]) {
	        $found=TRUE;
	    }
	    
	}
	if ($found==TRUE){
	    exit("Utilisateur déjà enregistré") ;
	    
	}
	else{
		


        $Fecriture= fopen("bdd.csv", "a");
		fwrite($Fecriture, $_GET['nom'].";".$_GET['prenom'].";".$_GET['ident'].";".md5($_GET['ident'].$_GET['mdp']).";".$_GET['classe'].";".$_GET['groupe']."\n");
		fclose($Fecriture);	
	   	echo "Utilisateur enregistré. \n";	    
	        
	}
	
	
	
}
souscription();

?>