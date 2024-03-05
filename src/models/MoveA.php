<?php
declare(strict_types=1);

namespace App\src\models;

use App\src\lib\PositionActuel;

class MoveA
{
    private PositionActuel $positionRep;

    public function __construct(PositionActuel $positionRep)
    {
        $this->positionRep = $positionRep;
    }
    public function moveA(int $x, int $y, int $a): array
    {
        $statement = $this->positionRep->connection->query(
            "SELECT coordX, coordY, direction, text, path, compas FROM map m
    inner JOIN images i ON m.id = i.map_id INNER JOIN text t ON m.id = t.map_id
    WHERE coordX = $x AND coordY = $y AND direction = $a"
        );

        if (is_array($row = $statement->fetch())) {
            return array("x" => $x, "y" => $y, "a" => $a, "image" => $row['path'], 'text' => $row['text'], 'compas' => $row['direction']);
        } else {
            return array('error' => 'error', 'data' => $statement);
        }
    }
}