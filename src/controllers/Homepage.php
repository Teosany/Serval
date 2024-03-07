<?php

namespace App\src\controllers;

use App\src\lib\PositionActuel;


class Homepage extends PositionActuel
{
    public PositionActuel $positionRep;

    public function execute(): void
    {
        require 'templates/homepage.php';
    }
}
