<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.8.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">
  <meta name="description" content="">
  

  <title>Deadline Pay Page</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="styles.css" />
<script src="script.js" defer></script>


<title>Interface de paiement</title>
<!-- Add Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



<!-- Debut sidebar.html -->

<!-- Ajoutez les liens vers Bootstrap CSS et Font Awesome icons -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Ajoutez cela à la fin de votre body, avant vos autres scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>

.sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        background-color: #1e52a8;
        z-index: 999;
        transition: all 0.3s ease;
    }

    .sidebar ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .sidebar li {
        padding: 20px 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: background-color 0.3s ease;
    }

    .sidebar li:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        font-size: 18px;
        transition: color 0.3s ease;
    }

    .sidebar a:hover {
        color: #0d3d7a;
    }

    .sidebar i {
        margin-right: 10px;
        transition: transform 0.3s ease;
    }

    .sidebar a:hover i {
        transform: scale(1.1);
    }
    

</style>

<!-- Fin sidebare -->


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



<!--
<br>
<br>
<form action="Pay" method="POST">
    <?php echo csrf_field(); ?>
    <div>
    <span > Credit Card Number : </span>
    <input type="text" name="ccn" required>
    </div>
    <span > Security Code : </span>
    <input type="text" name="sc" required>
    </div>
    <span > Expires : </span>
    <input type="month" name="exp" required>
    </div>
    <?php $i=0 ?>
    <?php $__currentLoopData = $INFOS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <input type="hidden" name="infos[<?php echo e($i++); ?>]" value="<?php echo e($info['id']); ?>-<?php echo e($info['receipt']); ?>-<?php echo e($info['contract_num']); ?>-<?php echo e($info['left_amount']); ?>-<?php echo e($info['Adress']); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div>
    <button type="submit">Submit</button>
    </div>

</form>
-->


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



<div class="container">
    <h2><i class="fas fa-credit-card"></i> Paiement</h2>
    <form action="Pay" method="POST" id="payment-form">
    <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="ccn">Numéro de carte de crédit :</label>
            <input type="text" id="credit-card-number" name="ccn" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="sc">Code de sécurité :</label>
            <input type="text" id="security-code" name="sc" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="exp">Date d'expiration :</label>
            <input type="month" id="expires" name="exp" class="form-control">
        </div>
        <?php $i=0 ?>
    <?php $__currentLoopData = $INFOS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <input type="hidden" name="infos[<?php echo e($i++); ?>]" value="<?php echo e($info['id']); ?>-<?php echo e($info['receipt']); ?>-<?php echo e($info['contract_num']); ?>-<?php echo e($info['left_amount']); ?>-<?php echo e($info['Adress']); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <button type="submit" class="btn btn-block">
            <i class="fas fa-lock"></i> Submit
        </button>

       <button type="button" class="btn btn-block" onclick="window.history.back()">

            <i class="fas fa-arrow-left"></i> Retour
        </button>



    </form>
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



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function goBack() {
        window.history.back();
    }

    document.getElementById('payment-form').addEventListener('submit', function(event) {
        event.preventDefault();
    
        const creditCardNumber = document.getElementById('credit-card-number').value.trim();
        const securityCode = document.getElementById('security-code').value.trim();
        const expires = document.getElementById('expires').value.trim();

        if (creditCardNumber === '' || securityCode === '' || expires === '') {
            alert('Veuillez remplir tous les champs.');
        } 
        else {document.getElementById('payment-form').submit();}
    });


document.getElementById('payment-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const creditCardNumber = document.getElementById('credit-card-number').value.trim();
    const securityCode = document.getElementById('security-code').value.trim();
    const expires = document.getElementById('expires').value.trim();

    document.querySelectorAll('.error-message').forEach(el => el.remove());

    let hasErrors = false;

    if (creditCardNumber === '') {
        showError('credit-card-number', 'Le numéro de carte de crédit est obligatoire.');
        hasErrors = true;
    } else if (!/^\d{16}$/.test(creditCardNumber)) {
        showError('credit-card-number', 'Le numéro de carte de crédit doit contenir exactement 16 chiffres.');
        hasErrors = true;
    }

    if (securityCode === '') {
        showError('security-code', 'Le code de sécurité est obligatoire.');
        hasErrors = true;
    } else if (!/^\d{3,4}$/.test(securityCode)) {
        showError('security-code', 'Le code de sécurité doit contenir 3 ou 4 chiffres.');
        hasErrors = true;
    }

    if (expires === '') {
        showError('expires', "La date d'expiration est obligatoire.");
        hasErrors = true;
    }

    else {document.getElementById('payment-form').submit();}

});


function showError(inputId, message) {
    const input = document.getElementById(inputId);
    const errorMessage = document.createElement('div');
    errorMessage.className = 'error-message';
    errorMessage.style.fontSize = '0.8em';
    errorMessage.style.marginTop = '5px';
    errorMessage.style.fontWeight = 'bold'; // Add this line to make the error messages bold
    errorMessage.style.textDecoration = 'underline'; // Ajoutez cette ligne pour souligner le message d'erreur
    errorMessage.style.color = '#ff6666'; // Modifiez cette ligne pour définir la couleur du message d'erreur en #ff6666

    errorMessage.textContent = message;
    input.parentNode.appendChild(errorMessage);
}

</script>


  
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

var clientPost= new HttpClient();



</script>
  
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/ClientPayPage.blade.php ENDPATH**/ ?>