<?php
require_once("../db.php");
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
session_start();
$pilotQuery = "SELECT * from user WHERE characterid='" . $_SESSION['auth_characterid'] . "'";
$pilotRow = mysqli_fetch_array($db_connection->query($pilotQuery));


if ($pilotRow['isAdmin'] == false) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="img/favicon.ico?v=12.30.10.25">
    <meta name="google-site-verification" content="Z-sBx9d3kgXBU00XEDE6krv3-hik_uNqF2-amWunO3M" />
    <link href="/css/bootstrap.min.css?v=1" rel="stylesheet">
    <link href="/css/flat-ui.min.css?v=1.11" rel="stylesheet">
    <link href="/css/style.css?v=12.30.10.41" rel="stylesheet" />
    <meta charset="utf-8">
    <?php include("../heatmap.php"); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>EVE-Missions</title>
    <meta name="description" content="Player-created missions with ISK rewards">
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
                    <li class="active"><a href="/">Home</a>
                    </li>
                    <li><a href="/index.php">Back To Site</a>
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
    <div class="container" style="text-align:center">
        <?php
            $ticketsQuery = "SELECT * FROM tickets WHERE status='0'";
            echo "<table class='table table-striped'";
            echo "<tr><th>Title</th><th>Category</th><th>DateTime opened</th></tr>";
            $result = $db_connection->query($ticketsQuery);
            while($ticketsRow = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>"  . $ticketsRow['title'] . "</td>";
                switch ($ticketsRow['category']) {
                    case 1:
                        echo "<td>" . "Mission Completion" . "</td>";
                        break;
                    case 2:
                        echo "<td>"  . "Mission Error" . "</td>";
                        break;
                }
                echo "<td>"  . $ticketsRow['dateOpened'] . "</td>";
                echo "</tr>";

            }
            echo "</table>";
        ?>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
