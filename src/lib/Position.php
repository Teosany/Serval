<?php
declare(strict_types=1);

namespace App\src\lib;

class Position
{
    private ?int $currentX = 0;
    private ?int $currentY = 0;
    private ?int $currentAngle = 0;
    private ?string $currentKey;

    private function getX(): int
    {
        return $this->currentX;
    }
    private function getY(): int
    {
        return $this->currentY;
    }
    private function getAngle(): int
    {
        $a = $this->currentAngle;
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
    private function getKey(): string
    {
        return $this->currentKey;
    }

    protected function getCord(): array
    {
        return [$this->getX(),$this->getY(),$this->getAngle(),$this->getKey()];
    }

    private function setX(int $x): void
    {
        $this->currentX = $x;
    }
    private function setY(int $y): void
    {
        $this->currentY = $y;
    }
    private function setAngle(int $angle): void
    {
        $this->currentAngle = $angle;
    }
    private function setKey(string $key): void
    {
        $this->currentKey = $key;
    }
    public function setCord(int $x, int $y, int $a, string $key): void
    {
        $this->setX($x);
        $this->setY($y);
        $this->setAngle($a);
        $this->setKey($key);
    }

    public function updateTurn(int $a): int
    {
        $this->setAngle($a);

        return $this->getAngle();
    }

    public function updateMove(): ?array
    {
        $x = $this->getX();
        $y = $this->getY();
        $a = $this->getAngle();
        $key = $this->getKey();

        return match ($a) {
            0 => $this->checkForward($x, $y, $a, $key),
            90 => $this->checkLeft($x, $y, $a, $key),
            180 => $this->checkBack($x, $y, $a, $key),
            270 => $this->checkRight($x, $y, $a, $key),
            default => NULL,
        };
    }

    private function checkForward($x, $y, $a, $key): array
    {
        return $this->checkKeydown($x, $y, $a, $key, 1, -1, 1, -1, true);

    }
    private function checkBack($x, $y, $a, $key): array
    {
        return $this->checkKeydown($x, $y, $a, $key, -1, 1, -1, 1, true);
    }
    private function checkRight($x, $y, $a, $key): array
    {
        return $this->checkKeydown($x, $y, $a, $key, -1, 1, 1, -1, false);
    }
    private function checkLeft($x, $y, $a, $key): array
    {
        return $this->checkKeydown($x, $y, $a, $key, 1, -1, -1, 1, false);
    }
    private function checkKeydown($x, $y, $a, $key, $intFi, $intS, $intT, $intF, $isHorizontal): array
    {
        switch ($isHorizontal) {
            case true:
                match ($key) {
                    'KeyW' => $x += $intFi,
                    'KeyS' => $x += $intS,
                    'KeyA' => $y += $intT,
                    'KeyD' => $y += $intF,
                    'KeyQ' => $a += 90,
                    'KeyE' => $a -= 90,
                    default => NULL,
                };
                break;
            default:
                match ($key) {
                    'KeyW' => $y += $intFi,
                    'KeyS' => $y += $intS,
                    'KeyA' => $x += $intT,
                    'KeyD' => $x += $intF,
                    'KeyQ' => $a += 90,
                    'KeyE' => $a -= 90,
                    default => NULL,
                };
        }
        return [$x, $y, $a];
    }
}