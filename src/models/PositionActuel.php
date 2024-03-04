<?php

namespace App\src\models;

use App\src\lib\Database;
use App\src\lib\Position;

class PositionActuel extends Position
{
    public Database $connection;
    public string $firstPersonV;
    public string $firstPersonT;
    public string $firstPersonC;

    public function getPosition(): array
    {
        $x = parent::getX();
        $y = parent::getY();
        $a = parent::getAngle();

        $statement = $this->connection->query(
            "SELECT text, i.path, compas FROM map m inner JOIN images i ON m.id = i.map_id INNER JOIN text t ON m.id = t.map_id WHERE coordX = $x AND coordY = $y AND direction = $a"
        );

        return $statement->fetch();
    }
}