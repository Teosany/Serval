<?php
declare(strict_types=1);

namespace App\src\models;

use App\src\lib\PositionActuel;

class TakeA
{
    private PositionActuel $positionRep;

    public function __construct(PositionActuel $positionRep)
    {
        $this->positionRep = $positionRep;
    }

    public function TakeA(int $x, int $y, int $a): array
    {
        $statement = $this->positionRep->connection->query(
            "
    SELECT description, path
    FROM map m
    inner JOIN images i ON m.id = i.map_id 
    inner JOIN actions a ON a.map_id = m.id
    inner JOIN items it ON it.id = a.item_id
    WHERE coordX = $x AND coordY = $y AND direction = $a AND i.status_action = 1"
        );

        if (is_array($row = $statement->fetch())) {
            $sql = $this->positionRep->connection->query("UPDATE actions SET requis = 1 WHERE action = 'take'");
            $sql = $this->positionRep->connection->query("UPDATE map SET status_action = 1");

            return array("image" => $row['path'], 'text' => $row['description']);
        } else {
            return array('error' => 'error', 'data' => $statement);
        }

    }
}