<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">



<link rel="stylesheet" href="style.css" />
<script src="script.js" defer></script>
<title>Login</title>

<!-- Add Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<!-- Debut sidebar.html -->
<!-- Ajoutez les liens vers Bootstrap CSS et Font Awesome icons -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<!-- Custom CSS pour la page d'inscription -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
    }

    .container {
        max-width: 400px;
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
      <a href="Login" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login</a>
      <a href="Inscription" class="nav-link"><i class="fas fa-user-plus"></i> Inscription</a>
    </div>
  </div>
<!-- Fin Navbar -->




<!-- Sidebar -->
<!-- ... -->

<div class="container">
    <h2><i class="fas fa-sign-in-alt"></i> Connexion</h2>
    <form id="login-form" action='userAuth' method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="login-email">Email :</label>
            <input type="text" id="login-email" name="user" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="login-password">Mot de passe :</label>
            <input type="password" id="login-password" name="password" class="form-control">
        </div>


        

        <button type="submit" class="btn btn-block">
            <i class="fas fa-user-check"></i> Connecter
        </button>
        
       <button type="button" class="btn btn-block" onclick="window.history.back()">

            <i class="fas fa-arrow-left"></i> Retour
        </button>

    </form>

    <p style="color: #ffffff; text-align: center;">Pas encore inscrit ? <a href="Inscription" style="color: #ffffff; text-decoration: underline;">Inscrivez-vous ici</a></p>

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







<!-- Scripts existants -->
<!-- ... -->

<!-- Custom JavaScript pour la page de login -->
<script>
  document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const email = document.getElementById('login-email').value.trim();
    const password = document.getElementById('login-password').value.trim();

    document.querySelectorAll('.error-message').forEach(el => el.remove());

    let hasErrors = false;

    if (email === '') {
        showError('login-email', "L'adresse e-mail est obligatoire.");
        hasErrors = true;
    } else {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      
    }

    if (password === '') {
        showError('login-password', 'Le mot de passe est obligatoire.');
        hasErrors = true;
    } else if (password.length < 3) {
        showError('login-password', 'Le mot de passe doit contenir au moins 8 caractères.');
        hasErrors = true;
    }
    
    if (!hasErrors) {
        document.getElementById("login-form").submit();
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

function goBack() {
    window.location.href = "HomeUser";
}



<?php if(session('state') == 'error'): ?>
  Swal.fire({
    title: 'Erreur!',
    text: 'Les informations que vous avez fournies ne sont pas correctes. Veuillez vérifier vos coordonnées et essayer à nouveau.',
    icon: 'error',
    confirmButtonText: 'OK'
  });
<?php endif; ?>


</script>

<script>

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

    // Afficher la boîte de dialogue SweetAlert2
    Swal.fire({
        title: 'Erreur!',
        text: message,
        icon: 'error',
        confirmButtonText: 'OK'
    });
}

function goBack() {
    window.location.href = "HomeUser";
}

<?php if(session('state') == 'error'): ?>
  Swal.fire({
    title: 'Erreur!',
    text: 'Les informations que vous avez fournies ne sont pas correctes. Veuillez vérifier vos coordonnées et essayer à nouveau.',
    icon: 'error',
    confirmButtonText: 'OK'
  });
<?php endif; ?>

</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/Login.blade.php ENDPATH**/ ?>