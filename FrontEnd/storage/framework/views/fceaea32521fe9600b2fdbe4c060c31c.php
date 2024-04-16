<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style.css" />
    <script src="script.js" defer></script>

    <title>Page d'accueil</title>
    
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }
        
        .navbar {
            background-color: #1e52a8;
        }
        
        .navbar-brand,
        .navbar-nav .nav-link {
            color: #ffffff;
        }

        .jumbotron {
            background-color: #1e52a8;
            color: #ffffff;
        }

        .jumbotron .btn {
            background-color: #008000;
            border-color: #008000;
        }

        .jumbotron .btn:hover {
            background-color: #ffffff;
            border-color: #ffffff;
            color: #008000;
        }
    </style>
</head>
<body>

    
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">EncapSure</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="inscription.html">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">Connexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="jumbotron text-center">
        <h1 class="display-4">Bienvenue sur EncapSure</h1>
        <p class="lead">Assurance automobile en ligne.</p>
        <div style="background-color: #ffffff;">
            <img src="EncapSure photo.jpg" alt="EncapSure Photo" width="auto" height="300">
        </div>
        <br>
        <p>Rejoignez-nous dès maintenant et découvrez les avantages d'EncapSure.</p>
        <a class="btn btn-lg" href="inscription.html" role="button">Inscrivez-vous</a>
        <!-- Ajoutez le bouton de connexion ici -->
        <a class="btn btn-lg" href="login.html" role="button" style="background-color:#1e52a8; border-color: #ffffff; color: #ffffff; margin-left: 10px;">Connexion</a>
    </div>

    

    <!-- Add jQuery and Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/Home.blade.php ENDPATH**/ ?>