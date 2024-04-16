<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">

    <title>Dashboard Client</title>


<!-- Add Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- Add Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="style.css">


    <!-- Ajoutez cela à la fin de votre body, avant vos autres scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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


    </style>
</head>
<body>


<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notificationModalLabel"><i class="fas fa-bell" style="color: #1e52a8;"></i> Notification</h5>
        <button class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Pas de nouvelles pour l'instant.
      </div>
      <div class="modal-footer">
        <button  class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('.fa-bell').on('click', function() {
        $('#notificationModal').modal('show');
    });
});

$(document).ready(function() {
    $('.nav-link-notification').on('click', function(e) {
        e.preventDefault();
        $('#notificationModal').modal('show');
    });
});
</script>

<div id="loading-spinner"></div>

<script>
    
    document.getElementById("loading-spinner").style.display = "flex"; // Afficher le spinner

// Ici, votre code AJAX...

setTimeout(function() {
    document.getElementById("loading-spinner").style.display = "none"; // Cacher le spinner après 2 secondes
}, 1000);</script>


<!-- Navbar -->
<div class="navbar">
  <a href="Welcome" class="navbar-brand">
    <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="Logo" class="logo"> EncapSure
  </a>
  <div class="nav-items">
  <a href="HomeAgent" class="nav-link"><i class="fas fa-user"></i> <?php echo e(session()->get('name')); ?></a>
  <a href="#" class="nav-link nav-link-notification"><i class="fas fa-bell"></i> Notification</a>
  <a href="Logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>



<div>
  <br>
  <br>
  <br>
  <br>
  <br>
</div>


<div class="container">

    <div class="client-header">
        <h1 class="text-center mb-5 interactive client-text"><i class="fas fa-home"></i> Home Agent</h1>
    </div>

    <div class="row">

        <div class="col-md-6 col-lg-3">
            <div class="card text-center p-4">
                <a href="AgentDashboard"><i class="icon fas fa-tachometer-alt"></i></a>
                <h3>Tableau de bord</h3>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-center p-4">
                <a href="GestionDevis"><i class="icon fas fa-file-invoice"></i></a>
                <h3>Consulter devis</h3>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-center p-4">
                <a href="GestionSouscription"><i class="icon fas fa-file-invoice-dollar"></i></a>
                <h3>Consulter souscription</h3>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-center p-4">
                <a href="Aghome"><i class="icon fas fa-search"></i></a>
                <h3>Examiner documents</h3>
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
</html>

<?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/HomeAgent.blade.php ENDPATH**/ ?>