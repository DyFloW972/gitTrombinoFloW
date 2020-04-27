<?php
header('Content-type: application/json');
function ApiEtu($filliere, $groupe){
	

	$recup_donnees=file('bdd.csv');
	$infoEtu=array();

	for ($i=0; $i <sizeof($recup_donnees) ; $i++) { 
		$Ligne=explode(";", $recup_donnees[$i]);
		$tableau=array();
		if ($filliere == $Ligne[4] && $groupe == $Ligne[5]) {
			$tableau[$i]['Nom']=$Ligne[0];
			$tableau[$i]['Prénom']=$Ligne[1];
			$tableau[$i]['Mail']=$Ligne[2];
			$tableau[$i]['Classe']=$Ligne[4];
			$tableau[$i]['Groupe']=$Ligne[5];.
		}

		array_push($infoEtu,$tableau);
	}
	return($infoEtu);

}


function Tabajason($tab){
	return json_encode($tab);
}

$info= ApiEtu('LpiWS','1');
$jayson= Tabajason($info);

echo $jayson;


?>