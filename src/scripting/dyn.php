<?php
/*###*/
function refac($text)
{

    $text=trim($text);

    $text=strip_tags($text);


    $text = str_replace("\r ", "", $text);
    $text = str_replace("\n", "", $text);

    $text = str_replace(";",",",$text);

    return $text;
}


$date_von = refac($_POST["date_von"]);
$time_von = refac($_POST["time_von"]);
$date_bis = refac($_POST["date_bis"]);
$time_bis = refac($_POST["time_bis"]);

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

	fputs($finalFile, "<div class='row'>\n");
	foreach (explode("[",$line) as &$value) {
		$value=str_replace("]","",$value);

		$width=explode("#",$value)[1];
		$tag=explode("=",explode("#",$value)[0])[0];
		$name=explode("=",explode("#",$value)[0])[1];

		if($value!=""){
			fputs($finalFile,lookup($tag,$name,$width));
		}
	}
	fputs($finalFile, "</div>\n");
}
fputs($finalFile,  "<br>\n<button class='btn btn-primary btn-lg btn-block' type='submit'>Submit</button>\n");
fputs($finalFile,  "</form>\n</div>\n");



flock($script, LOCK_UN);
fclose($script);	


flock($finalFile, LOCK_UN);
fclose($finalFile);	

echo "Skript gespeichert";

function lookup($tag,$name,$width){
	$tag=refac($tag);


	switch($tag){
		case "":
		case "br":
			return "</div>\n<br>\n<div class='row'>\n";
		case "---":
		case "hr":
			return "</div>\n<hr class='mb-4'>\n<div class='row'>\n";
		case "text":
			return "<h4 class='mb-3'>".$name."</h4>\n";
		case "textfield":
		case "email":
		case "date":
		case "time":
			return "<div class='col-md-".$width." mb-3'>
			<label for='".$name."'>".$name."</label>
			<input class='form-control' id='".$name."' name='".$name."' placeholder='".$name."' required='' type='".$tag."'>
			<div class='invalid-feedback'>
			  ".$name." ungültig
			</div>
		      </div>";
		default:
			echo "<br>Unknown Tag: '".$tag."'<br>\n";
					
			
	}
}

?>
