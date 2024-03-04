<?php

namespace App\src\lib;

class Position
{
    protected ?int $currentX = 0;
    protected ?int $currentY = 0;
    protected ?int $currentAngle = 0;
    public function getX(): int
    {
        return $this->currentX;
    }

    public function getY(): int
    {
        return $this->currentY;
    }

    public function getAngle(): int
    {
        return $this->currentAngle;
    }

    public function setX(int $x): void
    {
        $this->currentX = $x;
    }

    public function setY(int $y): void
    {
        $this->currentY = $y;
    }

    public function setAngle(int $angle): void
    {
        $this->currentAngle = $angle;
    }

    public function checkForward(): bool
    {
        return true;
    }

    public function checkBack(): bool
    {
        return true;
    }

    public function checkRight(): bool
    {
        return true;
    }

    public function checkLeft(): bool
    {
        return true;
    }

    public function checkTurnRight(): bool
    {
        return true;
    }

    public function checkTurnLeft(): bool
    {
        return true;
    }

    private function checkMove($x, $y, $angle): int
    {
        return true;
    }

    public function goForward()
    {

    }
    public function goBack()
    {

    }
    public function goRight()
    {

    }
    public function goLeft()
    {

    }
    public function turnRight()
    {

    }
    public function turnLeft()
    {

    }
}