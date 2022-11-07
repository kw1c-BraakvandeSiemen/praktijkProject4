<?php
/**
 * User: Siemen van de Braak
 * Date: 12/05/2022
 * File: db functies
 */
?>

<?php

// Een "leeg" $pdo variabele aanmaken
$pdo = null;

// Starten van een DB connectie
function startConnection()
{
    global $pdo;
    // Open de database connectie en ODBC driver
    try
    {
        $pdo = new PDO("odbc:odbc2sqlserver");
        //speciefieke database selecteren
        //$pdo->query("USE pokemondb");
    }
    catch (PDOException $e)
    {
        echo "<h1>Database error:</h1>";
        echo $e->getMessage();
        die();
    }
}

// Uitvoeren van een query SELECT
function executeQuery($query)
{
    global $pdo;
    // Uitvoeren van een SQl query
    try
    {
        // Query uitvoeren
        $result = $pdo->query($query);
        return $result;
    }
    catch (PDOException $e)
    {
        echo 'Foutmelding: ' . $e->getMessage();
        die();
    }
}


function insertIntoQuery($query)
{
    global $pdo;

    try {
        // Voer de SQL query uit op de database
        $rowsAffected = $pdo->exec($query);
    }
    catch(PDOException $exception)
    {
        $rowsAffected = 0;
        echo "<p style='color: red'>Er is een error opgetreden: <br> " . $exception->getMessage() . "</p>";
    }
    return $rowsAffected;
}

function executeInsertQuery($query)
{
    global $pdo;

    try
    {
        $rowsAffected = $pdo->exec($query);
    }
    catch(PDOException $error)
    {
        $rowsAffected = 0;
        echo "<p>Er is een error opgetreden: ". $error->getMessage() . "</p>";
    }

    return $rowsAffected;
}
