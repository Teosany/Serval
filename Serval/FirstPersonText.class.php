<?php

class FirstPersonText extends FirstPersonView{

    // Méthode pour récupérer le texte à afficher
    public function getText() {
        // Construire la requête pour obtenir le texte basé sur la position et l'angle actuels
        $sql = "SELECT text.text 
                FROM text
                JOIN map ON text.map_id = map.id
                WHERE map.coordX = :currentX AND map.coordY = :currentY AND map.direction = :currentAngle";

        $stmt = $this->_dbh->prepare($sql);
        $stmt->bindParam(':currentX', $this->_currentX, PDO::PARAM_INT);
        $stmt->bindParam(':currentY', $this->_currentY, PDO::PARAM_INT);
        $stmt->bindParam(':currentAngle', $this->_direction, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['text'])) {
            return $result['text'];
        } else {
            // Gérer l'absence de texte, par exemple, retourner un texte par défaut
            return "Vous regardez autour de vous mais rien d'intéressant à signaler.";
        }
    }
}
