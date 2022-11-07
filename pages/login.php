<?php
/**
 * User: Siemen van de Braak
 * Date: 02/06/2022
 * File: inlog pagina
 */
?>

<?php
//inladen database functionaliteiten

include_once("../includes/db_functions.php");

// start connectie met database
startConnection();

//start de session
session_start();

//inlog query bouwe
if (isset($_POST["txtUsername"]) && isset($_POST["txtPassword"]))
{
    //variabelen declareren
    $username = $_POST["txtUsername"];
    $password = $_POST["txtPassword"];

    //inloggen via query
    $query = "SET NOCOUNT ON; USE HorecaKW1C; SELECT * FROM Student WHERE Naam = '$username' AND Wachtwoord = '$password'";

    //uitvoeren van de query
    $resultaat = executeQuery($query);

    //Haal een row op uit het resultaat
    $row = $resultaat->fetch(PDO::FETCH_ASSOC);

    //bepalen of er correct is ingelogd
    if ($row == false)
    {
        // Gebruiker logt niet juist in
        $onjuist = true;
        //foutieve poging
        $foutMelding = "<p class='onjuist'>Error. Username en of Wachtwoord onjuist</p>";
    }
    else
    {
        //opslaan in de $_SESSION dat er correct is ingelogd
        $_SESSION['loggedIn'] = true;
        $_SESSION['opleiding'] = $row['Opleiding'];
        $_SESSION['naam'] = $row['Naam'];
        header("Location: /Praktijk/Thema4/T4_PraktijkProject/index.php");
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KW1C_Horeca_School</title>
    <meta name="description" content="My Page Description">
    <link href="../styles/login.css" rel="stylesheet">
    <link href="../styles/navbar.css" rel="stylesheet">
    <script src="../js/navbar.js" defer> </script>
</head>
<header>
    <?php
    //include navbar
    include("../includes/navbar.php");
    ?>
</header>
<body>
<main>
    <form action="login.php" method="post">
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" name="txtUsername" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" name="txtPassword" required>

            <button type="submit">Login</button>
            <?php
                if (isset($onjuist))
                {
                echo $foutMelding;
                }
            ?>
        </div>
    </form>
</main>
<?php
//include footer
include("../includes/footer.php");
?>
</body>
</html>