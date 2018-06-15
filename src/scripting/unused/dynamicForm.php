
<?php
$speichernFile="speichereAnmeldung.php";
$scriptFile="dyn.script";


$handle = fopen($scriptFile, "r");
	

if ($handle) {
								
	echo "<div class='col-md-8 order-md-1 mx-auto'>
		<form class='needs-validation' novalidate='' action='".$speichernFile."' method='post'>";

	while (($line = fgets($handle)) !== false) {
		if(strpos($line,"[br]")!==false)
			echo "<br>";
		if(strpos($line,"[hr]")!==false)
			echo "<hr class='mb-4'>";
		else{
			echo "<div class='row'>";
			foreach (explode("[",$line) as &$value) {
				$value=str_replace("]","",$value);

				$width=explode("#",$value)[1];
				$tag=explode("=",explode("#",$value)[0])[0];
				$name=explode("=",explode("#",$value)[0])[1];

				if($value!=""){
					if($width!=""){
						lookUp($tag,$name,$width);
					}else{
						lookUp($tag,$name);
					}
				}
			}
			echo "</div>";
		}
	}
	echo "<br><button class='btn btn-primary btn-lg btn-block' type='submit'>Submit</button>";
	echo "</form></div>";

	fclose($handle);
} else {
	echo "ERROR WHILE PROCESSING INPUT";
}

function lookUp($tag,$name,$width=100){
//echo $tag.",".$name.",".$width."<br>";
//$width=$width*(12/100);		

	switch($tag){
		case "textfield":
			echo "<div class='col-md-".$width." mb-3'>
				<label for='".$name."'>".$name."</label>
				<input class='form-control' id='".$name."' name='".$name."' placeholder='".$name."' required='' type='text'>
				<div class='invalid-feedback'>
				  ".$name." ungültig
				</div>
			      </div>";
			break;
		case "email":
			echo "<div class='col-md-".$width." mb-3'>
				<label for='email-".$name."'>".$name."</label>
				<input class='form-control' id='email-".$name."' name='email-".$name."' placeholder='".$name."' required='' type='email' >
				<div class='invalid-feedback'>
				  Bitte geben Sie eine gültige E-Mail Adresse ein
				</div>
			      </div>";
			break;
		case "password":
			echo "<div class='col-md-".$width." mb-3'>
				<label for='".$name."'>".$name."</label>
				<input class='form-control' id='".$name."' name='".$name."' placeholder='".$name."' type='password' >
				<div class='invalid-feedback'>
				  Bitte geben Sie einen gültiges Passwort ein
				</div>
			      </div>";
			break;
		case "text":
			echo "<h4 class='mb-3'>".$name."</h4>";
			break;
		
		
			
	}
		
}
?>
