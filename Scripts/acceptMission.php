<?php
session_start();
require_once("../db.php");
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$id_get = htmlspecialchars($_GET['id']);
# Disabled for testing $charName =  $_SESSION['charactername'];
$charName = "vampire Huunuras";

# Queries for interacting with both databases
$missionQuery = "SELECT * FROM missions where id='$id_get'";
$pilotQuery = "SELECT * FROM user where character_name='$charName'";
# First goes through both mission and pilot tables gathering data.
$missionRow = mysqli_fetch_array($db_connection->query($missionQuery));
$pilotRow = mysqli_fetch_array($db_connection->query($pilotQuery));
# Can now go though journal table as it has the correct info
$journalQuery = "SELECT * FROM journal where pilotId='" . $pilotRow['id'] . "' AND missionId='" . $missionRow['id'] . "'";
$journalRow = mysqli_fetch_array($db_connection->query($journalQuery));

if ($journalRow == null) {
    # Pilot does not have mission.
    $insertQuery = "INSERT INTO journal (pilotID, missionID, state)
    VALUES (" . $pilotRow['id'] . "," .  $missionRow['id'] . ", 2 )";

    if ($db_connection->query($insertQuery) === TRUE){
        echo "You have accepted the mission";
    }
} else {
    #Pilot already have mission
    echo "Pilot already has mission";
}
#add mission info to journal



?>
