<?php
class FirstPersonView extends BaseClass
{
    const IMAGES = 'images/';
    private int $_mapId;
    public function getView(): string
    {
        return true;
    }
    public function getAnimCompass(): string
    {
        return true;
    }
}