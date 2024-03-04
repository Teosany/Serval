<?php
require_once 'DataBase.class.php';

abstract class AbstractBaseClass
{
    protected $_currentX;
    protected $_currentY;
    protected $_direction;
    protected $_dbh;

    // Getters et setters pour les propriétés $_currentX, $_currentY et $_direction

    public function getCurrentX(): int
    {
        return $this->_currentX;
    }

    public function setCurrentX($_currentX): void
    {
        if (intval($_currentX)) {
            $this->_currentX = $_currentX;
        }

    }

    public function getCurrentY(): int
    {
        return $this->_currentY;
    }

    public function setCurrentY($_currentY): void
    {
        if (intval($_currentY)) {
            $this->_currentY = $_currentY;
        }
    }

    public function getDirection(): int
    {
        return $this->_direction;
    }

    public function setDirection($_direction): void
    {
        if (intval($_direction)) {
            $this->_direction = $_direction;
        }
    }

    // Méthodes abstraites à implémenter dans les classes concrètes
    abstract public function checkForward(): bool;

    abstract public function checkBack(): bool;

    abstract public function checkRight(): bool;

    abstract public function checkLeft(): bool;

    abstract public function checkTurnRight(): bool;

    abstract public function checkTurnLeft(): bool;

    abstract public function goForward(): void;

    abstract public function goBack(): void;

    abstract public function goRight(): void;

    abstract public function goLeft(): void;

    abstract public function rotateRight(): void;

    abstract public function rotateLeft(): void;
}


class BaseClass extends AbstractBaseClass
{
    // protected $_currentX;
    // protected $_currentY;
    // protected $_direction;
    // protected $_dbh;

    public function __construct()
    {
        $this->_currentX = 0;
        $this->_currentY = 1;
        $this->_direction = 0;
        // Connexion à la base de données
        $this->_dbh = new DataBase();
    }

    // Getters et setters pour les propriétés $_currentX, $_currentY et $_direction

    public function checkForward(): bool
    {
        $currentX = $this->getCurrentX();
        $currentY = $this->getCurrentY();
        $currentDirection = $this->getDirection();

        if ($currentDirection == 0) {
            $targetX = $currentX + 1;
            $targetY = $currentY;
        } elseif ($currentDirection == 90) {
            $targetX = $currentX;
            $targetY = $currentY + 1;
        } elseif ($currentDirection == 180) {
            $targetX = $currentX - 1;
            $targetY = $currentY;
        } elseif ($currentDirection == 270) {
            $targetX = $currentX;
            $targetY = $currentY - 1;
        } else {
            return false;
        }

        return $this->_checkMove($targetX, $targetY, $currentDirection);
    }

    public function checkBack(): bool
    {
        $currentX = $this->getCurrentX();
        $currentY = $this->getCurrentY();
        $currentDirection = $this->getDirection();

        if ($currentDirection == 0) {
            $targetX = $currentX - 1;
            $targetY = $currentY;
        } elseif ($currentDirection == 90) {
            $targetX = $currentX;
            $targetY = $currentY - 1;
        } elseif ($currentDirection == 180) {
            $targetX = $currentX + 1;
            $targetY = $currentY;
        } elseif ($currentDirection == 270) {
            $targetX = $currentX;
            $targetY = $currentY + 1;
        } else {
            return false;
        }

        return $this->_checkMove($targetX, $targetY, $currentDirection);
    }

    public function checkRight(): bool
    {
        $currentX = $this->getCurrentX();
        $currentY = $this->getCurrentY();
        $currentDirection = $this->getDirection();

        if ($currentDirection == 0) {
            $targetX = $currentX;
            $targetY = $currentY - 1;
        } elseif ($currentDirection == 90) {
            $targetX = $currentX + 1;
            $targetY = $currentY;
        } elseif ($currentDirection == 180) {
            $targetX = $currentX;
            $targetY = $currentY + 1;
        } elseif ($currentDirection == 270) {
            $targetX = $currentX - 1;
            $targetY = $currentY;
        } else {
            return false; // Direction invalide
        }

        return $this->_checkMove($targetX, $targetY, $currentDirection);
    }

    public function checkLeft(): bool
    {
        $currentX = $this->getCurrentX();
        $currentY = $this->getCurrentY();
        $currentDirection = $this->getDirection();

        if ($currentDirection == 0) {
            $targetX = $currentX;
            $targetY = $currentY + 1;
        } elseif ($currentDirection == 90) {
            $targetX = $currentX - 1;
            $targetY = $currentY;
        } elseif ($currentDirection == 180) {
            $targetX = $currentX;
            $targetY = $currentY - 1;
        } elseif ($currentDirection == 270) {
            $targetX = $currentX + 1;
            $targetY = $currentY;
        } else {
            return false; // Direction invalide
        }

        return $this->_checkMove($targetX, $targetY, $currentDirection);
    }


    public function checkTurnRight(): bool
    {
        $currentX = $this->getCurrentX();
        $currentY = $this->getCurrentY();
        $targetDirection = 0;

        // $targetDirection = $this->_direction - 90;
        // if ($targetDirection = 0) {
        //     $targetDirection = 270;
        // }

        if ($this->getDirection() == 0) {
            $targetDirection = 270;
        } else {
            $targetDirection - 90;
        }

        return $this->_checkMove($currentX, $currentY, $targetDirection);
    }

