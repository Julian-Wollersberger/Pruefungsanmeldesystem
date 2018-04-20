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

    $firstName = aufarbeiten($_POST["fistName"]);
    $lastName = aufarbeiten($_POST["lastName"]);
    $email = aufarbeiten($_POST["email"]);
    $class = aufarbeiten($_POST["class"]);
    $date = aufarbeiten($_POST["date"]);
    $time = aufarbeiten($_POST["time"]);

    // Fehlermeldungen
    $error = "";
    if (!$firstName . $lastName . $email . $class . $date . $time)
        $error .= "Bitte alle Eingabefelder ausfüllen.<br>";

    //TODO date, time, email überprüfen
    /*
     * //check for a valid email address
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $error[] = 'Please enter a valid email address';
    }*/

    if ($error) {
        // Ausgabe der Fehlermeldung
        echo "<span style=\"color: red; \"> $error </span>";
    } else {

        // Eintrag in die Textdatei
        $text = !$firstName . $lastName . $email . $class . $date . $time;
        //echo $text;

        //Nun speichern
        $fh = fopen("anmeldungen.csv", "a");
        flock($fh, LOCK_EX);
        fputs($fh, $text);
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
        Gästebuch
    </title>
    <link rel="stylesheet" type="text/css" href="css/meine_website.css">
</head>
<body>

<?php
    speichereInput();
    echo "<script language='Javascript'> window.close(); </script>";
    // Das dort unten ist Debug-Zeug.
?>

</body>
</html>
