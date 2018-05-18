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

$today=date("Y-m-d H:i");
$von=$date_von." ".$time_von;
$bis=$date_bis." ".$time_bis;


echo "<h4>Die Anmeldung ist von ".$von." bis ".$bis."<h4>";


if($today>$von && $today<$bis)
{
    require("form.html");
}
else {
    require("no_form.html");
}






?><div class="py-5 text-center">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>NOST-Anmeldung</title>

    <!-- Bootstrap core CSS -->
    <link href="form/bootstrap.css" rel="stylesheet">

    <!-- Zusätzliche Stylesheets -->
    <link href="form/form-validation.css" rel="stylesheet">

</head>

<body class="bg-light">

  <img class="d-block mx-auto mb-4" src="form/htl_logo.png" alt="" width="72" height="72">
  <h2>Prüfungsanmeldung</h2><link rel="shortcut icon" href="/fileadmin/template/img/htl.png" type="image/png">
  <p></p>





</body>
</html>
