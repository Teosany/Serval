<?php
declare(strict_types=1);

namespace App\src\lib;

class PositionActuel extends Position
{
    public Database $connection;
    public function checkAction($x, $y, $a, $key): bool
    {
        if ($this->getCord() === [$x, $y, $a, $key]) {
            return true;
        } else {
            return false;
        }
    }
//    public function doAction(){
//
//    }
}