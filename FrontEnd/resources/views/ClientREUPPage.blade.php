<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.8.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

  <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">
  
  <meta name="description" content="">
  <link rel="stylesheet" href="style.css">
  <title>Dépôt des quittances</title>
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

    .container {
        max-width: 450px; /*this was changed*/  
        margin: 50px auto;
        padding: 20px;
        background-color: #1e52a8;
        border-radius: 10px;
    }

    h2 {
        color: #ffffff;
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        display: block;
        color: #ffffff;
        margin-bottom: 5px;
    }

    input[type="file"] {
        display: block;
        margin-bottom: 10px;
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


<div class="container">
    <h2><i class="fas fa-file-upload"></i> Dépôt des quittances</h2>
    <form action="REUploadFiles" method="POST" enctype="multipart/form-data" id="upload-form">
    @csrf
        <div class="form-group">
            <label for="vignette">Quittance de vignette:</label>
            <input type="file" id="vignette" name="vig" class="form-control">
        </div>
        <div class="form-group">
            <label for="visite-technique">Quittance de visite technique:</label>
            <input type="file" id="visite-technique" name="tech" class="form-control">
        </div>

    <input type="hidden" name="contract" value="{{session()->get('dl')}}">
 


    <button type="submit" class="btn btn-block">
            <i class="fas fa-file-upload"></i> Soumettre
        </button>
        


       <button type="button" class="btn btn-block" onclick="window.history.back()">

            <i class="fas fa-arrow-left"></i> Retour
        </button>


    </form>
</div>
  
<div>
    <br>
    <br>
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




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>