    public function checkTurnLeft(): bool
    {
        $currentX = $this->getCurrentX();
        $currentY = $this->getCurrentY();
        $targetDirection = ($this->getDirection() + 90) % 360;

        return $this->_checkMove($currentX, $currentY, $targetDirection);
    }


    //p vérifier si un mouvement est possible

    private function _checkMove($targetX, $targetY, $targetAngle)
    {
        // Requête SQL pour vérifier si les coordonnées et l'angle de vue sont valides
        $query = "SELECT COUNT(*) FROM map WHERE coordX = :targetX AND coordY = :targetY AND direction = :targetAngle";
        $stmt = $this->_dbh->prepare($query);
        $stmt->bindParam(':targetX', $targetX);
        $stmt->bindParam(':targetY', $targetY);
        $stmt->bindParam(':targetAngle', $targetAngle);
        $stmt->execute();

        // Récupération du résultat de la requête
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Si une entrée correspondante est trouvée, le déplacement est possible
        // Vérifiez si le nombre de résultats est supérieur à zéro et définissez l'ID
        if ($result && $result['COUNT(*)'] > 0) {
            return true;
        } else {
            return false;
        }
    }


    //  effectuer des déplacements et rotations

    public function goForward(): void
    {
        $currentX = $this->getCurrentX();
        $currentY = $this->getCurrentY();
        $currentDirection = $this->getDirection();

        if ($currentDirection == 0) {
            $this->setCurrentX($currentX + 1);
        } elseif ($currentDirection == 90) {
            $this->setCurrentY($currentY + 1);
        } elseif ($currentDirection == 180) {
            $this->setCurrentX($currentX - 1);
        } elseif ($currentDirection == 270) {
            $this->setCurrentY($currentY - 1);
        } else {
            echo "Impossible de déplacer";
            return;
        }

        // Affichez un message de succès ou effectuez d'autres actions nécessaires
        echo "Déplacement vers l'avant réussi.";
    }

    public function goBack(): void
    {
        $currentX = $this->getCurrentX();
        $currentY = $this->getCurrentY();
        $currentDirection = $this->getDirection();

        if ($currentDirection == 0) {
            $this->setCurrentX($currentX - 1);
        } elseif ($currentDirection == 90) {
            $this->setCurrentY($currentY - 1);
        } elseif ($currentDirection == 180) {
            $this->setCurrentX($currentX + 1);
        } elseif ($currentDirection == 270) {
            $this->setCurrentY($currentY + 1);
        } else {
            echo "Impossible de déplacer";
            return;
        }

        // Affichez un message de succès ou effectuez d'autres actions nécessaires
        echo "Déplacement vers l'arrière réussi.";
    }

    public function goRight(): void
    {
        $currentX = $this->getCurrentX();
        $currentY = $this->getCurrentY();
        $currentDirection = $this->getDirection();

        if ($currentDirection == 0) {
            $this->setCurrentY($currentY - 1);
        } elseif ($currentDirection == 90) {
            $this->setCurrentX($currentX + 1);
        } elseif ($currentDirection == 180) {
            $this->setCurrentY($currentY + 1);
        } elseif ($currentDirection == 270) {
            $this->setCurrentX($currentX - 1);
        } else {
            echo "Impossible de déplacer";
            return;
        }

        // Afficher un message de succès ou effectuer d'autres actions nécessaires
        echo "Déplacement vers la droite réussi.";
    }

    public function goLeft(): void
    {
        $currentX = $this->getCurrentX();
        $currentY = $this->getCurrentY();
        $currentDirection = $this->getDirection();

        if ($currentDirection == 0) {
            $this->setCurrentY($currentY + 1);
        } elseif ($currentDirection == 90) {
            $this->setCurrentX($currentX - 1);
        } elseif ($currentDirection == 180) {
            $this->setCurrentY($currentY - 1);
        } elseif ($currentDirection == 270) {
            $this->setCurrentX($currentX + 1);
        } else {
            echo "Impossible de déplacer";
            return;
        }

        // Afficher un message de succès ou effectuer d'autres actions nécessaires
        echo "Déplacement vers la gauche réussi.";
    }


    public function rotateRight(): void
    {
        $newDirection = 0;
        $currentDirection = $this->getDirection();
        $newDirection = $currentDirection - 90;
        if ($newDirection == -90) {
            $newDirection = 270;
        }
        $this->setDirection($newDirection);
        echo "Rotation vers la droite réussie.";

    }

    public function rotateLeft(): void
    {
        $newDirection = 0;
        $currentDirection = $this->getDirection();
        $newDirection = ($currentDirection + 90) % 360;
        $this->setDirection($newDirection);
        echo "Rotation vers la gauche réussie.";
    }
    // public function butonEnable()
    // {
    //     $resultmove = array();
    //     $resultmove['move_forward'] = $this->checkForward();
    //     $resultmove['move_back'] = $this->checkBack();
    //     $resultmove['move_left'] = $this->checkLeft();
    //     $resultmove['move_right'] = $this->checkRight();
    //     $resultmove['rotate_Right'] = $this->checkTurnRight();
    //     $resultmove['rotate_Left'] = $this->checkTurnLeft();

    //     return $resultmove;
    // }
}