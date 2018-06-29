#  Was noch zu tun ist:

+ Die Eingabefelder in PHP auf Plausibelität überprüfen (Fach, Klasse)
+ CSV-Datei zurücksetzen können.
+ Vielleicht einzelne Einträge bearbeiten/löschen können.

# Sicherheit:
+ Als erste Spalte in der CSV-Datei den Anmeldenamen des Schülers,
  um Scherzanmeldungen zurückzufolgen zu können.
+ Direkter Zugriff nur auf admin.php, index.php, 
  speichereAnmeldung.php, writeOffen.php, 
  download_CSV.php, generiere_PDF.php.  
  Der Rest wird nur vom PHP Interpreter aufgerufen.

Zuverlässigkeit
+ Unsere Fehlerbehandlung ist teilweise etwas schwach.
  Wenn ein Fehler passiert, bekommt der Nutzer
  wahrscheinlich oft keine Meldung.
+ Wenn jemand auf der Adminseite Änderungen an den
  Daten macht und sich währenddessen jemand zur
  Prüfung anmeldet, dann geht diese Anmeldung verloren.

