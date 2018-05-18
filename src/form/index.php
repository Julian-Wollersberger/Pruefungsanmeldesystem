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



echo $today;
echo $von;


if($today>$von && $today<$bis)
{
    echo "<!DOCTYPE html>
    <html lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">


        <title>Anmeldung NOST</title>

        <!-- Bootstrap core CSS -->
        <link href="form/bootstrap.css" rel="stylesheet">

        <!-- Zusätzliche Stylesheets -->
        <link href="form/form-validation.css" rel="stylesheet">

      </head>

      <body class="bg-light">

        <div class="container">
          <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="form/htl_logo.png" alt="" width="72" height="72">
            <h2>Prüfungsanmeldung</h2><link rel="shortcut icon" href="/fileadmin/template/img/htl.png" type="image/png">
            <p></p>
          </div>
            <div class="col-md-8 order-md-1 mx-auto">
              <h4 class="mb-3">Daten des Prüflings</h4>
              <form class="needs-validation" novalidate="" action="speichereAnmeldung.php" method="post">



                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="firstName">Vorname</label>
                    <input class="form-control" id="firstName" name="firstName" placeholder="Dennis" required="" type="text">
                    <div class="invalid-feedback">
                      Bitte geben Sie einen gültigen Vornamen ein
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Nachname</label>
                    <input class="form-control" id="lastName" name="lastName" placeholder="Schläger" required="" type="text">
                    <div class="invalid-feedback">
                      Bitte geben Sie einen gültigen Nachnamen ein
                    </div>
                  </div>
                </div>



                <div class="row">
                  <div class="col-md-9 mb-3">
                    <label for="email">Email </label>
                    <input class="form-control" id="email" name="email" placeholder="you@example.com" type="email" required="">
                    <div class="invalid-feedback">
                      Bitte geben Sie eine gültige E-Mail Adresse ein
                    </div>
                  </div>

                  <div class="col-md-3 mb-3">
                    <label for="class">Klasse</label>
                    <input class="form-control" id="class" name="class" placeholder="1EHIT" type="text" required="">
                    <div class="invalid-feedback">
                      Bitte geben Sie eine gültige Klasse ein
                    </div>
                  </div>
                </div>



                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="date">Datum </label>
                    <input class="form-control" id="date" name="date" placeholder="" type="date" required="">
                    <div class="invalid-feedback">
                      Bitte geben Sie ein gültiges Datum ein
                    </div>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="time">Zeit</label>
                    <input class="form-control" id="time" name="time" placeholder="1EHIT" type="time" required="">
                    <div class="invalid-feedback">
                      Bitte geben Sie eine gültige Zeit ein
                    </div>
                  </div>
                </div>



                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">verbindlich zur Prüfung anmelden</button>
              </form>
            </div>
          </div>

          <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© HTL-Wels 2018 </p>

          </footer>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="form/jquery-3.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="form/popper.js"></script>
        <script src="form/bootstrap.js"></script>
        <script src="form/holder.js"></script>
        <script>
          // Example starter JavaScript for disabling form submissions if there are invalid fields
          (function() {
            'use strict';2018-05-18 14:32

            window.addEventListener('load', function() {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');

              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
        </script>


    </body></html>
";
}
else {
    echo "<!DOCTYPE html>
    <html lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">


        <title>Anmeldung NOST</title>

        <!-- Bootstrap core CSS -->
        <link href="form/bootstrap.css" rel="stylesheet">

        <!-- Zusätzliche Stylesheets -->
        <link href="form/form-validation.css" rel="stylesheet">

      </head>

      <body class="bg-light">

        <div class="container">
          <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="form/htl_logo.png" alt="" width="72" height="72">
            <h2>Prüfungsanmeldung</h2><link rel="shortcut icon" href="/fileadmin/template/img/htl.png" type="image/png">
            <p></p>
          </div>
            <div class="col-md-8 order-md-1 mx-auto">
              <h4 class="mb-3">Die Anmeldung ist noch nicht offen!</h4>

            </div>
          </div>

          <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© HTL-Wels 2018 </p>

          </footer>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="form/jquery-3.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="form/popper.js"></script>
        <script src="form/bootstrap.js"></script>
        <script src="form/holder.js"></script>
        <script>
          // Example starter JavaScript for disabling form submissions if there are invalid fields
          (function() {
            'use strict';2018-05-18 14:32

            window.addEventListener('load', function() {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');

              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
        </script>


    </body></html>";
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
