<?php
// Erstellen der Datenbank
function createdatabase() {
    $mysqli = new mysqli('localhost', 'root', '', 'Mittagessen');
        if($mysqli->connect_error) {
            echo 'Fehler bei der Verbindung: ' . mysqli_connect_error();
            exit();
        }
        if(!$mysqli->set_charset('utf8')) {
            echo 'Fehler beim Laden von UTF-8: ' . mysqli_error();
        }

    $sql = 'CREATE TABLE IF NOT EXISTS Lunchtime  (
            id INT(11) NOT NULL AUTO_INCREMENT,
            Lokal VARCHAR(255) NOT NULL,
            Entfernung VARCHAR(255) NOT NULL,
            Preis VARCHAR(255) NOT NULL,
            Veggie VARCHAR(255) NOT NULL,
            Adresse VARCHAR(255) NOT NULL,
            Kategorie VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
            )';

    $mysqli->query($sql);
    $mysqli->close();
};

//Hard coded data, damit das Programm auch auf anderen localhosts laufen kann
$data = array(
    array("lokal" => "Perle", "entfernung" => "5 Min", "preis" => "günstig", "veggie" => "große Auswahl", "adresse" => "Spitalerstraße 22, 20095 Hamburg", "kategorie" => "Alles"),
    array("lokal" => "Europapassage", "entfernung" => "5 Min", "preis" => "mittel", "veggie" => "große Auswahl", "adresse" => "Ballindamm 40 EG2, 20095 Hamburg", "kategorie" => "Alles"),
    array("lokal" => "Max & Consorten", "entfernung" => "10 Min", "preis" => "günstig", "veggie" => "mittlere Auswahl", "adresse" => "Spadenteich 1, 20099 Hamburg", "kategorie" => "Hausmannskost"),
    array("lokal" => "Luigi's", "entfernung" => "10 Min", "preis" => "mittel", "veggie" => "große Auswahl", "adresse" => "Ditmar-Koel-Straße 21, 20459 Hamburg", "kategorie" => "Pizza/Pasta"),
    array("lokal" => "Bella Italia", "entfernung" => "5-10 Min", "preis" => "günstig", "veggie" => "mittlere Auswahl", "adresse" => "Brandstwiete 58, 20457 Hamburg", "kategorie" => "Pizza/Pasta"),
    array("lokal" => "Restaurant Kabul", "entfernung" => "10 Min", "preis" => "günstig", "veggie" => "mittlere Auswahl", "adresse" => "Steindamm 53, 20099 Hamburg", "kategorie" => "Sonstiges"),
    array("lokal" => "Goot", "entfernung" => "5-10 Min", "preis" => "teuer", "veggie" => "nicht vegetarisch", "adresse" => "Depenau 10, 20095 Hamburg", "kategorie" => "Hausmannskost"),
    array("lokal" => "O-ren Ishii", "entfernung" => "5-10 Min", "preis" => "teuer", "veggie" => "große Auswahl", "adresse" => "Kleine Reichenstraße 18, 20457 Hamburg", "kategorie" => "Asiatisch"),
    array("lokal" => "Better Burger Company", "entfernung" => "5 Min", "preis" => "mittel", "veggie" => "große Auswahl", "adresse" => "Rosenstraße Ecke, Gertrudenkirchhof, 20095 Hamburg", "kategorie" => "Burger"),
    array("lokal" => "Bucks Burgers", "entfernung" => "5-10 Min", "preis" => "mittel", "veggie" => "große Auswahl", "adresse" => "Kurze Mühren 13, 20095 Hamburg", "kategorie" => "Burger"),
    array("lokal" => "Mr. Cheng", "entfernung" => "5-10 Min", "preis" => "teuer", "veggie" => "große Auswahl", "adresse" => "Speersort 1, 20095 Hamburg", "kategorie" => "Asiatisch"),
    array("lokal" => "Franco Rathauspassage", "entfernung" => "5-10 Min", "preis" => "mittel", "veggie" => "große Auswahl", "adresse" => "Rathausmarkt 7, 20095 Hamburg", "kategorie" => "Pizza/Pasta"),
);

//Datenbank mit den daten füllen
function insertdata() {
    global $data;

    try {
        $db = new PDO('mysql:host=localhost;dbname=Mittagessen;charset=UTF8', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO lunchtime 
                (Lokal, Entfernung, Preis, Veggie, Adresse, Kategorie)
                VALUES (:lokal, :entfernung, :preis, :veggie, :adresse, :kategorie)';
        $stmt = $db->prepare($sql);
        for($i=0; $i < count($data); $i++) {
            $stmt->execute(array(
                ':lokal' => $data[$i]['lokal'],
                ':entfernung' => $data[$i]['entfernung'],
                ':preis' => $data[$i]['preis'],
                ':veggie' => $data[$i]['veggie'],
                ':adresse' => $data[$i]['adresse'],
                ':kategorie' => $data[$i]['kategorie'],
            ));
        }
    } catch (PDOException $e) {
        echo 'Hat nicht geklappt: ' . $e->getMessage();
    }
}

?>