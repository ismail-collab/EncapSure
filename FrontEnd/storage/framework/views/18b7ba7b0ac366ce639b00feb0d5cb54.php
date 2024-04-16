<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">

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
        max-width: 450px;
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



<div>
    <br>
    <br>
</div>

<!-- Navbar -->
<div class="navbar">
  <a href="Welcome" class="navbar-brand">
    <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="Logo" class="logo"> EncapSure
  </a>
  <div class="nav-items">
  <a href="Profile" class="nav-link"><i class="fas fa-user"></i> <?php echo e(session()->get('name')); ?></a>
  <a href="#" class="nav-link nav-link-notification"><i class="fas fa-bell"></i> Notification</a>
  <a href="Logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>



  

<!-- Contenu principal -->
<div class="content">
    
<div class="container">
    <h2><i class="fas fa-user-edit"></i> Modifier informations</h2>
    <form id="account-form" action="UpdateUser" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="account-email">Email :</label>
            <input type="text" id="account-email" name="email" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="account-password">Mot de passe :</label>
            <input type="password" id="account-password" name="newpassword" class="form-control">
        </div>

        <div class="form-group">
            <label for="confirm-password">Confirmer le mot de passe :</label>
            <input type="password" id="confirm-password" class="form-control">
        </div>

            <button type="submit" class="btn btn-block">
                <i class="fas fa-sync-alt"></i> Mettre à jour
            </button>
            
        
            <button type="button" class="btn btn-block" onclick="window.history.back();">
                <i class="fas fa-arrow-left"></i> Retour
            </button>
            
        </form>       
    </div>


</div> <!-- div ajouter pour la footer -->
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







    <script>
    
    document.getElementById('account-form').addEventListener('submit', function(event) {
        event.preventDefault();
    
        const email = document.getElementById('account-email').value.trim();
        const password = document.getElementById('account-password').value.trim();
        const confirmPassword = document.getElementById('confirm-password').value.trim();
    
        document.querySelectorAll('.error-message').forEach(el => el.remove());
    
        let hasErrors = false;
    
        if (email === '') {
            showError('account-email', "L'adresse e-mail est obligatoire.");
            hasErrors = true;
        } else {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                showError('account-email', 'Veuillez entrer une adresse e-mail valide.');
                hasErrors = true;
            }
        }
    
        if (password === '') {
            showError('account-password', 'Le mot de passe est obligatoire.');
            hasErrors = true;
        } else if (password.length < 8) {
            showError('account-password', 'Le mot de passe doit contenir au moins 8 caractères.');
            hasErrors = true;
        }
    
        if (confirmPassword === '') {
            showError('confirm-password', 'La confirmation du mot de passe est obligatoire.');
            hasErrors = true;
        } else if (password !== confirmPassword) {
            showError('confirm-password', 'Les mots de passe ne correspondent pas.');
            hasErrors = true;
        }
    
        if (!hasErrors) {
            document.getElementById('account-form').submit();
        }
    });
    
    function showError(inputId, message) {
const input = document.getElementById(inputId);
const errorMessage = document.createElement('div');
errorMessage.className = 'error-message';
errorMessage.style.fontSize = '0.8em';
errorMessage.style.marginTop = '5px';
errorMessage.style.fontWeight = 'bold';
errorMessage.style.textDecoration = 'underline';
errorMessage.style.color = '#ff6666';
errorMessage.textContent = message;
input.parentNode.appendChild(errorMessage);
}

function resetForm() {
document.getElementById('account-form').reset();
document.querySelectorAll('.error-message').forEach(el => el.remove());
}

function goBack() {

window.location.href = "Home";

}

</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/UserSettings.blade.php ENDPATH**/ ?>