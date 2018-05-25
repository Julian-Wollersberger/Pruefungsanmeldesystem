<?php
$commands=array();
if ($handle = fopen("inputfile.script", "r")) {
    while (($line = fgets($handle)) !== false) {
	$commands[]=preg_split("[.*]",$line);
    }
    fclose($handle);
} else {}

foreach ($commands as $key => $value) {
    echo $value."<br>";
}
?>
