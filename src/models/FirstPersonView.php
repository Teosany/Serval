<?php

namespace App\src\models;

class FirstPersonView
{
    const IMAGES = 'src/public/';
    private int $_mapId;
    public string $srcImage;
    public string $srcCompas;
    public function __construct($data1, $data2)
    {
        $this->srcImage = $this::IMAGES . $data1;
        $this->srcCompas = $data2;
    }
}