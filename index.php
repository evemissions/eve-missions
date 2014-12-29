<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="/img/favicon.ico?v=2">
    <meta name="google-site-verification" content="Z-sBx9d3kgXBU00XEDE6krv3-hik_uNqF2-amWunO3M" />
    <link href="/css/bootstrap.min.css?v=1" rel="stylesheet">
    <link href="/css/flat-ui.min.css?v=1.11" rel="stylesheet">
    <link href="/css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>EVE Missions</title>
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
                <a href="/">
                    <!--<img src="/img/EM_logo.png?v=1.1" style="width: 50px; height: auto; float: left; margin-right: 9px; margin-top: 35px;">-->
                </a>
                <a href="/" class="navbar-brand">eve missions</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Home</a>
                    </li>
                    <li>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Current Missions</a>
                        <ul class="dropdown-menu">
                            <li><a href="/list.php">All</a>
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
        <h1>eve missions</h1>
        <p style="font-family:lato">Player-created missions with ISK rewards</p>
    </div>
    <div class="container">
        <p>We're still working on the site, please check <a href="http://www.reddit.com/r/evemissions">the subreddit</a> for news and updates. If you are interested in helping out for free, please fill out <a href="http://goo.gl/forms/lbtmOQA2JQ">the form</a>. In addition, if you wish to help out the site for free, please join the IRC channel <b>##evemissions</b> at <a href="http://webchat.freenode.net">Freenode</a>. I hope to see you all soon!</p>
    </div>
    <div class="modal fade" id="about" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>About EVE Missions</h4>
                </div>
                <div class="modal-body">
                    <p>EVE Missions is a site that provides player-created missions for EVE players to do to learn more about the game.</p>

                    <div><h5> The Team </h5></div>
                    <div><table style="text-align:center">
                        <tr><td><a href="https://gate.eveonline.com/Profile/Marquis%20de%20Nardieu"><img src="https://image.eveonline.com/Character/95131473_64.jpg"/></a></td>
                        <td><a href="https://gate.eveonline.com/Profile/vampire%20Huunuras"><img src="https://image.eveonline.com/Character/90792652_64.jpg"/></a></td></tr>
                        <tr><td><b>Owner</b></td>&nbsp;&nbsp;
                            <td><b>Head Developer</b></td>
                        </tr>
                        <tr>
                            <td>GreenLittleApple</td>&nbsp;&nbsp;
                            <td>Vamps</td>
                        </tr></table></div>

                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
