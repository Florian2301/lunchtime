# lunchtime

** Update zur Fehlersuche hinzugefügt (Ordner "Update" hochgeladen am 07.03.) **

Das Projekt "lunchtime" habe ich unter Win10 mit XAMPP (PHP und MySQL) entwickelt. Es läuft auf dem localhost.

Es besteht aus einer Hauptseite, der "main.php". Die Datei "datenbank.php" und "ergebnisliste.php" sind für die Erstellung der Datenbank sowie der Anzeige der Suchergebnisse da.

Drei Probleme haben sich beim Entwickeln ergeben:

1. Wie wird die Datenbank mit Daten gefüllt, wenn die App nur auf dem Localhost läuft?
2. Die Abfrage der Daten nachdem eine Auswahl getroffen wurde
3. Anzeige der Daten ist teilweise unvollständig

zu 1.

- ich habe eine Funktion "inserdata()" erstellt, die beim Aufruf der Seite die Daten in die Datenbank einfügt
- dadurch kann die App ohne Weiteres auf einem anderen Localhost gestartet und bearbeitet werden
- das Problem dabei ist, wenn die Seite aktualisiert wird, werden die Daten ein weiteres Mal in die Datenbank geschrieben
- die Lösung ist, die Datenbank live zu schalten, damit die Daten nicht gesondert eingefügt werden müssen
- Update 07.03.: nach dem ersten Aufruf Funktion auskommentieren

zu 2.

- die Anzeige der selektierten Auswahl funktioniert noch nicht korrekt
- da ich mich erst seit kurzem mit MySQL und PHP befasst habe, ist mir eine komplexe Abfrage nicht geglückt
- Ich konnte zwischenzeitlich die korrekte Abfrage der Kategorie "Essen" erstellen, aber mit zusätzlichen Parametern bräuchte ich etwas mehr Zeit
- Lösung: Unbedingt weiter daran arbeiten ;)
- Update 07.03.: Abfrage der Kategore Essen, Entfernung und Preis problemlos. Mit Vegatarisch hat es noch nicht fehlerfrei geklappt. Als nächsten Schritt werden die Daten über mehrere Tabellen verteilt und anhand von Fremdschlüsseln abgefragt
- Update 14.03.: neue Abfrage, läuft unter phpMyAdmin problemlos aber nicht in der App

zu 3.

- mir ist noch unbekannt aus welchen Gründen einige Daten lückenhaft angezeigt werden, andere dagegen vollständig
- das muss auch weiter untersucht werden
- Update 07.03.: das Problem lag darin, dass die Umlaute nicht korrekt angezeigt wurde. Lösung durch zusetzen von "utf8_encode" in "ergebnisliste.php" Zeile 42-47.
