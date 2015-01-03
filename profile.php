<?php
    session_start();
    require_once("db.php");
    $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="/img/favicon.ico?v=2">
    <meta name="google-site-verification" content="Z-sBx9d3kgXBU00XEDE6krv3-hik_uNqF2-amWunO3M" />
    <link href="/css/bootstrap.min.css?v=1" rel="stylesheet">
    <link href="/css/flat-ui.min.css?v=1.11" rel="stylesheet">
    <link href="/css/style.css?v=12.29.3.44" rel="stylesheet" />
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
        <h1>Your Profile</h1>
        <p style="font-family:lato">Here is your profile</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3" style="">
                <div>
                    <?php
                            echo '<img src="https://image.eveonline.com/Character/' . $_SESSION['auth_characterid'] . '_64.jpg\">';
                            echo "<b>" . $_SESSION['auth_charactername'] . "</b>";
                            echo "</div>";
                            echo "<div>
                            </div>";
                            echo "</div>
                            <div class='col-md-8' style=''>";
                            echo "<h4><u>Current Missions</u></h4>";
                            $charName = $_SESSION['auth_charactername'];
                            $pilotQuery = "SELECT * FROM user where character_name='$charName'";
                            $pilotRow = mysqli_fetch_array($db_connection->query($pilotQuery));
                            $journalQuery = "SELECT * FROM journal where pilotID='" . $pilotRow['id'] . "'";
                            $journalResult = $db_connection->query($journalQuery);

                            echo '<table width="100%" class="table table-striped">';
                            echo '<tr><th>Name</th><th>Agent</th><th>Reward</th><th>Status</th></tr>';
                            while ($journalRow = mysqli_fetch_array($journalResult)) {
                                #Setup for each row
                                $missionQuery = "SELECT * FROM missions WHERE id='" . $journalRow['missionID'] . "'";
                                $missionRow = mysqli_fetch_array($db_connection->query($missionQuery));

                                echo "<tr>";
                                echo "<td><a href='mission.php?id=" . $missionRow['id'] . "'>" . $missionRow['name'] . "</td>";
                                echo "<td>" . $missionRow['agent'] . "</td>";
                                echo "<td>" . $missionRow['reward'] . "</td>";

                                switch ($journalRow['state']) {
                                    case 0:
                                        echo "<td>" . "Not accepted" . "</td>";
                                        break;
                                    case 1:
                                        echo "<td>" . "Completed" . "</td>";
                                        break;
                                    case 2:
                                        echo "<td>" . "Accepted" . "</td>";
                                        break;
                                    case 3:
                                        echo "<td>" . "In progress" . "</td>";
                                        break;
                                    case 4:
                                        echo "<td>" . "Failed" . "</td>";
                                        break;
                                }


                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
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
