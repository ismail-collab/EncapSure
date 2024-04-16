<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifier Document Client</title>

<!-- Add Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- Custom CSS -->
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        border: 1px solid #000;
        text-align: left;
    }

    th {
        background-color: #1e52a8;
        color: white;
    }

    td button {
        padding: 5px 10px;
        font-size: 14px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        background-color: #1e52a8;
        color: white;
    }

    td button:hover {
        background-color: #0d3d7a;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        display: none;
    }

    .popup {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        width: 80%;
        max-width: 400px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .popup h2 {
        margin-top: 0;
    }

    .popup p {
        margin-bottom: 20px;
    }

    .popup select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
    }

    .popup button {
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin: 5px;
    }

    .popup button.confirm {
        background-color: #1e52a8;
        color: white;
    }

    .popup button.confirm:hover {
        background-color: #0d3d7a;
    }

    .popup button.cancel {
        background-color: #ff6666;
        color: white;
    }

    .popup button.cancel:hover {
        background-color: #e60000;
    }

    .navbar {
        background-color: #1e52a8;
    }
    
    .navbar-brand,
    .navbar-nav .nav-link {
        color: #ffffff;
    }

    .container {
        margin-top: 30px;
    }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Agent X</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a class="nav-link" href="Login">Déconnexion</a>
                </li>
                </ul>
                </div>
                </div>
                </nav>
                <div class="container">
                    <h1>Vérifier Document Client</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Quittance de vignette</th>
                                <th>Quittance de visite technique</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Les lignes du tableau représentent les documents déposés par les clients -->
                            <tr>
                                <td>Client 1</td>
                                <td>
                                    <a href="chemin/vers/le/fichier1.pdf" target="_blank">Voir le document</a>
                                    <button class="validate">Valider</button>
                                    <button class="reject">Rejeter</button>
                                </td>
                                <td>
                                    <a href="chemin/vers/le/fichier2.pdf" target="_blank">Voir le document</a>
                                    <button class="validate">Valider</button>
                                    <button class="reject">Rejeter</button>
                                </td>
                                <td>
                                    <!-- Le statut des documents peut être mis à jour en fonction de l'action de l'agent -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                
                    <div class="overlay">
                        <div class="popup">
                            <h2>Motif de rejet</h2>
                            <select>
                                <option value="">Sélectionner un motif</option>
                                <option value="documents_flous">Documents flous</option>
                                <option value="documents_non_valides">Documents non valides</option>
                                <option value="document_expire">Document expiré</option>
                            </select>
                            <button class="confirm">Confirmer</button>
                            <button class="cancel">Annuler</button>
                        </div>
                    </div>
                </div>
                
                <!-- Add jQuery -->
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                
                <!-- Add Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
                
                <script>
                    const validateButtons = document.querySelectorAll('.validate');
                    const rejectButtons = document.querySelectorAll('.reject');
                    const overlay = document.querySelector('.overlay');
                    const confirmBtn = document.querySelector('.confirm');
                    const cancelBtn = document.querySelector('.cancel');
                
                    // Afficher le pop-up pour sélectionner le motif de rejet
                    function showPopup() {
                        overlay.style.display = 'flex';
                    }
                
                    // Cacher le pop-up
                    function hidePopup() {
                        overlay.style.display = 'none';
                    }
                
                    // Ajouter des écouteurs d'événements aux boutons "Rejeter"
                    for (const button of rejectButtons) {
                        button.addEventListener('click', showPopup);
                    }
                
                    // Confirmer le rejet et cacher le pop-up
                    confirmBtn.addEventListener('click', function() {
                        // Mettre à jour le statut des documents et le motif de rejet dans le tableau
                    const selectedOption = document.querySelector('select').value;
                    const row = confirmBtn.closest('tr');
                    row.querySelector('td:last-child').textContent = 'Rejeté: ' + selectedOption;
                    hidePopup();
                    });        
                                // Annuler le rejet et cacher le pop-up
                                cancelBtn.addEventListener('click', hidePopup);
            
            // Valider le document et mettre à jour le statut dans le tableau
            for (const button of validateButtons) {
                button.addEventListener('click', function() {
                    const row = button.closest('tr');
                    row.querySelector('td:last-child').textContent = 'Validé';
                });
            }
        </script>
    </body>
    </html>
<?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/AgentExamDoc.blade.php ENDPATH**/ ?>