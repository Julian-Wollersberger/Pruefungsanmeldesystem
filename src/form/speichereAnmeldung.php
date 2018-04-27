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
    $text=trim($text);cherschers
    // HTML-Tags entfernen
    $text=strip_tags($text);

    // Umbrüche im textarea-Bereich durch <br> ersetzen
    $text = str_replace("\r ", " ", $text);
    $text = str_replace("\n", " ", $text);

    $text = str_replace(";",",",$text);

    return $text;
}


function speichereInput() {

    $firstName = aufarbeiten($_POST["firstName"]);
    $lastName = aufarbeiten($_POST["lastName"]);
    $email = aufarbeiten($_POST["email"]);
    $class = aufarbeiten($_POST["class"]);
    $date = aufarbeiten($_POST["date"]);
    $time = aufarbeiten($_POST["time"]);

    // Fehlermeldungen
    $error = "";
    if (!$firstName || !$lastName || !$email ||  !$class || !$date || !$time)
        $error .= "Bitte alle Eingabefelder ausfüllen.<br>";

    //TODO date, time, email überprüfen

    //check for a valid email address
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $error .= "Die E-Mail-Adresse $email ist ungültig.<br>";
    }

    if ($error) {
        // Ausgabe der Fehlermeldung
        echo "<span style=\"color: red; \"> $error </span>";
    } else {

        // Eintrag in die Textdatei
        $text = $firstName .';'. $lastName .';'. $email .';'. $class .';'. $date .';'. $time ."\r\n";
        //echo $text;

        /** Beim Erstellen werden wahrscheinlich die Berechtigungen nicht passen.
         * Der Benutzer kann bei jedem Server anders sein.
         *
         * Find apache user:
         * ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1
         * Permission:
         * sudo chown daemon anmeldungen.csv
         */
        //Nun speichern
        $fh = fopen("../anmeldungen/anmeldungen.csv", "a");
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
        NOST
    </title>
</head>
<body>

<?php
    speichereInput();
    echo "<script language='Javascript'> window.close(); </script>";
    // Das dort unten ist Debug-Zeug.
?>

</body>
</html>
