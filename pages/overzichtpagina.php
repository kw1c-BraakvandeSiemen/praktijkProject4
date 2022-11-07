<?php
/**
 * User: Siemen van de Braak
 * Date: 10/06/2022
 * File: Overzichtpagina (iederen inlog)
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KW1C_Horeca_School</title>
    <meta name="description" content="overzichtpagina">
    <link href="../styles/overzicht.css" rel="stylesheet">
    <link href="../styles/navbar.css" rel="stylesheet">
    <script src="../js/navbar.js" defer> </script>
</head>
<body>
<header>
    <!-- includen navbar -->
    <?php
    include("../includes/navbar.php");
    ?>
</header>
<main>
    <fieldset>
        <label>Zoeken:</label>
        <br><br>
        <form action='overzichtpagina.php' method='post'>
            <label for="Zoeken">Omschrijving:</label>
            <input type="text" name="Zoeken">
            <br><br>
            <select name="ZoekMglk">
                <option disabled hidden selected value="">Selecteer een optie</option>
                <option value="Omschrijving" >Omschrijving</option>
                <option value="Locatie">Locatie</option>
                <?php

                // Start een connectie met de database
                startConnection();
                // Voer de geschreven SQL query uit op de database
                // Vang daarna het resultaat in de variabele $result
                $query = "USE HorecaKW1C;";
                executeQuery($query);

                ?>
            </select>
            <br><br>
            <input type='submit' value='Zoeken'>
        </form>
    </fieldset>

    <?php

    //bepalen of er correct is ingelogd
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
    {
        //er is ingelogd

        // query die alles laat zien van diners en sorteert op start moment
        $query = "SELECT DinerNummer, Omschrijving, Startmoment, Eindmoment, Locatie
FROM Diner ORDER BY Startmoment ASC;";
        //echo $query;

        if (isset($_POST["Zoeken"]) && isset($_POST["ZoekMglk"]))
        {
            $Zoeken = $_POST["Zoeken"];
            $ZoekMglk = $_POST["ZoekMglk"];
            $query = "SELECT * FROM Diner WHERE " .  $ZoekMglk . " LIKE '%" . $Zoeken . "%'";
        }
        else
        {
            $query = "SELECT DinerNummer, Omschrijving, Startmoment, Eindmoment, Locatie
FROM Diner ORDER BY Startmoment ASC";
        }

        $result = executeQuery($query);

        echo "<table>";
        echo "    <tr>";
        echo "        <th>DinerNummer</th>";
        echo "        <th>Omschrijving</th>";
        echo "        <th>Startmoment</th>";
        echo "        <th>Eindmoment</th>";
        echo "        <th>Locatie</th>";
// Door de results heen loopen via een while
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
            echo "<td>". $row["DinerNummer"] . "</td>";
            // Zorgt ervoor dat ë en andere letters mogelijk zijn anders wordt het een vraagteken
            echo "<td>". utf8_encode($row['Omschrijving']) . "</td>";
            // Zorgt ervoor dat alleen de uren en minuten getoond worden en niet seconden
            $row["Startmoment"] = date("Y-m-d H:i", strtotime($row["Startmoment"]));
            echo "<td>". $row["Startmoment"] . "</td>";
            $row["Eindmoment"] = date("Y-m-d H:i", strtotime($row["Eindmoment"]));
            echo "<td>". $row["Eindmoment"] . "</td>";
            echo "<td>". $row["Locatie"] . "</td>";
            echo "</tr>";
        }
        echo "</tr>";
        echo "</table>";
    }
    else
    {
        //niet ingelogd
        header("Location: /Praktijk/Thema4/T4_PraktijkProject/index.php");
        die();
    }

    ?>
</main>
<?php
//include footer
include("../includes/footer.php");
?>
</body>
</html>
