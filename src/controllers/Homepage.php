<?php

namespace App\src\controllers;

use App\src\lib\Database;
use App\src\models\PositionActuel;


class Homepage
{
    public ?string $key = 'sd';

    public PositionActuel $positionRep;

    public function execute(): void
    {
        $this->positionRep = new PositionActuel();
        $this->positionRep->connection = new Database();
        $data = $this->positionRep->getPosition();

        if($data[0] !== null) {
            $srcText = new FirstPersonText($data[0]);
            $this->positionRep->firstPersonT = $srcText->srcText;
        }
        $srcImage = new FirstPersonView($data[1], $data[2]);

        $this->positionRep->firstPersonV = $srcImage->srcImage;
        $this->positionRep->firstPersonC = $srcImage->srcCompas;

        require 'templates/homepage.php';
    }
    public function setKey(string $key): void
    {
        $this->key = $key;
    }
}
