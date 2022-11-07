<?php
/**
 * User: Siemen van de Braak
 * Date: 02/06/2022
 * File: uitlog pagina
 */
?>

<?php
include_once("../includes/db_functions.php");

// start connectie met database
startConnection();

//start de session
session_start();
Session_destroy();
header("Location: ../index.php");

?>
