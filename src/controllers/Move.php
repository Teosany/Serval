<?php

namespace App\src\controllers;

use App\src\lib\Database;
use App\src\lib\PositionActuel;
use App\src\models\MoveA;

class Move
{
    public PositionActuel $positionRep;

    public function __construct(PositionActuel $positionRep)
    {
        $this->positionRep = $positionRep;
        $this->positionRep->connection = new Database();
    }

    public function move(int $x, int $y, int $a, string $key): array
    {
        $this->positionRep->setCord($x, $y, $a, $key);

        $response = $this->positionRep->updateMove();

        $a = $this->positionRep->updateTurn($response[2]);

        $x = $response[0];
        $y = $response[1];

        $query = new MoveA($this->positionRep);
        return $query->move($x, $y, $a);
    }
}