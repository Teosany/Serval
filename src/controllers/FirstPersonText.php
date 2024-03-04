<?php

namespace App\src\controllers;

use App\src\models\PositionActuel;

class FirstPersonText extends PositionActuel
{
    public string $srcText;
    public function __construct($data)
    {
        $this->srcText = $data;
    }
}