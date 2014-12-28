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
    <script>
        function validate() {
            var x = document.forms["submitform"]["title"].value;
            if (x == null || x == "") {
                alert("Title must be filled out");
                return false;
            }
            x = document.forms["submitform"]["details"].value;
            if (x == null || x == "") {
                alert("Details must be filled out");
                return false;
            }
            x = document.forms["submitform"]["reward"].value;
            if (x == null || x == "") {
                alert("Reward must be filled out");
                return false;
            }
            <?php if(!isset($_SESSION[auth_charactername])) {
                echo "alert(\"You must be logged on to submit missions!\");";
                echo "return false;";
            } ?>
        }
    </script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Submit Mission</title>
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
                    <li><a href="/">Home</a>
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
                    <li class="active">
                        <a href="/submit.php">Submit a Mission</a>
                    </li>
                    <li><a href="#help" data-toggle="modal">Help</a>
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
                            <a href='profile.php'>";
                        echo $_SESSION['auth_charactername'];
                        echo "</a></li>
                            <li><a href='/auth/logout.php'>(Logout)</a>
                        </li>";
                    } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div style="background: url(/img/eve_opt.jpg); !important" class="container-fluid jumbotron text-center">
        <h1>submit a mission</h1>
        <p style="font-family:Lato">Submit custom missions to the EVE Missions database</p>
    </div>
    <div class="container">
        <form name="submitform" action="form_submit.php" method="post" onsubmit="return validate();">
            <div class="row" style="text-align: center">
                <div class="col-md-4">
                    <label>Mission Title *</label>
                    <br>
                    <input style="width: 100%" type="text" name="title" />
                    <br>
                    <br>
                    <label>Who to Contact *</label>
                    <br/>
                    <input style="width: 100%; background-color: grey" value="<?php echo $_SESSION[auth_charactername]; ?>" type="text" name="agent" readonly="true" />
                    <br />
                </div>
                <div class="col-md-4">
                    <label>Mission Details *</label>
                    <br />
                    <textarea style="font-size:14px; width: 100%" name="details"></textarea>
                    <br />
                    <label>Mission Rewards *</label>
                    <br />
                    <textarea style="font-size:14px; width: 100%" name="reward"></textarea>
                    <br />
                </div>
                <div class="col-md-4">
                    <label>Bonus Details</label>
                    <br />
                    <textarea style="font-size:14px; width: 100%" name="bonusdetails"></textarea>
                    <br />

                    <label>Bonus Rewards</label>
                    <br />
                    <textarea style="width: 100%" type="text" name="bonusreward" /></textarea>
                    <br />
                </div>
            </div>
            <br>
            <div style="text-align: center">
                <input type="submit" />
                <input type="hidden" name="response" value="submit" />
            </div>
        </form>
    </div>
    <div class="modal fade" id="help" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Help!</h4>
                </div>
                <div class="modal-body">
                    <p>WIP</p>
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