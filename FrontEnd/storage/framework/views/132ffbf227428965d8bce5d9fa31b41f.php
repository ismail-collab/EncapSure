<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">


    <link rel="stylesheet" href="../style.css" />
    
    <script src="script.js" defer></script>

    <title>Page d'accueil</title>
    
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <!-- Ajoutez cela à la fin de votre body, avant vos autres scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <style>


     /* Ajoutez ces règles CSS */
.service-icon,
.service-title {
  color: #1e52a8;
}

/* Reste du code CSS */
body {
  font-family: Arial, sans-serif;
  background-color: #ffffff;
  
}

.navbar {
  background-color: #1e52a8;
}

.navbar-brand,
.navbar-nav .nav-link {
  color: #ffffff;
}

.jumbotron {
  background-color: #1e52a8;
  color: #ffffff;
}

.jumbotron .btn {
  background-color: #008000;
  border-color: #008000;
}

.jumbotron .btn:hover {
  background-color: #ffffff;
  border-color: #ffffff;
  color: #008000;
}

.service-container {
  transition: background-color 0.3s;
}

.service-container:hover {
  background-color: #1e52a8;
  cursor: pointer;
}

.service-container:hover .service-icon,
.service-container:hover .service-title,
.service-container:hover .service-text {
  color: #ffffff;
}

.service-icon,
.service-title {
  transition: color 0.3s;
}

/* Ajoutez cette règle CSS pour changer la couleur de l'icône Nos Services */
.client-text .service-icon i {
  color: #ffffff;
}


.faq-btn {
  color: #1e52a8;
}

