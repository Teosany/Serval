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
    SELECT description, path, m.status_action
    FROM map m
    inner JOIN images i ON m.id = i.map_id 
    inner JOIN actions a ON a.map_id = m.id
    inner JOIN items it ON it.id = a.item_id
    WHERE coordX = $x AND coordY = $y AND direction = $a AND i.status_action = 1"
        );

        if (is_array($row = $statement->fetch())) {
            $sql = $this->positionRep->connection->query("UPDATE actions SET requis = 1 WHERE action = 'take'");
            $sql = $this->positionRep->connection->query("UPDATE map SET status_action = 1");

            return array("image" => $row['path'], 'text' => $row['description'], 'status' => 1);
        } else {
            return array('error' => 'error', 'data' => $statement);
        }

    }
    public function UseA(int $x, int $y, int $a): array
    {
        $statement = $this->positionRep->connection->query(
            "SELECT text, path, i.status_action FROM text t inner JOIN images i ON t.map_id = i.map_id WHERE i.status_action = 2"
        );
        if (is_array($row = $statement->fetch())) {
            $sql = $this->positionRep->connection->query("UPDATE actions SET requis = 0 WHERE action = 'take'");
            $sql = $this->positionRep->connection->query("UPDATE map SET status_action = 0");
            $sql = $this->positionRep->connection->query("UPDATE actions SET requis = 1 WHERE action = 'use'");

            return array('text' => $row['text'], 'image' => $row['path'], 'status' => $row['status_action']);
        } else {
            return array('error' => 'error', 'data' => $statement);
        }
    }
}