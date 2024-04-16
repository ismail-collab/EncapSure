<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">



<link rel="stylesheet" href="style.css" />
<script src="script.js" defer></script>
<title>Ajouter Pack</title>

<!-- Add Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<!-- Debut sidebar.html -->
<!-- Ajoutez les liens vers Bootstrap CSS et Font Awesome icons -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<!-- Custom CSS pour la page d'inscription -->

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



<div>
    <br>

</div>

<div class="container">
    <h2><i class="fas fa-shield-alt"></i> Créez votre pack</h2>
    <div class="Forms" id="F3">
        <!-- Form Card -->
        <div>
            <form id="pack-form" action="addpack" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="pack-name"><i class="fas fa-tag"></i> Nom du Pack :</label>
                    <input type="text" id="pack-name" name="pack_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="pack-price"><i class="fas fa-dollar-sign"></i> Prix du Pack :</label>
                    <input type="number" id="pack-price" name="price" class="form-control" readonly required>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-shield-alt"></i> Garanties :</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="guarantees[1]" value="1" id="gr1">
                        <label class="form-check-label" for="responsabilite-civile">
                            Responsabilité civile
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="guarantees[2]" value="2" id="gr2">
                        <label class="form-check-label" for="assistance-24-7">
                            Assistance 24/7
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="guarantees[3]" value="3" id="gr3">
                        <label class="form-check-label" for="protection-juridique">
                            Protection juridique
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="guarantees[4]" value="4" id="gr4">
                        <label class="form-check-label" for="garantie-dommages">
                            Garantie dommages
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="guarantees[5]" value="5" id="gr5">
                        <label class="form-check-label" for="vol-et-incendie">
                            Vol et incendie
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="guarantees[6]" value="6" id="gr6">
                        <label class="form-check-label" for="assurance-tous-risques">
                            Assurance tous risques
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="guarantees[7]" value="7" id="gr7">
                        <label class="form-check-label" for="franchise-modulable">
                        <label class="form-check-label" for="franchise-modulable">
                            Franchise modulable
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-block">
                    <i class="fas fa-check"></i> Créer
                </button>

                <button type="button" class="btn btn-block" onclick="window.history.back()">
                    <i class="fas fa-arrow-left"></i> Retour
                </button>


            </form>
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



<script>
    
    var money = 0;
    var gr1 = document.getElementById('gr1');
    var gr2 = document.getElementById('gr2');
    var gr3 = document.getElementById('gr3');
    var gr4 = document.getElementById('gr4');
    var gr5 = document.getElementById('gr5');
    var gr6 = document.getElementById('gr6');
    var gr7 = document.getElementById('gr7');
    var price = document.getElementById('pack-price');


    document.body.addEventListener('click', function(e) {

        money=0;
        price.value=0;

        if (gr1.checked==true) {
            money = money + 120;
        }
        if (gr2.checked==true) {
            money = money + 105;
        }
        if (gr3.checked==true) {
            money = money + 175;
        }
        if (gr4.checked==true) {
            money = money + 40;
        }
        if (gr5.checked==true) {
            money = money + 35;
        }
        if (gr6.checked==true) {
            money = money + 40;
        }
        if (gr7.checked==true) {
            money = money + 35;
        }

        price.value=money;

 
});

</script>



<!-- Scripts existants -->
<!-- ... -->



</body>
</html>
<?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/AjouterPack.blade.php ENDPATH**/ ?>