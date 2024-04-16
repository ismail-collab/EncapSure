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


#Error {
    margin-left: 35%;
    margin-top: 30px;
    display:none;
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
  <a href="Home" class="nav-link"><i class="fas fa-user"></i> <?php echo e(session()->get('name')); ?></a>
    <a href="#" class="nav-link nav-link-notification"><i class="fas fa-bell"></i> Notification</a>
  <a href="Logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>

  
<div>
  <br>
  <br>
  <br>
</div>



<div class="container">


    <div class="client-header">
        <h1 class="text-center mb-5 interactive client-text"><i class="fas fa-home"></i> Home Client</h1>
    </div>

    <div class="row">


    <div class="col-md-6 col-lg-3">
            <div class="card text-center p-4">
                <a id="dev_btn" href="#"><i class="icon fas fa-calculator"></i></a>
                <h3>Obtenir un devis</h3>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-center p-4">
                <a href="Subspick"><i class="icon fas fa-file-signature"></i></a>
                <h3>Souscription assurance</h3>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-center p-4">
                <a href="Clpage"><i class="icon fas fa-tasks"></i></a>
                <h3>Gestion des échéances</h3>
            </div>
        </div>



        <div class="col-md-6 col-lg-3">
            <div class="card text-center p-4">
                <a href="ClientTB"><i class="icon fas fa-user-cog"></i></a>
                <h3>Gérer compte client </h3>
            </div>
        </div>

        

    </div>
</div>






<!-- Contenu principal 
<div class="content">
  <h1 id="Error">vous avez déjà un devis</h1>
</div>
-->

<!-- Contenu principal -->
<div class="content">
  <h1 id="Error" style="color: #ff6666">Vous avez déjà un devis <i class="fas fa-exclamation-circle"></i>
  <p style="font-size: 18px; color: #ff6666; text-align: center;">
       Veuillez effectuer la <a href="Subspick" style="color: #ff6666;"><u>souscription</u></a> ou 
    <a href="Subspick" style="color: #ff6666;"><u>changer le devis</u></a>.
  </p></h1>

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

    
    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Add Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>

var HttpClient = function(){
  this.get = function(Reqdata, aUrl, aCallback) {
      var anHttpRequest = new XMLHttpRequest();
      anHttpRequest.onreadystatechange = function() {
          if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
          aCallback(anHttpRequest.responseText);
      }
      anHttpRequest.open("POST",aUrl,true);
      anHttpRequest.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
      anHttpRequest.send(JSON.stringify(Reqdata));
  }
}

var devBtn = document.getElementById('dev_btn');
var Err = document.getElementById('Error');
var url='http://localhost:9090/deviscurrshow';
var client= new HttpClient();



devBtn.addEventListener('click', function () {
    client.get({"dv_usern":"<?php echo e(session()->get('user')); ?>"},url, function (response){
       
  
        console.log(response);

        if (response.length>0 || response.trim()!='') {
            var resp= JSON.parse(response);
            console.log(resp);
            Err.style.display='block';
            devBtn.setAttribute('href','#');

}
else {
    devBtn.setAttribute('href','Dvpg');
    window.location.href="Dvpg";
}
        


});

});

</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/ClientHome.blade.php ENDPATH**/ ?>