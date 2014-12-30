<?php
session_start();
require_once("../db.php");
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$id_get = htmlspecialchars($_GET['id']);

# Queries for interacting with both databases
$missionQuery = "SELECT * FROM missions where id='$id_get'";
$pilotQuery = "SELECT * FROM user where character_name=''";
$jornualQuery = "SELECT * FROM jornual where pilotId=''";




?>
