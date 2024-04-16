<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.8.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">
  <meta name="description" content="">
  <link rel="stylesheet" href="Clstyle.css">
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




/* CSS pour centrer les labels*/
.steps .circle:nth-child(1)::before {
  content: "Souscripteur";
}

.steps .circle:nth-child(2)::before {
  content: "Contrat";
}

.steps .circle:nth-child(3)::before {
  content: "Livraison";
}

.steps .circle:nth-child(4)::before {
  content: "Paiement";
}

.steps .circle:nth-child(5)::before {
  content: "Document";
}

.steps .circle:nth-child(6)::before {
  content: "Signature";
}


/*fin CSS pour centrer les labels*/ 



/* pour mettre le process de devis plis pres de progressbar */
.client-text {
  color: white; /* Couleur du texte blanc */
  background-color: #1e52a8; /* Couleur de fond bleu */
  display: inline; /* Affichage en ligne pour aligner le texte avec l'icône */
  padding: 10px; /* Espacement autour du texte */
  margin-bottom: 5px; /* Ajouté pour déplacer le texte vers la progress bar */
}

.client-header {
  display: flex; /* Alignement horizontal de l'icône et du texte */
  justify-content: center; /* Centrer le contenu horizontalement */
  align-items: center; /* Centrer le contenu verticalement */
}

.container_progress_bar {
  margin-top: -10px;
}

/* fin process de devis plis pres de progressbar */




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



<!-- Sidebar -->
<div class="sidebar">

  <div class="sidebar-logo">
   <a href="Home"> <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="Logo"> </a>

<div class="sidebar-logo-text">EncapSure</div>
<div class="sidebar-line"></div>

  </div>


  <div class="sidebar-header">
    <a href="Home">
    <i class="fas fa-user-circle"></i> <?php echo e(session()->get('name')); ?></a>
    </a>

  </div>


  <ul class="list-unstyled components">
    <li></li>


    <li>
      <a href="Home">
       <i class="fas fa-home"></i> Home
      </a>
    </li>

    <li>
      <a href="ClientTB">
        <i class="fas fa-calculator"> </i> Devis
      </a>
    </li>
    <li>
      <a href="ClientTB">
        <i class="fas fa-file-contract"></i> Souscription
      </a>
    </li>

    <li>
      <a href="ClientTB">
        <i class="fas fa-user-cog"></i> Gérer Compte
      </a>
    </li>

    <li>
      <a href="Logout">
        <i class="fas fa-sign-out-alt"></i> Déconnexion
      </a>
    </li>
  </ul>
</div>





<div class="client-header">
<h1 class="text-center mb-5 interactive client-text">Processus de Souscription</h1>
</div>







<!-- New version -->


<div class="container_progress_bar">
  <div class="steps">


    <span class="circle active">
     <i class="fas fa-user"></i>
    </span>


    <span class="circle">
      <i class="fas fa-file-contract"></i>
    </span>


    <span class="circle">
      <i class="fas fa-shipping-fast"></i>
    </span>


    <span class="circle">
      <i class="fas fa-credit-card"></i>
    </span>

    <span class="circle">
    <i class="fas fa-file-upload"></i>
    </span>


        <span class="circle">
      <i class="fas fa-file-signature"></i>
    </span>


    <div class="progress-bar">
      <span class="indicator"></span>
    </div>


  </div>
</div>

<!-- fin new version -->





<div class="container">
    <h2><i class="fas fa-file-upload"></i> Documents</h2>
    <form action="UploadIDFiles" method="POST" enctype="multipart/form-data" id="upload-form">
    <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="ids">Carte d'identité :</label>
            <input type="file" id="ids" name="id_doc" class="form-control">
        </div>
        <div class="form-group">
            <label for="ids">Carte grise :</label>
            <input type="file"  class="form-control">
        </div>
        <div class="form-group">
            <label for="ids">Quittance visite technique :</label>
            <input type="file"  class="form-control">
        </div>
        <div class="form-group">
            <label for="ids">Quittance vignette :</label>
            <input type="file"  class="form-control">
        </div>
        <button type="submit" id="up_btn" class="btn btn-block">
        <i class="fas fa-check-circle"></i> Soumettre
        </button>
    </form>
</div>
  


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>

function updateProgressBar(currentPage) {
    const circles = document.querySelectorAll(".circle");
    const progressBar = document.querySelector(".indicator");
    
    let currentStep = currentPage;
    
    circles.forEach((circle, index) => {
        circle.classList[`${index < currentStep ? "add" : "remove"}`]("active");
    });
    
    progressBar.style.width = `${((currentStep - 1) / (circles.length - 1)) * 100}%`;
}

updateProgressBar(5);
</script>
<!--
<script>
    function goBack() {
        window.history.back();
    }

    document.getElementById("upload-form").addEventListener("submit", function(event) {
        event.preventDefault();
        alert("Quittances soumises !");
    });
</script>
-->
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/SubsUploadPage.blade.php ENDPATH**/ ?>