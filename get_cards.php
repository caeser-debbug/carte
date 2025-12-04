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

// Récupérer toutes les cartes de la base de données
$query = "SELECT * FROM business_cards ORDER BY updated_at DESC";
$result = $conn->query($query);

// Préparer la réponse
$response = [];
if ($result) {
    $cards = [];
    while ($row = $result->fetch_assoc()) {
        $cards[] = $row;
    }
    
    $response = [
        'success' => true,
        'cards' => $cards
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Erreur lors de la récupération des cartes: ' . $conn->error
    ];
}

// Fermer la connexion
$conn->close();

// Renvoyer la réponse au format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>