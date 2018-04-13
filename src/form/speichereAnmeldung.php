<?php

/**
 * Created by IntelliJ IDEA.
 * User: julian
 * Date: 11.05.17
 * Time: 09:10
 *
 * https://www.w3schools.com/php/php_forms.asp
 */

function aufarbeiten($text)
{
//überflüssige Leerzeichen entfernen
    $text=trim($text);
// HTML-Tags entfernen
    $text=strip_tags($text);
    //Andere Steuerzeichen konvertieren.
    //Soll für \n helfen.
    //$text = htmlentities($text, ENT_COMPAT, "UTF-8");
// alle Tilde-Zeichen durch Nichts ersetzen
    //Es gibt es einen HTML-Code für ~ : &#126;
    $text=str_replace("~","&#126;",$text);
    return $text;
}


function speichereInput()
{
    //Für was ist diese Abfrage?
    if (/*isset($_POST["submit"])*/ true) {
        $_POST["name"] = aufarbeiten($_POST["name"]);
        $_POST["subject"] = aufarbeiten($_POST["subject"]);
        $_POST["message"] = aufarbeiten($_POST["message"]);

// Fehlermeldungen
        $error = "";
        if (!$_POST["name"]) $error .= "Bitte geben Sie ihren Namen ein.<br>";
        if (!$_POST["subject"]) $error .= "Bitte geben Sie den Betreff an.<br>";
        if (!$_POST["message"]) $error .= "Bitte geben Sie eine Nachricht ein.<br>";
        if ($error) {
// Ausgabe der Fehlermeldung
            echo "<font color='red'> $error </font>";
        } else {

// Datum erzeugen
            $datum = date("d M Y H:i:s");
            //echo $datum;
// Umbrüche im textarea-Bereich durch <br> ersetzen
            //TODO Bug: In gbuch.txt wurde ein Zeilenumbruch geschrieben bei der Nachricht.
            $_POST["message"] = str_replace("\r ", "<br>", $_POST["message"]);
            $_POST["message"] = str_replace("\n", "<br>", $_POST["message"]);
            $_POST["message"] = str_replace("<br><br>", "<br>", $_POST["message"]);

// Eintrag in die Textdatei
            $text = $_POST["name"] . "~"
                . $_POST["subject"] . "~"
                . $datum . "~"
                . $_POST["message"] . "\r\n";

            //echo $text;

            //Nun speichern
            $fh = fopen("gbuch.txt", "a");
            flock($fh, LOCK_EX);
            fputs($fh, $text);
            flock($fh, LOCK_UN);
            fclose($fh);
        }
    }
    else echo "Submit ist nicht gesetzt!";
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


Welcome <?php echo aufarbeiten($_POST["name"]); ?><br>
Betreff: <?php echo aufarbeiten($_POST["subject"]); ?><br>
Nachricht: <?php echo aufarbeiten($_POST["message"]); ?>

</body>
</html>
