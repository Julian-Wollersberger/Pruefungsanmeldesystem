<?php

require("pfade.php");

$data = $_POST['textarea'];

if ($data) {
    $csvHandle = fopen(anmeldungenFilePath, "w");

    if ($csvHandle) {
        flock($csvHandle, LOCK_EX);
        fputs($csvHandle, $data);
        flock($csvHandle, LOCK_UN);
        fclose($csvHandle);

        echo "Daten gespeichert";
    }
}

?>
