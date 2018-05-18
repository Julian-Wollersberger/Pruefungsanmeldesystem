<?php
/**
 * Created by PhpStorm.
 * User: julian
 * Date: 27.04.18
 * Time: 15:13
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



     return $text;
 }




 if (file_exists("../anmeldungen/offen.csv"))
 {
   $eintrag=file("../anmeldungen/offen.csv");

   if($eintrag){

     $element=explode(";",aufarbeiten($eintrag[0]));

     $date_von=$element[0];
     $time_von=$element[1];
     $date_bis=$element[2];
     $time_bis=$element[3];
   }
   else {
     $date_von="";
     $time_von="";
     $date_bis="";
     $time_bis="";
   }
 }

$today=date("m/d/Y H:i");
$von=$date_von." ".$time_von;
$bis=$date_bis." ".$time_bis;

echo $time_von;
echo $von;


if($today>$von && $today<$bis)
{
    echo "<span style=\"color: red; \"> Nice </span>";
}
else {
    echo "<span style=\"color: red; \"> nd nice </span>";
}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>dhdrh</title>

    <!-- Bootstrap core CSS -->
    <link href="form/bootstrap.css" rel="stylesheet">

    <!-- Zusätzliche Stylesheets -->
    <link href="form/form-validation.css" rel="stylesheet">

</head>

<body class="bg-light">





</body>
</html>
