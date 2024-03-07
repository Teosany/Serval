<?php
declare(strict_types=1);

namespace App\src\controllers;

use App\src\lib\Database;
use App\src\lib\PositionActuel;
use App\src\models\TakeA;

class Take
{
    public PositionActuel $positionRep;

    public function __construct(PositionActuel $positionRep)
    {
        $this->positionRep = $positionRep;
        $this->positionRep->connection = new Database();
    }

    public function take(int $x, int $y, int $a): ?array
    {
        $this->positionRep->setCord($x, $y, $a, 'KeyR');

        if ($this->positionRep->checkAction($x, $y, $a, 'KeyR') === true) {
            $query = new TakeA($this->positionRep);

            return $query->TakeA($x, $y, $a);
        }

    return null;
    }
    public function use(int $x, int $y, int $a): ?array
    {
        $query = new TakeA($this->positionRep);

        return $query->UseA($x, $y, $a);
    }
}