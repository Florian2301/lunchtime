<?php

function ergebnis($essen, $entfernung, $preis, $veggie) {
    echo "<div class='container' style='margin-top: 2rem'>Du hast $essen in $entfernung Entfernung für einen $preis Preis als $veggie (vegatarisch) ausgesucht</div>";

    $mysqli = new mysqli('localhost', 'root', '', 'Mittagessen');

    if ($essen == "Alles" || $entfernung == "Egal" || $preis == "Egal" || $veggie == "Egal") {
        $sql = "SELECT Lokal, Entfernung, Preis, Veggie, Adresse, Kategorie FROM Lunchtime";
    }
    else {
        $sql ="SELECT * FROM Lunchtime WHERE Kategorie = '$essen' AND Entfernung = '$entfernung' AND Preis = '$preis' AND Veggie = '$veggie'" ;
    }
    $response = $mysqli->query($sql);
    
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
                <td><?php echo htmlspecialchars($data['Lokal']); ?></td>
                <td><?php echo htmlspecialchars($data['Entfernung']); ?></td>
                <td><?php echo htmlspecialchars($data['Preis']); ?></td>
                <td><?php echo htmlspecialchars($data['Veggie']); ?></td>
                <td><?php echo htmlspecialchars($data['Adresse']); ?></td>
                <td><?php echo htmlspecialchars($data['Kategorie']); ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>

<?php
}
?>