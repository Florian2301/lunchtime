<?php

function ergebnis($essen, $entfernung, $preis, $veggie) {
    echo "<div class='container' style='margin-top: 2rem'>Du hast $essen in $entfernung Entfernung für einen $preis Preis als $veggie (vegatarisch) ausgesucht</div>";

    $mysqli = new mysqli('localhost', 'root', '', 'Mittagessen');
    
    /*
    if ($essen === "Alles" && $entfernung === "Egal" && $preis === "Egal") {
        $sql = "SELECT * FROM Lunchtime";
    }
    else if ($entfernung === "Egal" && $preis !== "Egal") { 
        $sql = "SELECT * FROM Lunchtime WHERE Kategorie = '$essen' AND Preis = '$preis'";
    } 
    else if ($entfernung !== "Egal" && $preis === "Egal") {
        $sql = "SELECT * FROM Lunchtime WHERE Kategorie = '$essen' AND Entfernung = '$entfernung'";
    } 
    else if ($entfernung !== "Egal" && $preis !== "Egal") {
        $sql = "SELECT * FROM Lunchtime WHERE Kategorie = '$essen' AND Entfernung = '$entfernung' AND Preis = '$preis' ";
    }
    else {
        $sql = "SELECT * FROM Lunchtime WHERE Kategorie = '$essen'";
    }*/

    
    $sql = "SELECT * FROM Lunchtime
            WHERE (Kategorie = '$essen' OR Egal = '$essen')
            AND Entfernung IN ( SELECT Entfernung From Lunchtime 
                                WHERE (Entfernung = '$entfernung' OR Egal = '$entfernung')
                                AND Preis IN (  SELECT Preis From Lunchtime 
                                                WHERE (Preis = '$preis' OR Egal = '$preis')
                                                AND Veggie IN ( SELECT Veggie FROM Lunchtime
                                                                WHERE Veggie = '$veggie' OR Egal = '$veggie')))            
            ";
      

    $response = $mysqli->query($sql) or die("error: {$mysqli->error}\n");
    echo print_r($sql);
?>

<div class="container" style='margin-top: 2rem'>
    <table class="table table-striped">
        <tr style="border-bottom: solid black 1px">
            <td>Lokal</td>
            <td>Enfernung</td>
            <td>Preis</td>
            <td>Veggie</td>
            <td>Adresse</td>
            <td>Kategorie</td>
        </tr>
        <?php
        while ($data = $response->fetch_array(MYSQLI_ASSOC)) {
            ?>
            <tr>
                <td><?php echo htmlspecialchars(utf8_encode($data['Lokal'])); ?></td>
                <td><?php echo htmlspecialchars(utf8_encode($data['Entfernung'])); ?></td>
                <td><?php echo htmlspecialchars(utf8_encode($data['Preis'])); ?></td>
                <td><?php echo htmlspecialchars(utf8_encode($data['Veggie'])); ?></td>
                <td><?php echo htmlspecialchars(utf8_encode($data['Adresse'])); ?></td>
                <td><?php echo htmlspecialchars(utf8_encode($data['Kategorie'])); ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>

<?php
}
?>