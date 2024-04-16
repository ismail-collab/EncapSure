<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur</title>

<link rel="stylesheet" href="style.css">

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

        .container {
            margin-top: 30px;
        }

        .card {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .icon {
            font-size: 5em;
            margin-bottom: 20px;
            color:#1e52a8;
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



/* Home Client style  */

  /* Style pour le texte et l'icône */
  .client-text {
    color: white; /* Couleur du texte blanc */
    background-color: #1e52a8; /* Couleur de fond bleu */
    display: inline; /* Affichage en ligne pour aligner le texte avec l'icône */
    padding: 10px; /* Espacement autour du texte */
  }


  .client-header {
    display: flex; /* Alignement horizontal de l'icône et du texte */
    justify-content: center; /* Centrer le contenu horizontalement */
    align-items: center; /* Centrer le contenu verticalement */
  }


        

    </style>
</head>
<body>





<!-- Navbar -->
<div class="navbar">
  <a href="#" class="navbar-brand">EncapSure</a>
  <div class="nav-items">
    <a href="#" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
    <a href="#" class="nav-link"><i class="fas fa-bell"></i> Notification</a>
  </div>
</div>
  
<div>
  <br>
  <br>
  <br>
</div>







    <div class="container">



       
<div class="client-header">
  <h1 class="text-center mb-5 interactive client-text">Home Admin</h1>
</div>





        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <a href="tb_admin.html"><i class="icon fas fa-tachometer-alt"></i></a>
                    <h3>Tableau de bord</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <a href="gerer_utilisateurs.html"><i class="icon fas fa-users-cog"></i></a>
                    <h3>Gérer utilisateurs</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <a href="gerer_devis.html"><i class="icon fas fa-file-invoice"></i></a>
                    <h3>Gérer devis clients</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <a href="gerer_souscription.html"><i class="icon fas fa-sign-in-alt"></i></a>
                    <h3>Gérer souscription</h3>
                </div>
            </div>
        </div>
    </div>



<!-- Contenu principal -->
<div class="content">
  <!-- Ajoutez votre contenu ici -->
</div>

<!-- Footer -->
<div class="footer">
  <p>&copy; 2023 EncapSure. All rights reserved.</p>
  <p>
    <a href="#">Politique de confidentialité</a>
    <a href="#">Termes et conditions</a>
    <a href="#">Contactez-nous</a>
  </p>
</div>

<!-- Fin Footer -->   



<!-- Add jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Add Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/AdminHome.blade.php ENDPATH**/ ?>