<?php
class FirstPersonView extends BaseClass {
    // Constante de classe pour le répertoire des images
    const IMAGE_DIRECTORY = 'images/';

    // Propriété pour l'identifiant de la position courante sur la carte

    protected $_mapId;

    // public function setMapId($_mapId) {
    //     $this->_mapId = $mapId;
    // }

    // public function getMapId() {
    //     return $this->_mapId;
    // }

    public function getView($x, $y, $direction)
    {
        // Récupérer le map ID en fonction des coordonnées X et Y
        $stmt = $this->_dbh->prepare("SELECT id FROM map WHERE coordX = ? AND coordY = ? AND direction = ?");
        $stmt->execute([$x, $y, $direction]);
        $mapId = $stmt->fetchColumn();
        $this->_mapId = $mapId;
        $_SESSION['message_id'] = "id = ". $this->_mapId . " ";

        // Récupérer le chemin de l'image en fonction du map ID
        $stmt = $this->_dbh->prepare("SELECT path FROM images WHERE map_id = ?");
        $stmt->execute([$mapId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Renvoyer le chemin de l'image
        return $result['path'];
    }



    // Méthode pour récupérer le chemin de l'image à afficher
    // public function getView($x) {
    //     $sql = "SELECT path FROM images WHERE map_id = :mapId";
    //     $stmt = $this->_dbh->prepare($sql);
    //     $stmt->bindParam(':mapId', $this->, PDO::PARAM_INT);
    //     $stmt->execute();
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if ($result && isset($result['path'])) {
    //         $this->setMapId($id);
    //         return self::IMAGE_DIRECTORY . $result['path'];
    //     } else {
    //         // Gérer l'absence d'image, par exemple, retourner une image par défaut
    //         return self::IMAGE_DIRECTORY . '01.-0.pg';
    //     }
    // }

    // Méthode pour récupérer la direction de la boussole
    public function getAnimCompass() {
        switch ($this->getDirection()){
            case 0:
                return 'east';
            case 90:
                return 'north';
            case 180:
                return 'west';
            case 270:
                return 'south';
            default:
                // Gérer une direction inconnue
                return 'direction inconnue';
        }
    }
}
