<?php
/*###*/
function aufarbeiten($text)
{
    //überflüssige Leerzeichen entfernen
    $text=trim($text);
    // HTML-Tags entfernen
    $text=strip_tags($text);

    // Umbrüche im textarea-Bereich durch <br> ersetzen
    $text = str_replace("\r ", " ", $text);
    $text = str_replace("\n", " ", $text);

    $text = str_replace(";",",",$text);

    return $text;
}


$date_von = aufarbeiten($_POST["date_von"]);
$time_von = aufarbeiten($_POST["time_von"]);
$date_bis = aufarbeiten($_POST["date_bis"]);
$time_bis = aufarbeiten($_POST["time_bis"]);

if(!$date_von||!$time_von||!$date_bis||!$time_bis){
	echo "ERROR";
	return;
}

$scriptData=explode("\n",$_POST['textarea']);

$speichernFile="speichereAnmeldung.php";
$scriptFile="../anmeldungen/dyn.script";
$htmlFile="form.html";
$openFile="../anmeldungen/offen.csv";



$text = $date_von .';'. $time_von .';'. $date_bis .';'. $time_bis ."\r\n";

$fh = fopen($openFile, "w");
flock($fh, LOCK_EX);
fputs($fh, $text);
flock($fh, LOCK_UN);
fclose($fh);

echo "Anmeldezeitraum gespeichert. ";





$finalFile = fopen($htmlFile, "w");	
flock($finalFile, LOCK_EX);

$script= fopen($scriptFile, "w");	
flock($script, LOCK_EX);
	

				
fputs($finalFile, "<div class='col-md-8 order-md-1 mx-auto'>
	<form class='needs-validation' novalidate='' action='".$speichernFile."' method='post'>\n");

foreach($scriptData as $line) {
	fputs($script,$line);

	if(strpos($line,"[br]")!==false)
		fputs($finalFile, "<br>\n");
	else if(strpos($line,"[hr]")!==false)
		fputs($finalFile, "<hr class='mb-4'>\n");
	else{
		fputs($finalFile, "<div class='row'>\n");
		foreach (explode("[",$line) as &$value) {
			$value=str_replace("]","",$value);

			$width=explode("#",$value)[1];
			$tag=explode("=",explode("#",$value)[0])[0];
			$name=explode("=",explode("#",$value)[0])[1];

			if($value!=""){
				if($tag=="text")
					fputs($finalFile,  "<h4 class='mb-3'>".$name."</h4>\n");
				else{
				fputs($finalFile,  "<div class='col-md-".$width." mb-3'>
							<label for='".$name."'>".$name."</label>
							<input class='form-control' id='".$name."' name='".$name."' placeholder='".$name."' required='' type='".$tag."'>
							<div class='invalid-feedback'>
							  ".$name." ungültig
							</div>
						      </div>");
				
		
				}
			}
		}
		fputs($finalFile, "</div>\n");
	}
}
fputs($finalFile,  "<br>\n<button class='btn btn-primary btn-lg btn-block' type='submit'>Submit</button>\n");
fputs($finalFile,  "</form>\n</div>\n");


flock($script, LOCK_UN);
fclose($script);	


flock($finalFile, LOCK_UN);
fclose($finalFile);	

echo "Skript gespeichert";

?>
