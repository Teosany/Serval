<?php

class BaseClass
{
    protected int $_currentX;
    protected int $_currentY;
    protected int $_currentAngle;
    protected object $_dbh;

    public function __construct()
    {
        $this->_dbh = new DataBase();
    }

    public function getX(): int
    {
        return $this->_currentX;
    }

    public function getY(): int
    {
        return $this->_currentY;
    }

    public function getAngle(): int
    {
        return $this->_currentAngle;
    }

    public function setX(int $x)
    {
        $this->_currentX = $x;
    }

    public function setY(int $y)
    {
        $this->_currentY = $y;
    }

    public function setAngle(int $angle)
    {
        $this->_currentAngle = $angle;
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