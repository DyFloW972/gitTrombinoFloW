<?php
header('Content-type: application/json');
include './include/api.inc.php';
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