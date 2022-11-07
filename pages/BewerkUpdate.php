<?php
//Auteur: Siemen van de Braak
//Aanmaakdatum: 14-06-2022
//Omschrijving: Bewerk update
?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KW1C_Horeca_School</title>
    <meta name="description" content="overzichtpagina">
    <link href="../styles/overzicht.css" rel="stylesheet">
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
include_once("../includes/db_functions.php");
startConnection();
$query = "USE HorecaKW1C;";
executeQuery($query);
// Maken en uitvoeren van de update query
if (
    empty($_POST["Omschrijving"]) == false &&
    empty($_POST["Startmoment"]) == false &&
    empty($_POST["Eindmoment"]) == false &&
    empty($_POST["Locatie"]) == false &&
    empty($_POST["HidId"]) == false
)
{
    //data formateren zodat het gelezen kan worden door de database en het geen secondes laat zien
    $StartmomentFormated = date("Y-m-d H:i:s", strtotime($_POST["Startmoment"]));
    $EindmomentFormated = date("Y-m-d H:i:s", strtotime($_POST["Eindmoment"]));
    $uptadeQuery = "UPDATE Diner 
    SET Omschrijving = '" . $_POST["Omschrijving"] . "',
    Startmoment = '". $StartmomentFormated ."',
    Eindmoment = '". $EindmomentFormated ."',
    Locatie = '". $_POST["Locatie"] ."'
    WHERE DinerNummer = ". $_POST["HidId"] ."
    ";

    //echo $uptadeQuery;
    $rowsAffected = executeInsertQuery($uptadeQuery);
    if ($rowsAffected)
    {
        echo "<div class='updated'>";
        echo "<p>Diner is updated.</p>";
        echo "<a href='bewerkpagina.php'>Terug naar het overzicht</a>";
        echo "</div>";
    }
    else
    {
        echo "<div class='updated'>";
        echo "<p>Diner is niet geupdate</p>";
        echo "</div>";
    }

}
else
{
    echo "<div class='updated'>";
    echo "<p>Er is iets fout gegaan.</p>";
    //gebruiker terug sturen naar de vorige pagina
    echo "<a onclick='history.back()'>Terug naar het formulier</a>";
    echo "</div>";

}
?>

</main>
<?php
//include footer
include("../includes/footer.php");
?>
</body>
</html>