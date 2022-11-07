<?php
//Auteur: Siemen van de Braak
//Aanmaakdatum: 02-06-2022
//Omschrijving: startpagina
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KW1C_Horeca_School</title>
    <meta name="description" content="My Page Description">
    <link href="styles/startpagina.css" rel="stylesheet">
    <link href="styles/navbar.css" rel="stylesheet">
    <link href="styles/overzicht.css" rel="stylesheet">
    <script src="js/navbar.js" defer> </script>
</head>
<body>
<header>
    <?php
    //include navbar
    include("./includes/navbar.php");
    ?>
</header>
<main>

    <div class="container">
        <!-- /header -->
        <div class="Welkom">
            <img src="/Praktijk/Thema4/T4_PraktijkProject/images/TheCook.png" alt="PlaceholderPersoon">
            <div class="WelkomContainer">
                <h2 class="title"><span>Welkom!</span></h2>
                <blockquote class="WelkomQuote">
                    <span class="quote" id="qLinks">"</span>
                    De lekkerste etentjes en diners! Wij bij de Middelbare Horeca School zijn gespecialiseerd in het creëren van de meest smaakvolle gerechten, je hoeft ons woord er niet voor te geloven 1 hap zegt al genoeg.
                    <span class="WelkomNaam">Walter Wit - Middelbare Horeca School</span>
                    <span class="quote" id="qRechts">"</span>
                </blockquote>
            </div>
        </div>

        <?php
        //gebruik juiste database
        $query = "USE HorecaKW1C;";
        executeQuery($query);
        // query die alles laat zien van diners en sorteert op start moment
        $query = "SELECT DinerNummer, Omschrijving, Startmoment, Eindmoment, Locatie
FROM Diner ORDER BY Startmoment ASC;";
        //echo $query;
        $result = executeQuery($query);
        echo "<table>";
        echo "    <tr>";
        echo "        <th>DinerNummer</th>";
        echo "        <th>Omschrijving</th>";
        echo "        <th>Startmoment</th>";
        echo "        <th>Eindmoment</th>";
        echo "        <th>Locatie</th>";

        // for loop die de eerste 3 diners laat zien
        for($i = 0; $i < 3; $i++)
        {
            $row = $result->fetch(PDO::FETCH_ASSOC);
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
        ?>

</main>
<?php
//include footer
include("./includes/footer.php");
?>
</body>
</html>
