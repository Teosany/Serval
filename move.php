<?php

use App\src\controllers\Homepage;
use App\src\lib\Database;
use App\src\lib\Position;
use App\src\models\PositionActuel;

spl_autoload_register(static function ($fqcn): void {
    $path = sprintf('%s.php', str_replace(['App', '\\'], [__DIR__, '/'], $fqcn));

    require_once $path;
});

class move
{

    public Homepage $homepage;

    public function __construct(Homepage $homepage)
    {
        $this->homepage = $homepage;
    }

    function move($x, $y, $a)
    {
        header('location:move.php');

    }
}
