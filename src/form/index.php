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


echo '<img class="d-block mx-auto mb-4" src="form/htl_logo.png" alt="" width="72" height="72">
<h2>Prüfungsanmeldung</h2><link rel="shortcut icon" href="/fileadmin/template/img/htl.png" type="image/png">
<p></p>';

echo '<div class="col-md-8 order-md-1 mx-auto text-center"><h4>Die Anmeldung ist von '.$von." bis ".$bis."</h4></div>";


if($today>$von && $today<$bis)
{
    require("form.html");
}
else {
    require("no_form.html");
}

?>
