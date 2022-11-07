<?php
/**
 * User: Siemen van de Braak
 * Date: 13/06/2022
 * File: bewerkpagina
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KW1C_Horeca_School</title>
    <meta name="description" content="overzichtpagina">
    <link href="../styles/Bewerk.css" rel="stylesheet">
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
    <form action="bewerkInsert.php" method="post">
        <button type="submit" value="Toevoegen">
            Toevoegen
        </button>
    </form>
        <?php
            //bepalen of er correct is ingelogd
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
    {
        include_once("../includes/db_functions.php");
        //start de connection
        startConnection();
        $query = "USE HorecaKW1C;";
        executeQuery($query);
        $query = "SELECT DinerNummer, Omschrijving, Startmoment, Eindmoment, Locatie FROM Diner ORDER BY Startmoment ASC;";
        $result = executeQuery($query);
        //echo "<p>" . $query . "</p>";


        echo "<table>";
        echo "<tr>";
        echo "<th>Bewerken</th>";
        echo "<th>DinerNummer</th>";
        echo "<th>Omschrijving</th>";
        echo "<th>Startmoment</th>";
        echo "<th>Eindmoment</th>";
        echo "<th>Locatie</th>";
        echo "<th>Verwijderen</th>";
        echo "</tr>";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td><a class='bewerkLink' href='../pages/BewerkForm.php?id=" . $row["DinerNummer"] . "'><svg class='bewerksymbool' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'></path></svg></a></td>";
            echo "<td>" . $row["DinerNummer"] . "</td>";
            // Zorgt ervoor dat ë en andere letters mogelijk zijn anders wordt het een vraagteken
            echo "<td>" . utf8_encode($row['Omschrijving']) . "</td>";
            // Zorgt ervoor dat alleen de uren en minuten getoond worden en niet seconden
            $row["Startmoment"] = date("Y-m-d H:i", strtotime($row["Startmoment"]));
            echo "<td>" . $row["Startmoment"] . "</td>";
            $row["Eindmoment"] = date("Y-m-d H:i", strtotime($row["Eindmoment"]));
            echo "<td>" . $row["Eindmoment"] . "</td>";
            echo "<td>" . $row["Locatie"] . "</td>";
            echo "<td><a class='deleteLink' href='../pages/BewerkForm.php?id=" . $row["DinerNummer"] . "&delete=true" . "'><svg class='bewerksymbool' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'></path></svg></a></td>";

            echo "</tr>";
        }
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
