
<?php
$speichernFile="speichereAnmeldung.php";
$scriptFile="dyn.script";
$htmlFile="form.html";


$handle = fopen($scriptFile, "r");
$finalFile = fopen($htmlFile, "w");	
flock($finalFile, LOCK_EX);

if ($handle) {						
	fputs($finalFile, "<div class='col-md-8 order-md-1 mx-auto'>
		<form class='needs-validation' novalidate='' action='".$speichernFile."' method='post'>\n");

	while (($line = fgets($handle)) !== false) {
		if(strpos($line,"[br]")!==false)
			fputs($finalFile, "<br>\n");
		if(strpos($line,"[hr]")!==false)
			fputs($finalFile, "<hr class='mb-4'>\n");
		else{
			fputs($finalFile, "<div class='row'>\n");
			foreach (explode("[",$line) as &$value) {
				$value=str_replace("]","",$value);

				$width=explode("#",$value)[1];
				$tag=explode("=",explode("#",$value)[0])[0];
				$name=explode("=",explode("#",$value)[0])[1];

				if($value!=""){
					switch($tag){
						case "textfield":
							fputs($finalFile,  "<div class='col-md-".$width." mb-3'>
								<label for='".$name."'>".$name."</label>
								<input class='form-control' id='".$name."' name='".$name."' placeholder='".$name."' required='' type='text'>
								<div class='invalid-feedback'>
								  ".$name." ungültig
								</div>
							      </div>");
							break;
						case "email":
							fputs($finalFile,  "<div class='col-md-".$width." mb-3'>
								<label for='email-".$name."'>".$name."</label>
								<input class='form-control' id='email-".$name."' name='email-".$name."' placeholder='".$name."' required='' type='email' >
								<div class='invalid-feedback'>
								  Bitte geben Sie eine gültige E-Mail Adresse ein
								</div>
							      </div>");
							break;
						case "password":
							fputs($finalFile,  "<div class='col-md-".$width." mb-3'>
								<label for='".$name."'>".$name."</label>
								<input class='form-control' id='".$name."' name='".$name."' placeholder='".$name."' type='password' >
								<div class='invalid-feedback'>
								  Bitte geben Sie einen gültiges Passwort ein
								</div>
							      </div>");
							break;
						case "text":
							fputs($finalFile,  "<h4 class='mb-3'>".$name."</h4>\n");
							break;
			
					}
				}
			}
			fputs($finalFile, "</div>\n");
		}
	}
	fputs($finalFile,  "<br>\n<button class='btn btn-primary btn-lg btn-block' type='submit'>Submit</button>\n");
	fputs($finalFile,  "</form>\n</div>\n");

	fclose($handle);
} else {
	fputs($finalFile, "ERROR WHILE PROCESSING INPUT");
}


flock($finalFile, LOCK_UN);
fclose($finalFile);	


?>
