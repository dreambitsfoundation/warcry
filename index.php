<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Warcry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="text-align: center">WarCry</h2>
                    <br>
                    <h4><u>Instructions:</u></h4> <b>Warfield</b> is best visible when the browser zoom is at 50%.
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-1"
                             style="border: 1px solid grey; height: 20px; background-color: grey"></div>
                        <div class="col-sm-11">Active Warships</div>
                        <br><br>
                        <div class="col-sm-1"
                             style="border: 1px solid blue; height: 20px; background-color: blue"></div>
                        <div class="col-sm-11">Sunk Warships</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-1" style="border: 1px solid red; height: 20px; background-color: red"></div>
                        <div class="col-sm-11">Active Warhead</div>
                        <br><br>
                        <div class="col-sm-1"
                             style="border: 1px solid orange; height: 20px; background-color: orange"></div>
                        <div class="col-sm-11">Misfired Cell</div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="container game_container">

        </div>
<?php
    }
    else
    {

?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 style="text-align: center">Welcome to</h4>
                    <h1 style="text-align: center">WarCry</h1>
                    <div class="well">
                        <h4>Please Note:</h4>
                        <p>
                            Warfield is best visible at <b>50% Zoom</b>.
                            <br>
                            You may would like to adjust the browser zoom level before starting the game.
                        </p>
                    </div>
                    <br>
                    <form method="post" action="" style="text-align: center">
                        <button type="submit" class="btn btn-success btn-bg">Start Game</button>
                    </form>
                </div>
            </div>
        </div>
<?php

    }

?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script src="main.js"></script>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        require ('game.php');

        $game = new Game(10,10);
        $game->init_game();
?>

    <script type="application/javascript">
        var gameScenes = '<?php echo($game->generateAnimationFrames()); ?>';
        new Warfield($(".game_container"), gameScenes);
    </script>


<?php
    }
?>
</body>
</html>