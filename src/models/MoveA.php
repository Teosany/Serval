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
            "SELECT coordX, coordY, direction, path, compas, m.status_action, text, requis
    FROM map m
    inner JOIN images i ON m.id = i.map_id
    inner JOIN text t ON t.map_id = m.id 
    left JOIN actions a ON a.map_id = m.id
    WHERE coordX = $x AND coordY = $y AND direction = $a AND CASE WHEN a.requis = 1 THEN i.status_action = 1 AND t.status_action = 1
ELSE i.status_action = 0 END"
        );

        if (is_array($row = $statement->fetch())) {
            if ($row['status_action'] === 1) {
                $sql = $this->positionRep->connection->query("SELECT text FROM text WHERE status_action = 1");
                $row1 = $sql->fetch();
                $row['text'] = $row1['text'];
            }
            return array("x" => $x, "y" => $y, "a" => $a, "image" => $row['path'], 'text' => $row['text'], 'compas' => $row['direction'], 'status' => $row['status_action']);
        } else {
            return array('error' => 'error', 'data' => $statement);
        }
    }
}