<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "netcrafter_cards";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die(json_encode([
        'success' => false,
        'message' => "Échec de la connexion à la base de données: " . $conn->connect_error
    ]));
}

// Définir l'encodage des caractères
$conn->set_charset("utf8mb4");

// Réponse par défaut
$response = [
    'success' => false,
    'message' => 'Une erreur inconnue s\'est produite'
];

// Traiter la requête de suppression
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    // Vérifier si la carte existe et récupérer le chemin de l'image
    $checkQuery = "SELECT image_path FROM business_cards WHERE id = $id";
    $result = $conn->query($checkQuery);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagePath = $row['image_path'];
        
        // Supprimer la carte de la base de données
        $deleteQuery = "DELETE FROM business_cards WHERE id = $id";
        
        if ($conn->query($deleteQuery) === TRUE) {
            // Supprimer l'image associée si elle existe
            if (!empty($imagePath) && file_exists($imagePath)) {
                unlink($imagePath);
            }
            
            $response = [
                'success' => true,
                'message' => 'Carte supprimée avec succès.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Erreur lors de la suppression de la carte: ' . $conn->error
            ];
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'Carte non trouvée.'
        ];
    }
} else {
    $response = [
        'success' => false,
        'message' => 'ID de carte non spécifié.'
    ];
}

// Fermer la connexion
$conn->close();

// Renvoyer la réponse au format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>