<?php
header('Content-type: application/json');
function ApiEtu($filliere, $groupe){
	

	$recup_donnees=file('./data/bdd.csv');
	$infoEtu['name']=$filliere."-".$groupe;
	$infoEtu['student']=array();

	for ($i=0; $i <sizeof($recup_donnees) ; $i++) { 
		$Ligne=explode(";", $recup_donnees[$i]);
		$tableau=array();
		if ($filliere == $Ligne[4] && $groupe == $Ligne[5]) {
			$tableau[$i]['Nom']=$Ligne[0];
			$tableau[$i]['Prénom']=$Ligne[1];
			$tableau[$i]['Mail']=$Ligne[2];
			$tableau[$i]['Classe']=$Ligne[4];
			$tableau[$i]['Groupe']=$Ligne[5];
		}
		else{
			continue;
		}

		array_push($infoEtu['student'],$tableau[$i]);
	}
	return($infoEtu);

}


function Tabajason($tab){
	return json_encode($tab);
}
function KeyApi($verif){
	$recup_key=file('./data/mail_api.csv');
	$found=FALSE;
	for ($i=0; $i < sizeof($recup_key) ; $i++) { 
		$line=explode(";", $recup_key[$i]);
		if ($verif==$line[1]) {
			$found=TRUE;
			}
		}
			return $found;
}
$api_key=$_GET['key'];
if (KeyApi($api_key)) {
	$info= ApiEtu($_GET['classe'],$_GET['groupe']);
	$jayson= Tabajason($info);

	$fichier=fopen('./data/logs.txt','a');
	$write_logs= date("Y-m-d H:i:s")." : "."Api key was used with key ".$api_key.".\n";
	fwrite($fichier, $write_logs);
	fclose($fichier);
}
else{
	$erreur="Clé incorrecte";
	$jayson= Tabajason($erreur);
}

echo $jayson;


?>