<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">

    <title>Gestion des devis clients</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Add Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <!-- Ajoutez cela à la fin de votre body, avant vos autres scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        h2 {
            color: #1e52a8;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #1e52a8;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #1e52a8;
            color: #ffffff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }


        .pops-content {
  /* Ajoutez les styles suivants pour centrer le contenu et ajouter une position relative */
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  align-items: center;
  text-align: center;
  position: absolute;
  display:none;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1000;
}

        .btn-edit, .btn-delete {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .btn-edit i, .btn-delete i {
            font-size: 18px;
        }

        .btn-edit i {
            color: #1e52a8;
        }

        .btn-delete i {
            color: #ff6666;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        #searchInput {
            width: 60%;
            padding: 10px;
            margin-right: 5px;
        }

        #searchButton {
            padding: 10px;
        }

        #confirm {
            height: 40px;
            width: 55%;
            background-color: green;
            color: #fff;
        }

        #confirm:hover {
            height: 40px;
            background-color: black;
            color: #fff;
        }


    /*this is for btn consulter */

    .btn-view {
    background-color: transparent;
    border: none;
    cursor: pointer;
    }

    .btn-view i {
        font-size: 18px;
        color: #1e52a8;
    }

        /*Fin*/

        input[type="text"], input[type="password"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ffffff;
        border-radius: 5px;
    }

    button[type="submit"], button[type="button"] {
        display: block;
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        color: #ffffff;
        font-weight: bold;
        cursor: pointer;
        margin-bottom: 10px;
    }

    button[type="submit"] {
        background-color: #008000;
    }

    button[type="submit"]:hover {
        background-color: #ffffff;
    }

    button[type="button"] {
        background-color: #ff6666;
    }

    button[type="button"]:hover {
        background-color: #ffffff;
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

<div>
    <br>
    <br>
    <br>
</div>

<!-- Navbar -->
<div class="navbar">
  <a href="Welcome" class="navbar-brand">
    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo"> EncapSure
  </a>
  <div class="nav-items">
  <a href="Profile" class="nav-link"><i class="fas fa-user"></i> {{ session()->get('name') }}</a>
  <a href="#" class="nav-link nav-link-notification"><i class="fas fa-bell"></i> Notification</a>
  <a href="Logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>



<div class="content">

        <div class="container">
        <div class="container d-flex justify-content-center align-items-center vh-100">
    <form id="login-form" action='Test2' method="POST" class="d-flex flex-column align-items-center">
        @csrf

        <button type="submit" class="btn btn-block mb-3">
            <i class="fas fa-user-check"></i> btn 1
        </button>
        

        <button type="button" class="btn btn-block" >
        <i class="fas fa-user-check"></i> btn 2
        </button>

    </form>
</div>




<!-- Contenu principal -->
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




</script>
</body>
</html>