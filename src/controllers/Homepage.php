<?php

namespace App\src\controllers;

use App\src\lib\Database;
use App\src\models\PositionActuel;


class Homepage extends \App\src\models\PositionActuel
{
    public PositionActuel $positionRep;

    public function execute(): void
    {
        require 'templates/homepage.php';
    }
}
