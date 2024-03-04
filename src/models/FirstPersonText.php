<?php

namespace App\src\models;

class FirstPersonText extends PositionActuel
{
    public string $srcText;
    public function __construct($data)
    {
        $this->srcText = $data;
    }
}