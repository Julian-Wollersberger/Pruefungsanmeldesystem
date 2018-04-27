<?php
/**
 * Created by PhpStorm.
 * User: julian
 * Date: 27.04.18
 * Time: 15:13
 */




?>

<!DOCTYPE html>
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
        'use strict';

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

