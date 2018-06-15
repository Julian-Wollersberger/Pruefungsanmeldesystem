<?php

$data=explode("\n",$_POST['textarea']);
if($data){
	$csvHandle = fopen("../anmeldungen/anmeldungen.csv", "w");	

	if($csvHandle){
		flock($csvHandle,LOCK_EX);
		foreach($data as $line){
			echo $line;
			fputs($csvHandle,$line);
		}
		flock($csvHandle,LOCK_UN);
		fclose($csvHandle);
	}
}

?>
