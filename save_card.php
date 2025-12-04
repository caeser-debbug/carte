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

// Traiter la requête
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $cardId = isset($_POST['cardId']) ? intval($_POST['cardId']) : 0;
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $agence = $conn->real_escape_string($_POST['agence']);
    $poste = $conn->real_escape_string($_POST['poste']);
    $telephone = $conn->real_escape_string($_POST['telephone']);
    $email = $conn->real_escape_string($_POST['email']);
    $agentId = $conn->real_escape_string($_POST['agentId']);
    $taillePolo = $conn->real_escape_string($_POST['taillePolo']);
    
    // Traitement de l'image
    $imagePath = '';
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 5 * 1024 * 1024; // 5 MB
        
        // Vérifier le type et la taille du fichier
        if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {
            // Créer le dossier d'upload s'il n'existe pas
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // Générer un nom de fichier unique
            $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $fileName;
            
            // Déplacer le fichier uploadé
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $imagePath = $targetPath;
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Erreur lors de l\'upload de l\'image.'
                ];
                echo json_encode($response);
                exit;
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Format ou taille d\'image non valide. Formats acceptés: JPG, PNG, GIF. Taille max: 5MB.'
            ];
            echo json_encode($response);
            exit;
        }
    }
    
    // Insérer ou mettre à jour la carte dans la base de données
    if ($cardId > 0) {
        // Mise à jour d'une carte existante
        $query = "UPDATE business_cards SET 
                  nom = '$nom', 
                  prenom = '$prenom',
                  agence = '$agence',
                  poste = '$poste', 
                  telephone = '$telephone', 
                  email = '$email', 
                  agent_id = '$agentId',
                  taille_polo = '$taillePolo',
                  updated_at = NOW()";
        
        // Ajouter l'image uniquement si une nouvelle a été téléchargée
        if (!empty($imagePath)) {
            $query .= ", image_path = '$imagePath'";
        }
        
        $query .= " WHERE id = $cardId";
        
        if ($conn->query($query) === TRUE) {
            $response = [
                'success' => true,
                'message' => 'Carte mise à jour avec succès.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de la carte: ' . $conn->error
            ];
        }
    } else {
        // Insertion d'une nouvelle carte
        $query = "INSERT INTO business_cards (nom, prenom, agence, poste, telephone, email, agent_id, image_path, taille_polo, created_at, updated_at) 
                  VALUES ('$nom', '$prenom', '$agence', '$poste', '$telephone', '$email', '$agentId', '$imagePath', '$taillePolo', NOW(), NOW())";
        
        if ($conn->query($query) === TRUE) {
            $response = [
                'success' => true,
                'message' => 'Carte enregistrée avec succès.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement de la carte: ' . $conn->error
            ];
        }
    }
}

// Fermer la connexion
$conn->close();

// Renvoyer la réponse au format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>