<?php
include "htmlelemente.php";
include "ergebnisliste.php";
include "datenbank.php";

//createdatabase(); 1 x aufrufen, um die Tabelle anzulegen
//insertdata(); //1 x aufrufen, um die Daten in die Tabelle einzufügen

htmlanfang("It's Lunchtime");

echo "<h1 class='container' style='margin-top: 2rem; margin-bottom: 2rem'>It's Lunchtime! Wo und was essen wir heute?</h1>";

if (isset($_POST["absenden"])) {
    absenden();
} else {
    auswahlkriterien();
};

// Funktion Formular
function auswahlkriterien($essen = "Egal", $entfernung = "Egal", $preis ="Egal", $veggie = "Egal") {
    $speisen = ["Egal", "Alles", "Burger", "Pizza/Pasta", "Asiatisch", "Hausmannskost", "Sonstiges"];
    $distanz = ["Egal", "5 Min", "5-10 Min", "10 Min"];
    $kosten = ["Egal", "günstig", "mittel", "teuer"];
    $ernaehrung = ["Egal", "große Auswahl", "mittlere Auswahl", "nicht vegatarisch"];
?>

<div class="container">
    <form class="col-md-7" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label>Auswahl Essen</label>
        <?php
            foreach ($speisen as $spei) {
                if ($spei == $essen) {
                    $check = "checked";
                }
                else {
                    $check = "";
                }
                echo "<input type='radio' class='btn-check' name='essen' id='$spei' value='$spei' autocomplete='off' $check>
                    <label class='$check === true? btn btn-outline-primary : btn' for='$spei'>$spei</label>";
            }
        ?>

        <div class="row">
            <div class="col">
                <label style='margin-top: 1rem'>Auswahl Entfernung</label>
                <?php
                    foreach ($distanz as $dist) {
                        if ($dist == $entfernung) {
                            $check = "checked";
                        }
                        else {
                            $check = "";
                        }
                        echo "<input type='radio' class='btn-check' name='entfernung' id='$dist' value='$dist' autocomplete='off' $check>
                            <label class='$check === true? btn btn-outline-primary : btn' for='$dist'>$dist</label>";
                    }
                ?>
            </div>

            <div class="col">
                <label style='margin-top: 1rem'>Auswahl Preis</label>
                <?php
                    foreach ($kosten as $kost) {
                        if ($kost == $preis) {
                            $check = "checked";
                        }
                        else {
                            $check = "";
                        }
                        echo "<input type='radio' class='btn-check' name='preis' id='$kost' value='$kost' autocomplete='off' $check>
                            <label class='$check === true? btn btn-outline-primary : btn' for='$kost'>$kost</label>";
                    }
                ?>
            </div>
        </div>

        <label style='margin-top: 1rem'>Auswahl Vegetarisch</label>
        <?php
            foreach ($ernaehrung as $ern) {
                if ($ern == $veggie) {
                    $check = "checked";
                }
                else {
                    $check = "";
                }
                echo "<input type='radio' class='btn-check' name='veggie' id='$ern' value='$ern' autocomplete='off' $check>
                    <label class='$check === true? btn btn-outline-primary : btn' for='$ern'>$ern</label>";
            }
        ?>

        <div class="row">
            <input type="submit" class="btn btn-secondary" style="margin-top: 1rem; margin-left: 0.7rem; width: 10rem" name="reset" value="Reset">
            <input type="submit" class="btn btn-warning" style="margin-top: 1rem; margin-left: 0.5rem;  width: 10rem" name="absenden" value="Anzeigen">
        </div>
    </form>
</div>
<?php
}

// Funktion absenden der Tabelle
function absenden() {
    isset($_POST["essen"]) ? $essen = $_POST["essen"] : $essen = "Egal";
    isset($_POST["entfernung"]) ? $entfernung = $_POST["entfernung"] : $entfernung = "Egal";
    isset($_POST["preis"]) ? $preis = $_POST["preis"] : $preis = "Egal";
    isset($_POST["veggie"]) ? $veggie = $_POST["veggie"] : $veggie = "Egal";

    auswahlkriterien($essen, $entfernung, $preis, $veggie); // Aufruf der Formular-Funktion, damit Auswahl beim Neuladen der Seite erhalten bleibt
    
    ergebnis($essen, $entfernung, $preis, $veggie); // Übergabe an die Funktion, die Anfrage andie Datenbank stellt

};

htmlende();
?>