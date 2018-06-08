<?php

/**
 * Created by IntelliJ IDEA.
 * User: julian
 * Date: 11.05.17
 * Time: 09:10
 *
 * https://www.w3schools.com/php/php_forms.asp
 */

/* Hier wird das Datum gespeichert.
 * Ist auch in index.php */
const filePath = "../anmeldungen/offen.csv";


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

    $date_von = aufarbeiten($_POST["date_von"]);
    $time_von = aufarbeiten($_POST["time_von"]);
    $date_bis = aufarbeiten($_POST["date_bis"]);
    $time_bis = aufarbeiten($_POST["time_bis"]);


    // Fehlermeldungen
    $error = "";
    if (!$date_von  || !$time_von || !$date_bis ||  !$time_bis)
        $error .= "Bitte alle Eingabefelder ausfüllen.<br>";

    //TODO date, time, email überprüfen

    if ($error) {
        // Ausgabe der Fehlermeldung
        echo "<span style=\"color: red; \"> $error </span>";
    } else {

        // Eintrag in die Textdatei
        $text = $date_von .';'. $time_von .';'. $date_bis .';'. $time_bis ."\r\n";
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
        $fh = fopen(file, "w");
        flock($fh, LOCK_EX);
        fputs($fh, $text);
        flock($fh, LOCK_UN);
        fclose($fh);

        echo "Anmeldezeitraum gespeichert. ";
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
?>

</body>
</html>
