<?php
    session_start();
    require_once("../db.php");
    $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="/img/favicon.ico?v=12.30.9.34">
    <meta name="google-site-verification" content="Z-sBx9d3kgXBU00XEDE6krv3-hik_uNqF2-amWunO3M" />
    <link href="/css/bootstrap.min.css?v=1" rel="stylesheet">
    <link href="/css/flat-ui.min.css?v=1.11" rel="stylesheet">
    <link href="/css/style.css?v=12.30.10.41" rel="stylesheet" />
    <meta charset="utf-8">
    <?php include("../heatmap.php"); ?>
    <?php include("../functions.php"); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Completeing Mission</title>
</head>

<body onload="setInterval(function(){$.post('/refresh_session.php');},270);">
    <div class="container-fluid jumbotron text-center">
        <h1>Mission Completion</h1>
        <p style="font-family:lato">Time to complete this mission</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                } else {
                    # Displaying form for mission completion
                    echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';

                    $id_get = htmlspecialchars($_GET['id']);
                    $charName =  $_SESSION['auth_charactername'];

                    # Queries for interacting with both databases
                    $missionQuery = "SELECT * FROM missions where id='$id_get'";
                    $pilotQuery = "SELECT * FROM user where character_name='$charName'";
                    # First goes through both mission and pilot tables gathering data.
                    $missionRow = mysqli_fetch_array($db_connection->query($missionQuery));
                    $pilotRow = mysqli_fetch_array($db_connection->query($pilotQuery));

                    # These vars are displayed for the users benefit
                    echo'<fieldset disabled>';
                        echo'<div class="form-group">';
                          echo'<label for="disabledTextInput">Mission Name</label>';
                          echo'<input type="text" id="missioName" class="form-control" placeholder="' . $missionRow['name'] . '">';
                        echo'</div>';

                        echo'<div class="form-group">';
                          echo'<label for="disabledTextInput">Mission Agent</label>';
                          echo'<input type="text" id="missionAgent" class="form-control" placeholder="' . $missionRow['agent'] . '">';
                        echo'</div>';

                    echo'</fieldset>';

                    echo'<div class="form-group">';
                        echo'<label for="exampleInputFile">Proof of mission completion</label>';
                        echo'<input type="file" id="exampleInputFile">';
                        echo'<p class="help-block">Files extensions that are accepted: .jpg .png .gif</p>';
                    echo'</div>';

                    echo'<button type="submit" class="btn btn-primary">Submit</button>';
                    echo'</form>';
                }

                  ?>

            </div>
        </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
