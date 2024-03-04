<?php
session_start();
spl_autoload_register(function ($classname) {
    include $classname . '.class.php';
});

$base = new BaseClass();
$firstview = new FirstPersonView();
$firsttext = new FirstPersonText();

$x = $base->getCurrentX();
$y = $base->getCurrentY();
$direction = $base->getDirection();

$getview = '';
$forwardDisabled = '';

$getview = $firstview->getView($x, $y, $direction);

$getCompass = $firstview->getAnimCompass();
$getText = $firsttext->getText();

$forwardDisabled = $base->checkForward() ? '' : 'disabled';
$backwardDisabled = $base->checkBack() ? '' : 'disabled';
$leftDisabled = $base->checkLeft() ? '' : 'disabled';
$rightDisabled = $base->checkRight() ? '' : 'disabled';
$rotateLeftDisabled = $base->checkTurnLeft() ? '' : 'disabled';
$rotateRightDisabled = $base->checkTurnRight() ? '' : 'disabled';


// logique


// logique
if ($_SERVER["REQUEST_METHOD"] == "POST")  {
    if (isset($_POST["move_forward"]) && $base->checkForward()) {
        $base->goForward();
    }
    if (isset($_POST["move_left"]) && $base->checkLeft()) {
        $base->goLeft();
    }
    if (isset($_POST["move_back"]) && $base->checkBack()) {
        $base->goBack();
    }
    if (isset($_POST["move_right"]) && $base->checkRight()) {
        $base->goRight();
    }
    if (isset($_POST["rotate_Right"]) && $base->checkTurnRight()) {
        $base->rotateRight();
    }
    if (isset($_POST["rotate_Left"]) && $base->checkTurnLeft()) {
        $base->rotateLeft();
    }


    // Mettre à jour les coordonnées et l'orientation après chaque action
    $x = $base->getCurrentX();
    $y = $base->getCurrentY();
    $direction = $base->getDirection();

    // Mettre à jour les autres variables selon les nouvelles coordonnées et l'orientation
    $getview = $firstview->getView($x, $y, $direction);
    $getCompass = $firstview->getAnimCompass();
    $getText = $firsttext->getText();

    $forwardDisabled = $base->checkForward() ? '' : 'disabled';
    $backwardDisabled = $base->checkBack() ? '' : 'disabled';
    $leftDisabled = $base->checkLeft() ? '' : 'disabled';
    $rightDisabled = $base->checkRight() ? '' : 'disabled';
    $rotateLeftDisabled = $base->checkTurnLeft() ? '' : 'disabled';
    $rotateRightDisabled = $base->checkTurnRight() ? '' : 'disabled';

    // Afficher les messages d'écho après la mise à jour des coordonnées et de l'orientation
    $_SESSION['message'] = "cooredonée = " . $x . " " . $y . " " . $direction . " ";
}


//----------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Doom</title>
</head>

<body>
<div id="image">
    <img src="<?php echo $getview ?>" alt="FirstPersonViewr">
</div>
<div id="container">
    <div id="bouton-block">
        <form action="index.php" method="POST">
            <div id="deplacer">
                <button id="bt3" type="submit" name="move_left" <?php echo $leftDisabled; ?>>Gauche</button>
                <button id="bt1" type="submit" name="move_forward" <?php echo $forwardDisabled; ?>>Avancer</button>
                <button id="bt2" type="submit" name="move_back" <?php echo $backwardDisabled; ?>>Reculer</button>
                <button id="bt4" type="submit" name="move_right" <?php echo $rightDisabled; ?>>Droite</button>
            </div>
            <div id="tourner">
                <button id="bt5" type="submit" name="rotate_Right" <?php echo $rotateRightDisabled; ?>>Tourner à
                    droite</button>
                <button id="bt6" type="submit" name="rotate_Left" <?php echo $rotateLeftDisabled; ?>>Tourner à
                    gauche</button>
                <!-- <button id="bt7" type="submit" name="default" >default</button> -->
            </div>
        </form>
    </div>
    <div id="text-compass-block">
        <img src="assets/compass.png" id="comp-<?php echo $getCompass; ?>" alt="Compass">
        <p>
            <?php echo $getText; ?>

        </p>
    </div>
<!--    <div>-->
<!--        <p>-->
<!--            --><?php //echo $_SESSION['message'] ?>
<!--            --><?php //echo $_SESSION['message_id'] ?>
<!--        </p>-->
<!--    </div>-->
</div>
</body>
</body>

</html>