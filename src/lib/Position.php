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
    public function updateTurn(int $a): int
    {
        switch ($a) {
            case -90:
                $a = 270;
                break;
            case 360:
                $a = 0;
                break;
        }
        return $a;
    }


    public function updateMove($x, $y, $a, $key): ?array
    {
        switch ($a) {
            case '0':
                switch ($key) {
                    case 'w':
                        $x++;
                        break;
                    case 's':
                        $x--;
                        break;
                    case 'a':
                        $y++;
                        break;
                    case 'd':
                        $y--;
                        break;
                    case 'q':
                        $a += 90;
                        break;
                    case 'e':
                        $a -= 90;
                        break;
                }
                return [$x, $y, $a];
            case '90':
                switch ($key) {
                    case 'w':
                        $y++;
                        break;
                    case 's':
                        $y--;
                        break;
                    case 'a':
                        $x--;
                        break;
                    case 'd':
                        $x++;
                        break;
                    case 'q':
                        $a += 90;
                        break;
                    case 'e':
                        $a -= 90;
                        break;
                }
                return [$x, $y, $a];
            case '180':
                switch ($key) {
                    case 'w':
                        $x--;
                        break;
                    case 's':
                        $x++;
                        break;
                    case 'a':
                        $y--;
                        break;
                    case 'd':
                        $y++;
                        break;
                    case 'q':
                        $a += 90;
                        break;
                    case 'e':
                        $a -= 90;
                        break;
                }
                return [$x, $y, $a];
            case '270':
                switch ($key) {
                    case 'w':
                        $y--;
                        break;
                    case 's':
                        $y++;
                        break;
                    case 'a':
                        $x++;
                        break;
                    case 'd':
                        $x--;
                        break;
                    case 'q':
                        $a += 90;
                        break;
                    case 'e':
                        $a -= 90;
                        break;
                }
                return [$x, $y, $a];
            default:
                return NULL;
        }
    }
}