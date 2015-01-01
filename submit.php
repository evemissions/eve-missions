<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="/img/favicon.ico?v=12.30.9.34">
    <meta name="google-site-verification" content="Z-sBx9d3kgXBU00XEDE6krv3-hik_uNqF2-amWunO3M" />
    <link href="/css/bootstrap.min.css?v=1" rel="stylesheet">
    <link href="/css/flat-ui.min.css?v=1.11" rel="stylesheet">
    <?php include("heatmap.php"); ?>
    <?php include("functions.php"); ?>
    <link href="/css/style.css?v=12.30.10.41" rel="stylesheet" />
    <meta charset="utf-8">
    <script>
    $('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
    </script>
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
            x = document.forms["submitform"]["task"].value;
            if (x == null || x == "") {
                alert("Task must be filled out");
                return false;
            }
            x = document.forms["submitform"]["reward"].value;
            if (x == null || x == "") {
                alert("Reward must be filled out");
                return false;
            }
            <?php if(!($_SESSION[auth_charactername]==="EVE-Missions")) {
                echo "alert(\"Submitting missions is currently limited to the owner of the site.\");";
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
                <a href="/" class="navbar-brand">eve-missions</a>
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
    <div style="background: url(/img/eve_opt.jpg); !important" class="container-fluid jumbotron text-center">
        <h1>submit a mission</h1>
        <p style="font-family:Lato">Submit custom missions to the EVE-Missions database</p>
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
                    <label>Task *</label>
                    <br />
                    <textarea style="font-size:14px; width: 100%" name="task"></textarea>
                    <br />
                    <label data-toggle="tooltip" data-original-title="Examples: 100, 100000, 100000000">Mission Rewards *</label>
                    <br />
                    <textarea style="font-size:14px; width: 100%" name="reward"></textarea>
                    <br />
                </div>
                <div class="col-md-4">
                    <label data-toggle="tooltip" data-original-title="Add extra info here">Additional Details</label>
                    <br />
                    <textarea style="font-size:14px; width: 100%" name="bonusdetails"></textarea>
                    <br />
                    <label data-toggle="tooltip" data-original-title="Add bonus details and reward">Bonus Details and Rewards</label>
                    <br />
                    <textarea style="font-size:14px; width: 100%" type="text" name="bonusreward" /></textarea>
                    <br />
                </div>
            </div>
            <br>
            <div style="text-align: right">
                <p style="color: red">* required field</p>
            </div>
            <div style="text-align: center">
                <input type="submit" />
                <input type="hidden" name="response" value="submit" />
            </div>
        </form>
    </div>
    <?php include("modal.php"); ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
</body>

</html>