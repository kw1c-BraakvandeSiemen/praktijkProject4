<!--
  Auteur: Siemen van de Braak
  Aanmaakdatum: 06-04-2022
  Omschrijving: navbar
-->
<link href="../styles/navbar.css" rel="stylesheet">
<script src="../js/navbar.js" defer></script>

<div class="headerAfbeeld" style="background-image: url('/Praktijk/Thema4/T4_PraktijkProject/images/header_home_afbeelding.jpg'); background-position: 0 50%;">
</div>

<?php
//zorgt ervoor dat cannot redeclare function error opgelost word
include_once("db_functions.php");

//start de connection
startConnection();

//Session doet moelijk omdat hij aangeeft dat er al 1 actief is dit checkt of dat zo is
if(!isset($_SESSION))
{
    session_start();
}
?>

<div class="navbar">
    <!-- afbeelding in navbar linken naar homepage -->
    <a href="../index.php"><img class="logo" src="/Praktijk/Thema4/T4_PraktijkProject/images/kw1cLogo.svg" alt="Logo"></a>
    <nav>
        <ul id="menuList">
            <li><a href="/Praktijk/Thema4/T4_PraktijkProject/index.php">Home</a></li>
            <?php
            //checken of user is ingelogd
            if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
            {
                echo "<li><a href='/Praktijk/Thema4/T4_PraktijkProject/pages/logout.php'>Uitloggen</a></li>";
                echo "<li><a href='/Praktijk/Thema4/T4_PraktijkProject/pages/overzichtpagina.php'>Overzicht</a></li>";
;               // Horeca studenten toegang geven tot de bewerkpagina
                if($_SESSION['opleiding'] == "Horeca")
                {
                    echo "<li><a href='/Praktijk/Thema4/T4_PraktijkProject/pages/bewerkpagina.php'>Bewerken</a></li>";
                }
            }
            else
            {
                echo "<li><a href='/Praktijk/Thema4/T4_PraktijkProject/pages/login.php'>Inloggen</a></li>";
            }
            ?>
        </ul>
    </nav>
    <!-- functie voor hamburger menu mobiel weergaven -->
    <img class="menu" src="/Praktijk/Thema4/T4_PraktijkProject/images/hamburg1.png" alt="HMenu" onclick="togglemenu()">
</div>