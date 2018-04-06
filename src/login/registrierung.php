<html>
	<head>
		<title>Registrierung</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	<body>
		<h1>Registrierung</h1>

		<form name="form1" method="post" action="registrierung.php">

			<p>
				Benutzername:<br> <input name="Benutzername" type="text" id="Benutzername" value="">
			</p>
			<p>
				Passwort:<br> <input name="Passwort" type="password" id="Passwort" value=""><br><input type="checkbox" onchange="document.getElementById('Passwort').type = this.checked ? 'text' : 'password'"> Passwort anzeigen</input>
			</p>
      <p>
				Passwort wiederholen:<br> <input name="PasswortWH" type="password" id="PasswortWH" value=""><br><input type="checkbox" onchange="document.getElementById('PasswortWH').type = this.checked ? 'text' : 'password'"> Passwort anzeigen</input>
			</p>

			<p>
				<input name="reg" type="submit" id="reg" value="registrieren">
			</p>
		</form>
		<?php
    if (isset($_POST["reg"]))
    {

      $username=$_POST["Benutzername"];
      $password=$_POST["Passwort"];
      $passwordwh=$_POST["PasswortWH"];
      if(!$username)
      {
        echo "<br><font color='red'>"."Keinen Benutzernamen angegeben!"."</font>";
      }
      if (!$password) {
        echo "<br><font color='red'>"."Kein Passwort angegeben!"."</font>";
      }
      if (!$passwordwh) {
        echo "<br><font color='red'>"."Passwort nicht wiederholt!"."</font>";
      }
      elseif ($password!=$passwordwh) {
        echo "<br><font color='red'>"."Die Passwörter sind nicht gleich!"."</font>";
      }

      else{
        include("dbaccess.php");
        $username=mysqli_real_escape_string($link,$username);
        $password=mysqli_real_escape_string($link,$password);
        $table="user";

        $salz= bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        $pw_salz=$password.$salz;
        $pw_hash=hash('sha512', $pw_salz);

        $query = "insert into user (Username, Password, Salt) values ('$username', '$pw_hash', '$salz'); ";
        mysqli_real_query ($link , $query);
        echo "<script language='Javascript'> window.close(); </script>";
      }
    }
		?>


	</body>
</html>
