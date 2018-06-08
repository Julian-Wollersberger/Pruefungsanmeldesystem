<?php

/**
 * Created by IntelliJ IDEA.
 * User: julian
 * Date: 11.05.17
 * Time: 09:10
 *
 * https://www.w3schools.com/php/php_forms.asp
 */

/** überflüssige Leerzeichen entfernen, strip_tags,
 * Strichpunkte durch Beistriche ersetzen.
 */
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


function speichereInput() {


	foreach( $_POST as $key => $value ) {
		if(!$value)
			$error.=$key." is empty\n";
	}



	if ($error) {
	// Ausgabe der Fehlermeldung
		echo "<span style=\"color: red; \"> $error </span>";
	} else {
		/** Beim Erstellen werden wahrscheinlich die Berechtigungen nicht passen.
		* Der Benutzer kann bei jedem Server anders sein.
		*
		* Find apache user:
		* ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1
		* Permission:
		* sudo chown daemon anmeldungen.csv
		*/


		// Eintrag in die Textdatei

		$fh = fopen("../anmeldungen/anmeldungen.csv", "a");
		flock($fh, LOCK_EX);

		foreach( $_POST as $key => $value ){
			//echo $value.";";
			fputs($fh, $value.";");			
		}
		fputs($fh, "\n");
		flock($fh, LOCK_UN);
		fclose($fh);

		echo "Anmeldung gespeichert. ";
		

	}
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>
        Anmeldung
    </title>
</head>
<body>

<?php
    speichereInput();
    //echo "<script language='Javascript'> window.close(); </script>";
?>

</body>
</html>
