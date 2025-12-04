<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netcrafter - Gestionnaire de Cartes Professionnelles</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        
        header {
            background-color: #1a237e;
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .content {
            display: flex;
            gap: 30px;
            flex-direction: row;
        }
        
        .form-section {
            flex: 1;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .preview-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }
        
        .card-preview {
            background-color: white;
            width: 300px;
            max-width: 100%;
            height: 550px; /* Augmenté pour accueillir les nouveaux champs */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        
        .card-image {
            width: 100%;
            height: 150px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .card-image img {
            max-width: 100%;
            max-height: 100%;
        }
        
        .card-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .card-name {
            font-size: 20px;
            font-weight: bold;
            color: #1a237e;
        }
        
        .card-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .card-info p {
            margin: 0;
            font-size: 14px;
        }
        
        .card-agent-id {
            margin-top: auto;
            text-align: right;
            font-size: 12px;
            color: #757575;
            font-style: italic;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #1a237e;
        }
        
        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .btn-primary {
            background-color: #1a237e;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #0e1859;
        }
        
        .btn-secondary {
            background-color: #9e9e9e;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #757575;
        }
        
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .card-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .card-item-image {
            height: 120px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .card-item-image img {
            max-width: 100%;
            max-height: 100%;
        }
        
        .card-item-content {
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .card-item-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .card-item-actions button {
            flex: 1;
            padding: 5px;
            font-size: 12px;
        }
        
        .success-message, .error-message {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            display: none;
        }
        
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        /* Media queries pour rendre l'application responsive */
        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }
            
            .preview-section {
                order: -1;
            }
            
            .card-preview {
                width: 100%;
                max-width: 300px;
            }
            
            .cards-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
            
            .button-group {
                flex-direction: column;
            }
            
            h1 {
                font-size: 20px;
            }
            
            header p {
                font-size: 14px;
            }
        }
        
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            
            .container {
                gap: 20px;
            }
            
            .cards-grid {
                grid-template-columns: 1fr;
            }
            
            .card-item-actions {
                flex-direction: column;
            }
        }
        /* Ajout au CSS existant pour les logos dans le header */
.header-logos {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.logo {
    height: 60px;
    width: auto;
}

.header-content {
    flex: 1;
    text-align: center;
    padding: 0 20px;
}

/* Pour les écrans plus petits */
@media (max-width: 768px) {
    .header-logos {
        flex-direction: column;
        gap: 10px;
    }
    
    .logo {
        height: 50px;
    }
    
    .header-content {
        padding: 10px 0;
    }
}
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Netcrafter - Gestionnaire de Cartes Professionnelles</h1>
            <p>Veuillez utiliser ce formulaire pour fournir les informations pour l'editions des badges et les polos. Merci</p>
        </header>
        
        <div class="content">
            <div class="form-section">
                <h2>Éditeur de Carte</h2>
                <div class="success-message" id="successMessage">Carte enregistrée avec succès!</div>
                <div class="error-message" id="errorMessage">Une erreur s'est produite.</div>
                
                <form id="cardForm" enctype="multipart/form-data">
                    <input type="hidden" id="cardId" name="cardId" value="">
                    
                    <div class="form-group">
                        <label for="image">Image (Logo/Photo):</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                    
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="agence">Agence:</label>
                        <select id="agence" name="agence" required>
                            <option value="">Sélectionnez une agence</option>
                            <option value="Wadata">Wadata</option>
                            <option value="Tillabery">Tillabery</option>
                            <option value="Say">Say</option>
                            <option value="Gaya">Gaya</option>
                            <option value="Malbaza">Malbaza</option>
                            <option value="Torrodi">Torrodi</option>
                            <option value="Ouallam">Ouallam</option>
                            <option value="Soni Logo">Soni Logo</option>
                            <option value="Grand Marcher (Siège)">Grand Marcher (Siège)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="poste">Poste:</label>
                        <input type="text" id="poste" name="poste" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telephone">Numéro de téléphone:</label>
                        <input type="tel" id="telephone" name="telephone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Adresse email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="agentId">Matricule de l'agent:</label>
                        <input type="text" id="agentId" name="agentId" required>
                    </div>

                    <div class="form-group">
                        <label for="taillePolo">Taille de polo:</label>
                        <select id="taillePolo" name="taillePolo" required>
                            <option value="">Sélectionnez une taille</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                            <option value="XXXL">XXXL</option>
                        </select>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" class="btn-primary">Enregistrer</button>
                        <button type="button" class="btn-secondary" id="resetButton">Nouveau</button>
                    </div>
                </form>
            </div>
            
            <div class="preview-section">
                <h2>Aperçu de la Carte</h2>
                <div class="card-preview">
                    <div class="card-image" id="previewImage">
                        <img id="imagePreview" src="" alt="Logo/Photo" style="display: none; border-radius: 50px;">
                    </div>
                    <div class="card-content">
                        <div class="card-name">
                            <span id="previewPrenom"></span> <span id="previewNom"></span>
                        </div>
                        <div class="card-info">
                            <p><strong>Agence:</strong> <span id="previewAgence"></span></p>
                            <p><strong>Poste:</strong> <span id="previewPoste"></span></p>
                            <p><strong>Téléphone:</strong> <span id="previewTelephone"></span></p>
                            <p><strong>Email:</strong> <span id="previewEmail"></span></p>
                            <p><strong>Taille Polo:</strong> <span id="previewTaillePolo"></span></p>
                        </div>
                        <div class="card-agent-id">
                            MATRICULE: <span id="previewAgentId"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div>
            <h2>Cartes Enregistrées</h2>
            <div class="cards-grid" id="cardsGrid">
                <!-- Les cartes enregistrées seront affichées ici -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Éléments du formulaire
            const cardForm = document.getElementById('cardForm');
            const cardIdInput = document.getElementById('cardId');
            const imageInput = document.getElementById('image');
            const nomInput = document.getElementById('nom');
            const prenomInput = document.getElementById('prenom');
            const agenceInput = document.getElementById('agence');
            const posteInput = document.getElementById('poste');
            const telephoneInput = document.getElementById('telephone');
            const emailInput = document.getElementById('email');
            const taillePoloInput = document.getElementById('taillePolo');
            const agentIdInput = document.getElementById('agentId');
            const resetButton = document.getElementById('resetButton');
            
            // Éléments de prévisualisation
            const imagePreview = document.getElementById('imagePreview');
            const previewNom = document.getElementById('previewNom');
            const previewPrenom = document.getElementById('previewPrenom');
            const previewAgence = document.getElementById('previewAgence');
            const previewPoste = document.getElementById('previewPoste');
            const previewTelephone = document.getElementById('previewTelephone');
            const previewEmail = document.getElementById('previewEmail');
            const previewTaillePolo = document.getElementById('previewTaillePolo');
            const previewAgentId = document.getElementById('previewAgentId');
            
            // Messages
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');
            
            // Grille des cartes
            const cardsGrid = document.getElementById('cardsGrid');
            
            // Charger les cartes existantes
            loadCards();
            
            // Événements
            imageInput.addEventListener('change', previewImageChange);
            nomInput.addEventListener('input', updatePreview);
            prenomInput.addEventListener('input', updatePreview);
            agenceInput.addEventListener('change', updatePreview);
            posteInput.addEventListener('input', updatePreview);
            telephoneInput.addEventListener('input', updatePreview);
            emailInput.addEventListener('input', updatePreview);
            taillePoloInput.addEventListener('change', updatePreview);
            agentIdInput.addEventListener('input', updatePreview);
            resetButton.addEventListener('click', resetForm);
            cardForm.addEventListener('submit', saveCard);
            
            // Fonctions
            function previewImageChange(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            }
            
            function updatePreview() {
                previewNom.textContent = nomInput.value;
                previewPrenom.textContent = prenomInput.value;
                previewAgence.textContent = agenceInput.value;
                previewPoste.textContent = posteInput.value;
                previewTelephone.textContent = telephoneInput.value;
                previewEmail.textContent = emailInput.value;
                previewTaillePolo.textContent = taillePoloInput.value;
                previewAgentId.textContent = agentIdInput.value;
            }
            
            function resetForm() {
                cardIdInput.value = '';
                cardForm.reset();
                imagePreview.src = '';
                imagePreview.style.display = 'none';
                previewNom.textContent = '';
                previewPrenom.textContent = '';
                previewAgence.textContent = '';
                previewPoste.textContent = '';
                previewTelephone.textContent = '';
                previewEmail.textContent = '';
                previewTaillePolo.textContent = '';
                previewAgentId.textContent = '';
                hideMessages();
            }
            
            function saveCard(e) {
                e.preventDefault();
                hideMessages();
                
                const formData = new FormData(cardForm);
                
                fetch('save_card.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessMessage(data.message);
                        loadCards();
                        if (!cardIdInput.value) {
                            resetForm();
                        }
                    } else {
                        showErrorMessage(data.message);
                    }
                })
                .catch(error => {
                    showErrorMessage('Une erreur s\'est produite lors de la communication avec le serveur.');
                    console.error('Error:', error);
                });
            }
            
            function loadCards() {
                fetch('get_cards.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderCards(data.cards);
                    } else {
                        showErrorMessage(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
            
            function renderCards(cards) {
                cardsGrid.innerHTML = '';
                
                if (cards.length === 0) {
                    cardsGrid.innerHTML = '<p>Aucune carte enregistrée.</p>';
                    return;
                }
                
                cards.forEach(card => {
                    const cardElement = document.createElement('div');
                    cardElement.className = 'card-item';
                    
                    cardElement.innerHTML = `
                        <div class="card-item-image">
                            <img src="${card.image_path || 'placeholder.png'}" alt="Logo/Photo">
                        </div>
                        <div class="card-item-content">
                            <div><strong>${card.prenom} ${card.nom}</strong></div>
                            <div>Agence: ${card.agence || 'Non spécifiée'}</div>
                            <div>Poste: ${card.poste || 'Non spécifié'}</div>
                            <div>Tel: ${card.telephone}</div>
                            <div>Email: ${card.email}</div>
                            <div>Taille Polo: ${card.taille_polo || 'Non spécifiée'}</div>
                            <div><small>ID: ${card.agent_id}</small></div>
                            <div class="card-item-actions">
                                <button class="btn-primary edit-btn" data-id="${card.id}">Modifier</button>
                                <button class="btn-secondary delete-btn" data-id="${card.id}">Supprimer</button>
                            </div>
                        </div>
                    `;
                    
                    cardsGrid.appendChild(cardElement);
                    
                    // Ajouter les événements aux boutons
                    cardElement.querySelector('.edit-btn').addEventListener('click', () => editCard(card));
                    cardElement.querySelector('.delete-btn').addEventListener('click', () => deleteCard(card.id));
                });
            }
            
            function editCard(card) {
                hideMessages();
                
                cardIdInput.value = card.id;
                nomInput.value = card.nom;
                prenomInput.value = card.prenom;
                agenceInput.value = card.agence || '';
                posteInput.value = card.poste || '';
                telephoneInput.value = card.telephone;
                emailInput.value = card.email;
                taillePoloInput.value = card.taille_polo || '';
                agentIdInput.value = card.agent_id;
                
                if (card.image_path) {
                    imagePreview.src = card.image_path;
                    imagePreview.style.display = 'block';
                } else {
                    imagePreview.src = '';
                    imagePreview.style.display = 'none';
                }
                
                updatePreview();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
            
            function deleteCard(id) {
                if (confirm('Êtes-vous sûr de vouloir supprimer cette carte?')) {
                    fetch('delete_card.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id=${id}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showSuccessMessage(data.message);
                            loadCards();
                            if (cardIdInput.value == id) {
                                resetForm();
                            }
                        } else {
                            showErrorMessage(data.message);
                        }
                    })
                    .catch(error => {
                        showErrorMessage('Une erreur s\'est produite lors de la communication avec le serveur.');
                        console.error('Error:', error);
                    });
                }
            }
            
            function showSuccessMessage(message) {
                successMessage.textContent = message;
                successMessage.style.display = 'block';
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000);
            }
            
            function showErrorMessage(message) {
                errorMessage.textContent = message;
                errorMessage.style.display = 'block';
                setTimeout(() => {
                    errorMessage.style.display = 'none';
                }, 5000);
            }
            
            function hideMessages() {
                successMessage.style.display = 'none';
                errorMessage.style.display = 'none';
            }
        });
    </script>
</body>
</html>