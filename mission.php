<?php
    session_start();
    require_once("db.php");
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
    <?php include("heatmap.php"); ?>
    <?php include("functions.php"); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Mission</title>
</head>

<body onload="setInterval(function(){$.post('/refresh_session.php');},270);">
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand">eve-missions</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="active">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Current Missions</a>
                        <ul class="dropdown-menu">
                            <li class="active"><a href="/list.php">All</a>
                            </li>
                            <li><a href="#">Top Viewed</a>
                            </li>
                            <li><a href="#">Top Rated</a>
                            </li>
                            <li><a href="#">Newest</a>
                            </li>
                            <li><a href="#">Staff Picks</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/submit.php">Submit a Mission</a>
                    </li>
                    <li><a href="#about" data-toggle="modal">About</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(!isset($_SESSION['auth_charactername'])) {
                        echo "<li>
                            <a href='/auth/devlogin.php'><img src=\"/img/sso.png\">
                            </a>
                        </li>";
                    } else {
                        echo "<li>
                            <a style=\"padding-right: 0;\" href='profile.php'>";
                        echo $_SESSION['auth_charactername'];
                        echo "&nbsp;&nbsp;<img src=\"https://image.eveonline.com/Character/" . $_SESSION['auth_characterid'] . "_64.jpg\"></a></li>" .
                            "<li><a href='/auth/logout.php'>(Logout)</a>
                        </li>";
                    } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid jumbotron text-center">
        <h1>Mission</h1>
        <p style="font-family:lato">Here you can read up on your selected mission</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3" style="">
                <div>
                    <?php
                    $id_get = $_GET['id'];
                    $missionQuery = "SELECT * FROM missions WHERE ID ='$id_get'";
                    $result = $db_connection->query($missionQuery);
                        while($missionRow = mysqli_fetch_array($result)) {
                            echo '<img  style="float:left;padding-right:10px;" src="https://placekitten.com/g/64/64"/>';

                            echo "<b>" . $missionRow['agent'] . "</b>";
                            if ($missionRow['isTrusted'] = true) {
                                echo "<p style='color:blue;'>Trusted Submitter</p>";
                            } else {
                                echo "<p>Submitter</p>";
                            }

                            echo "</div>";
                            # Checking tables for more info for the options
                            $charName =  $_SESSION['auth_charactername'];
                            $pilotQuery = "SELECT * FROM user where character_name='$charName'";
                            $pilotRow = mysqli_fetch_array($db_connection->query($pilotQuery));
                            $journalQuery = "SELECT * FROM Journal WHERE pilotID='" . $pilotRow['id'] . "'";

                            echo "<div>
                                <h4><u>Actions</u></h4>
                                <a href='/Scripts/acceptMission.php?id=" . $missionRow['id'] . "'><p>Accept Mission</p></a>
                                <a href='/Scripts/completeMission.php?id=" . $missionRow['id'] . "'><p> Complete Mission</p></a>
                                <a href='/Scripts/failMission.php?id=" . $missionRow['id'] . "'><p> Fail Mission</p></a>
                                <p> Contact the mission owner</p>
                            </div>";
                            echo "</div>
                            <div class='col-md-8' style=''>
                                <div>";
                            $details = clickable($missionRow['bonusDetails']);


                            echo "<h4>" . $missionRow['name'] . "</h4>";
                            # no field for this in the database echo "<p>Objective:</p>";
                            echo "<p><b>Reward</b>: " . $missionRow['reward'] . " </p>";
                            echo "<p><b>Bonus</b>: " . $missionRow['bonusReward'] . " </p>";
                            echo "<p><b>Mission Details</b>: " . nl2br($missionRow['details']) . "</p>";
                            echo "<p><b>Task</b>: " . nl2br($missionRow['task']) . "</p>";
                            echo "<p><b>Additional Details</b>: " . nl2br($details) . "</p>";
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <?php include("modal.php"); ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
