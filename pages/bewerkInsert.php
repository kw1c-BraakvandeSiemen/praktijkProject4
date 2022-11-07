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
    <link href="../styles/startpagina.css" rel="stylesheet">
    <link href="../styles/navbar.css" rel="stylesheet">
    <link href="../styles/Bewerk.css" rel="stylesheet">
    <script src="../js/navbar.js" defer> </script>
</head>
<body>
<header>
    <?php
    //include navbar
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
if (isset($_POST["Opslaan"])) {
    include_once("../includes/db_functions.php");
    //start de connection
    startConnection();
    $query = "USE HorecaKW1C;";
    executeQuery($query);

    // Format de dtCreateDate naar een Amerikaans formaat (yyyy-mm-dd)
    $formattedDateStart = date("Y-m-d H:i", strtotime($_POST["Startmoment"]));
    $formattedDateEnd = date("Y-m-d H:i", strtotime($_POST["Eindmoment"]));
    $query = "INSERT INTO Diner VALUES ('" . $_POST["Omschrijving"] . "', '" .
        $formattedDateStart . "', '" . $formattedDateEnd . "', '" . $_POST["Locatie"] . "')";
    //echo $query;
    // $result = executeQuery($query);

    $rowsAffected = insertIntoQuery($query);
    if ($rowsAffected > 0)
    {
        echo "<div class='updated'>";
        echo "<p>Het diner is opgeslagen in de Database</p>";
        echo "<a href=\"bewerkpagina.php\">Ga Terug</a>";
        echo "</div>";
    }
    else
    {
        echo "<div class='updated'>";
        echo "<p>Er is iets fout gegaan. Probeer het opnieuw.</p>";
        echo "<a href=\"bewerkpagina.php\">Ga Terug</a>";
        echo "</div>";
    }
}
?>
    <?php
    if (!isset($_POST["Opslaan"])) {
    echo '<form action="../pages/bewerkInsert.php" method="post">
        <div class="ins">
            <label for="Omschrijving">Omschrijving:</label>
            <input required type="text" name="Omschrijving">
            <br>
            <label for="Startmoment">Startmoment:</label>
            <input required type="datetime-local" name="Startmoment">
            <br>
            <label for="Eindmoment">Eindmoment:</label>
            <input required type="datetime-local" name="Eindmoment">
            <br>
            <label for="Locatie">Locatie:</label>
            <input required type="text" name="Locatie">
            <br>

            <input type="submit" name="Opslaan" value="Opslaan">
        </div>
        </form>';
            }
?>
</main>
<?php
//include footer
include("../includes/footer.php");
?>
</body>
</html>
