<?php
/**
 * User: Siemen van de Braak
 * Date: 13/06/2022
 * File: bewerkpagina form
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
    <link href="../styles/navbar.css" rel="stylesheet">
    <script src="../js/navbar.js" defer> </script>
</head>
<body>
<header>
    <!-- includen navbar -->
    <?php
    include("../includes/navbar.php");
    //als er niet is ingelogd dan wordt je terug gestuurd naar de homepagina
    if(!isset($_SESSION['loggedIn']))
    {
        header("Location: ../index.php");
        die();
    }

    ?>
</header>
<main>

        <?php
        // als als er geen diner geleselect is krijg je deze foutmelding
        if(empty($_GET["id"]) == true)
        {
            echo "<p>Geen Diner geselecteerd.</p>";
            die();
        }
        $DNMR = $_GET["id"];

        ?>

        <!-- Plaats je code / uitwerking hieronder -->

        <form action="../pages/BewerkUpdate.php" method="post">
            <?php
            //gebruik juiste database
            $query = "USE HorecaKW1C;";
            executeQuery($query);
            if(!isset($_GET["delete"])) {
                $query = "SELECT * FROM Diner WHERE DinerNummer = " . $DNMR . ";";
                $result = executeQuery($query);
                $row = $result->fetch(PDO::FETCH_ASSOC);
                echo "<div class='container'>";
                echo "<input type='hidden' name='HidId' value=" . $row["DinerNummer"] . ">";
                echo "<br>";
                echo "<label for='Omschrijving'>Omschrijving:</label>";
                echo "<input type='text' name='Omschrijving' id='Omschrijving' value='" . $row["Omschrijving"] . "'>";
                echo "<br>";
                //data correct weergeven
                $row["Startmoment"] = date("Y-m-d\TH:i", strtotime($row["Startmoment"]));
                echo "<label for='Startmoment'>Datum:</label>";
                echo "<input type='datetime-local' name='Startmoment' id='Startmoment' value='" . $row["Startmoment"] . "'>";
                echo "<br>";
                //data correct weergeven
                $row["Eindmoment"] = date("Y-m-d\TH:i", strtotime($row["Eindmoment"]));
                echo "<label for='Eindmoment'>Datum:</label>";
                echo "<input type='datetime-local' name='Eindmoment' id='Eindmoment' value='" . $row["Eindmoment"] . "'>";
                echo "<br>";
                echo "<label for='Locatie'>Locatie:</label>";
                echo "<input type='text' name='Locatie' id='Locatie' value='" . $row["Locatie"] . "'>";
                echo "<br>";
                echo "<br>";
                echo "<input type='submit' value='Oplsaan'>";
                echo "</div>";
            }
            ?>
        </form>
            <?php
            //delete query waar id overeenkomnt
            if(isset($_GET["delete"]) == true)
            {
                $query = "DELETE FROM Diner WHERE DinerNummer = " . $DNMR . ";";
                $result = executeQuery($query);
                if($result)
                {
                    echo "<div class='updated'>";
                    echo "<p>Diner verwijderd.</p>";
                    echo "<a href='bewerkpagina.php'>Terug naar de lijst</a>";
                    echo "</div>";
                }
                else
                {
                    echo "<div class='updated'>";
                    echo "<p>Diner niet verwijderd.</p>";
                    echo "</div>";
                }
            }
            ?>
</main>
<?php
//include footer
include("../includes/footer.php");
?>
</body>
</html>