<?php

namespace App\src\controllers;

use App\src\lib\Database;
use App\src\models\PositionActuel;
use App\src\models\MoveA;

class Move
{
    public PositionActuel $positionRep;

    public function __construct(PositionActuel $positionRep)
    {
        $this->positionRep = $positionRep;
        $this->positionRep->connection = new Database();
    }

    public function move($x, $y, $a, $key): array
    {
        $response = $this->positionRep->updateMove($x, $y, $a, $key);

        $a = $this->positionRep->updateTurn($response[2]);

        $x = $response[0];
        $y = $response[1];

        $query = new MoveA($this->positionRep);
        return $query->move($x, $y, $a);
    }
}