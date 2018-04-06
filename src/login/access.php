<html>
	<head>
		<title>Login_Funktion</title>
	</head>

	<body>
		<h1>Login_Page</h1>
		<form method="post" action="access.php">
			Benutzername:
      <p>
			     <input type="text" name="username" id="username" maxlength="30" >
      </p>
      Passwort:
      <p>
        <input type="password" name="passwort" id="passwort" maxlength="30" ><br><input type="checkbox" onchange="document.getElementById('passwort').type = this.checked ? 'text' : 'password'"> Passwort anzeigen</input>
      </p>
      <p>
        <button name="login" type="submit">Login</button>
      </p>

      <button name="new"
			onClick="window.open('registrierung.php','_blank','width=300,height=300');">Registrieren</button>
		</form>

		<?php
        if(isset($_POST["login"])){

          $username=$_POST["username"];
          $password=$_POST["passwort"];
          if(!$username)
          {
            echo "<br><font color='red'>"."Keinen Benutzernamen angegeben!"."</font>";
          }
          if (!$password) {
            echo "<br><font color='red'>"."Kein Passwort angegeben!"."</font>";
          }
          else {
            include("dbaccess.php");
            $query1 = "select Salt from user where Username = '$username';";
            mysqli_real_query($link,$query1);
            $result1=mysqli_fetch_array(mysqli_store_result($link));
            $salz=$result1[0];
            if($salz)
            {
              $pw_salz=$password.$salz;
              $pw_hash=hash('sha512', $pw_salz);

              $query2="select Username from user where '$pw_hash'=Password";
              mysqli_real_query($link,$query2);
              $result2=mysqli_fetch_array(mysqli_store_result($link));
              $user=$result2[0];
              if($user)
              {
                echo "<h1>Willkommen '$user'</h1>";
                echo "Command Interpreter Befehle für Schullaufwerke:";
                echo "<hr><br>Windows:";
                echo "<br>Public: <font style='font-weight: bold;'>net use Y: \\\webdav.htl-wels.at@SSL\davWWWroot /user:Schule\\$user $password</font>";
                echo "<br>Homefolder: <font style='font-weight: bold;'>net use Y: \\\webdav.htl-wels.at@SSL@4343\davWWWroot /user:Schule\\$user $password</font>";
                echo "<hr><br>OSX";
                echo "<br>Public: <font style='font-weight: bold;'>mount_webdav -i https://webdav.htl-wels.at/ /Desktop/mount_public </font><br> Mit Benutzername= '$user' und Passwort= '$password'";
                echo "<br>Homefolder: <font style='font-weight: bold;'>mount_webdav -i https://webdav.htl-wels.at:4343/Schueler/$user /Desktop/mount_home </font><br> Mit Benutzername= '$user' und Passwort= '$password'";
                echo "<hr><br>Linux (Debian und Derivate)";
                echo "<br>Public: <font style='font-weight: bold;'>sudo mount -t davfs https://webdav.htl-wels.at/ /Desktop/mount_public </font><br> Mit Benutzername= '$user' und Passwort= '$password'";
                echo "<br>Homefolder: <font style='font-weight: bold;'>sudo mount -t davfs https://webdav.htl-wels.at:4343/Schueler/$user /Desktop/mount_home </font><br> Mit Benutzername= '$user' und Passwort= '$password'";
                echo "<hr><br><form name='logout' method='post' style='float:left;' action='access.php'>
                        <input name='submit' type='submit' id='submit' value='Logout'>
                      </form>";
              }
              else {
                echo "<br><font color='red'>"."Falsches Passwort!"."</font>";
              }
            }
            else {
              echo "<br><font color='red'>"."Benutzer nicht gefunden!"."</font>";
            }
          }
        }
        if(isset($_POST["login"])){

        }
		?>
	</body>
</html>
