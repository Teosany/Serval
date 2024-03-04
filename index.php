<?php

spl_autoload_register(static function ($fqcn): void {
    $path = sprintf('%s.php', str_replace(['App', '\\'], [__DIR__, '/'], $fqcn));

    require_once $path;
});

use App\src\controllers\Homepage;
use App\src\lib\Database;
use App\src\models\PositionActuel;

$homepage = new Homepage();
$homepage->positionRep = new PositionActuel();

if (isset($_POST['key'])) {

    $homepage->positionRep = new PositionActuel();
    $homepage->positionRep->connection = new Database();

    $x = 0;
    $y = 0;
    $a = 0;

    switch ($_POST['key']) {
        case 'w':
            $x++;
            break;
        case 's':
            $x--;
            break;
        case 'a':
            $y++;
            break;
        case 'd':
            $y--;
            break;
        case 'q':
            $a += 90;
            break;
        case 'e':
            $a -= 90;
            break;
    }

    $x += $homepage->positionRep->getX();
    $y += $homepage->positionRep->getY();

    switch ($a + $homepage->positionRep->getAngle()) {
        case -90:
            $a = 270;
            break;
        case 360:
            $a = 0;
            break;
        default:
            $a + $homepage->positionRep->getAngle();
    }

    $statement = $homepage->positionRep->connection->query(
        "SELECT coordX, coordY, direction, text, path, compas FROM map m
    inner JOIN images i ON m.id = i.map_id INNER JOIN text t ON m.id = t.map_id
    WHERE coordX = $x AND coordY = $y AND direction = $a"
    );

    if (is_array($row = $statement->fetch())) {
        $homepage->positionRep->setX($row[0]);
        $homepage->positionRep->setY($row[1]);
        $homepage->positionRep->setAngle($row[2]);
    }


    (new Move($homepage))->move($row[0], $row[1], $row[2]);

//    header('Content-Type: application/json; charset=utf-8');
//    $response = array("data" => '2', "debug" => 'F');
//    echo json_encode($response);

} else {
    try {
        $homepage->execute();
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();

        require('templates/error.php');
    }
}
