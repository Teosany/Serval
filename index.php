<?php
declare(strict_types=1);

spl_autoload_register(static function ($fqcn): void {
    $path = sprintf('%s.php', str_replace(['App', '\\'], [__DIR__, '/'], $fqcn));

    require_once $path;
});

use App\src\controllers\Homepage;
use App\src\controllers\Move;
use App\src\controllers\Take;
use App\src\lib\Database;
use App\src\lib\PositionActuel;

try {
    $homepage = new Homepage();
    $homepage->positionRep = new PositionActuel();
    $homepage->positionRep->connection = new Database();

    if (isset($_POST['key']) && $_POST['key'] === 'r') {
        $take = new Take($homepage);

        header('Content-Type: application/json; charset=utf-8');
        $response = $take->take($_POST['x'], $_POST['y'], $_POST['a'], $_POST['key']);

        echo json_encode($response);

    } elseif (isset($_POST['key'])) {
        $move = new Move($homepage);

        header('Content-Type: application/json; charset=utf-8');
        $response = $move->move((int)$_POST['x'], (int)$_POST['y'], (int)$_POST['a'], $_POST['key']);

        echo json_encode($response);
    } else {
        try {
            $homepage->execute();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();

            require('templates/error.php');
        }
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}