.faq-answer {
  color: #000;
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
        <a href="Login" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login</a>
        <a href="Inscription" class="nav-link"><i class="fas fa-user-plus"></i> Inscription</a>
      </div>
  </div>
  
<!-- Sidebar et autres éléments -->
  
  
    <!-- Banner animée -->
    <!--
    <section style="background-color: #ffffff; padding: 20px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://via.placeholder.com/900x300" class="d-block w-100" alt="Image 1">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Titre 1</h5>
                                    <p>Description 1</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="https://via.placeholder.com/900x300" class="d-block w-100" alt="Image 2">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Titre 2</h5>
                                    <p>Description 2</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="https://via.placeholder.com/900x300" class="d-block w-100" alt="Image 3">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Titre 3</h5>
                                    <p>Description 3</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Précédent</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
-->

<!--
 <div class="navbar-line"></div>
-->

    <div class="jumbotron text-center">
        <h1 class="display-4">Bienvenue sur EncapSure</h1>
        <p class="lead">Assurance automobile en ligne.</p>
        <div style="background-color: #ffffff;">
            <img src="<?php echo e(asset('images/EncapSure.jpg')); ?>" alt="EncapSure Photo" width="auto" height="300">
        </div>
        <br>
        <p>Rejoignez-nous dès maintenant et découvrez les avantages d'EncapSure.</p>
        
        <a class="btn btn-lg" href="Inscription" role="button">Inscrivez-vous</a>
        <!-- Ajoutez le bouton de connexion ici -->
        <a class="btn btn-lg" href="Login" role="button" style="background-color:#1e52a8; border-color: #ffffff; color: #ffffff; margin-left: 10px;">Connexion</a>
    </div>


<!-- Section des services d'EncapSure -->
<div class="container mt-5">
  <div class="row">
    <div class="col-md-12 text-center">
      <div class="client-header">
        <h1 class="text-center mb-5 interactive client-text">
          <span class="service-icon">
            <i class="fas fa-concierge-bell"></i>
          </span>
          Nos Services
        </h1>
      </div>
    </div>
  </div>


  <div class="row mt-4">
  <div class="col-md-4 text-center service-container">
    <br>
    <a href="Login">
      <i class="fas fa-calculator fa-3x service-icon" style="margin-bottom: 15px;"></i>
    </a>
    <h3 class="service-title"><b>Effectuer un devis</b></h3>
    <p class="service-text">Obtenez un devis personnalisé pour votre assurance automobile en quelques minutes.</p>
  </div>
  <div class="col-md-4 text-center service-container">
    <br>
    <a href="Login">
      <i class="fas fa-file-signature fa-3x service-icon" style="margin-bottom: 15px;"></i>
    </a>
    <h3 class="service-title"><b>Souscription</b></h3>
    <p class="service-text">Souscrivez facilement à votre assurance automobile en ligne en suivant un processus simple et rapide.</p>
  </div>
  <div class="col-md-4 text-center service-container">
    <br>
    <a href="Login">
      <i class="fas fa-tasks fa-3x service-icon" style="margin-bottom: 15px;"></i>
    </a>
    <h3 class="service-title"><b>Gestion des échéances</b></h3>
    <p class="service-text">Suivez et gérez les échéances de votre assurance automobile pour rester à jour et éviter les pénalités.</p>
  </div>
</div>





  </div>
<br>
<br>
</div>




<!-- Section Avantages -->
<section style="background-color: #1e52a8; padding: 50px 0;">
<br>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h2 class="text-center mb-4" style="color: #ffffff;"><i class="fas fa-star"></i> Avantages d'EncapSure</h2><br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 text-center">
        <i class="fas fa-check-circle fa-3x" style="color: #ffffff; margin-bottom: 15px;"></i>
        <h4 style="color: #ffffff;"><strong>Simplicité</strong></h4>
        <p style="color: #ffffff;">EncapSure rend l'assurance automobile simple et facile à comprendre, sans jargon compliqué.</p>
      </div>
      <div class="col-md-4 text-center">
        <i class="fas fa-thumbs-up fa-3x" style="color: #ffffff; margin-bottom: 15px;"></i>
        <h4 style="color: #ffffff;"><strong>Tarifs compétitifs</strong></h4>
        <p style="color: #ffffff;">Nous proposons des tarifs compétitifs pour vous offrir la meilleure couverture au meilleur prix.</p>
      </div>

      <div class="col-md-4 text-center">
        <i class="fas fa-robot fa-3x" style="color: #ffffff; margin-bottom: 15px;"></i>
        <h4 style="color: #ffffff;"><strong>Automatisation</strong></h4>
        <p style="color: #ffffff;">Notre système automatisé simplifie le processus d'assurance automobile pour une expérience utilisateur plus efficace.</p>
      </div>
      
    </div>
  </div>
  <br>
</section>




<!-- Section FAQ -->
<section style="background-color: #ffffff; padding: 80px 0;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h2 class="text-center mb-4" style="color: #1e52a8;"> FAQ <i class="fas fa-question-circle"></i></h2>

        <div id="accordion">
          <div class="card" style="border: none; background-color: transparent;">
            <div class="card-header" id="headingOne" style="background-color: transparent; border-bottom: none;">
              <h5 class="mb-0">
                <button class="btn btn-link faq-btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-comment"></i>
       <b style="color: #1e52a8;">Question 1 :</b> Comment fonctionne EncapSure ?
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
             <div class="card-body faq-answer">
               EncapSure est une assurance automobile en ligne qui vous permet d'obtenir un devis personnalisé, de souscrire facilement et de gérer les échéances de votre assurance automobile.
             </div>
            </div>

          </div>
          <div class="card" style="border: none; background-color: transparent;">
            <div class="card-header" id="headingTwo" style="background-color: transparent; border-bottom: none;">
              <h5 class="mb-0">
                <button class="btn btn-link faq-btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <i class="fas fa-comment"></i>
       <b style="color: #1e52a8;">Question 2 :</b> Comment obtenir un devis personnalisé ?
                </button>
              </h5>
            </div>

            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body faq-answer">
                <span style="color: #1e52a8;">1.</span> Cliquez sur le bouton "Effectuer un devis" dans la section "Nos Services".<br>
                <span style="color: #1e52a8;">2.</span> Sélectionnez le type de véhicule que vous souhaitez assurer.<br>
                <span style="color: #1e52a8;">3.</span> Remplissez les informations requises sur votre véhicule, y compris  le modèle, la date de mise en circulation et le kilométrage.<br>
                <span style="color: #1e52a8;">4.</span> Indiquez vos besoins en matière d'assurance automobile en choisissant les garanties et les options qui vous conviennent le mieux.<br>
                <span style="color: #1e52a8;">5.</span> Remplissez vos informations personnelles, y compris votre nom, votre adresse e-mail et votre numéro de téléphone.<br>
                <span style="color: #1e52a8;">6.</span> Obtenez un devis personnalisé en fonction de vos besoins et de vos informations.
              </div>
            </div>
          </div>
          <div class="card" style="border: none; background-color: transparent;">
            <div class="card-header" id="headingThree" style="background-color: transparent; border-bottom: none;">
              <h5 class="mb-0">
                <button class="btn btn-link faq-btn collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <i class="fas fa-comment"></i>
       <b style="color: #1e52a8;">Question 3 :</b> Comment souscrire à une assurance automobile en ligne ?
                </button>
              </h5>
            </div>

            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body faq-answer">
                <span style="color: #1e52a8;">1.</span> Cliquez sur le bouton "Souscription" dans la section "Nos Services".<br>
                <span style="color: #1e52a8;">2.</span> Connectez-vous à votre compte EncapSure ou créez-en un si vous n'en avez pas encore.<br>
                <span style="color: #1e52a8;">3.</span> Sélectionnez le devis que vous souhaitez souscrire.<br>
                <span style="color: #1e52a8;">4.</span> Vérifiez les informations du devis et apportez les modifications nécessaires si besoin.<br>
                <span style="color: #1e52a8;">5.</span> Finalisez la souscription en payant la prime d'assurance automobile et en signant électroniquement les documents requis.<br>
                <span style="color: #1e52a8;">6.</span> Recevez votre contrat d'assurance automobile personnalisé et commencez à conduire en toute sécurité.
              </div>
            </div>
          </div>
          <!-- Ajoutez d'autres questions et réponses ici -->
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
  </div>
  <!-- fin FAQ -->
</section>








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

  
    <!-- Add jQuery and Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/HomeUser.blade.php ENDPATH**/ ?>