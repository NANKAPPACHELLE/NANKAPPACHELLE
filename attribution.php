<?php
// Connexion à la base de données

// Fonction pour attribuer un chauffeur à une voiture et à un itinéraire
function attribuer_Chauffeur() {
    global $idChauffeur, $idVoiture, $idItineraire;

    try {
        // Vérifier si le chauffeur, la voiture et l'itinéraire existent dans la base de données
        include("connexion_bd.php");
        $stmt = $db->prepare("SELECT * FROM chauffeur WHERE id = :idChauffeur");
        $stmt->bindParam(':idChauffeur', $idChauffeur);
        $stmt->execute();
        $chauffeur = $stmt->fetch();

        $stmt = $db->prepare("SELECT * FROM voiture WHERE id = :idVoiture");
        $stmt->bindParam(':idVoiture', $idVoiture);
        $stmt->execute();
        $voiture = $stmt->fetch();

        $stmt = $db->prepare("SELECT * FROM itineraire WHERE id = :idItineraire");
        $stmt->bindParam(':idItineraire', $idItineraire);
        $stmt->execute();
        $itineraire = $stmt->fetch();

        if (!$chauffeur || !$voiture || !$itineraire) {
            echo "Le chauffeur, la voiture ou l'itinéraire n'existe pas.";
            return;
        }

        // Insérer l'association entre le chauffeur, la voiture et l'itinéraire dans la table d'attribution
        $stmt = $db->prepare("INSERT INTO attribution (id_chauffeur, id_voiture, id_itineraire) VALUES (:idChauffeur, :idVoiture, :idItineraire)");
        $stmt->bindParam(':idChauffeur', $idChauffeur);
        $stmt->bindParam(':idVoiture', $idVoiture);
        $stmt->bindParam(':idItineraire', $idItineraire);
        $stmt->execute();

        echo "Chauffeur attribué à la voiture et à l'itinéraire avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Exemple d'utilisation de la fonction
$idChauffeur = 1; // ID du chauffeur à attribuer
$idVoiture = 2; // ID de la voiture à attribuer
$idItineraire = 3; // ID de l'itinéraire à attribuer

attribuer_Chauffeur($idChauffeur, $idVoiture, $idItineraire);
?>
