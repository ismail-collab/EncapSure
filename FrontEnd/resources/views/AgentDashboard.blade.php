<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">
    <title>Dashboard - Material Style</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Ajoutez cela à la fin de votre body, avant vos autres scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
    .custom-btn {
        border-color: #1e52a8 !important; /* changer la couleur de la bordure */
        color: #1e52a8 !important; /* changer la couleur du texte */
    }

    .custom-btn:hover {
        background-color: #1e52a8 !important; /* changer la couleur de fond lors du survol */
        color: white !important; /* changer la couleur du texte lors du survol */
    }
</style>


    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
    />

    <link
      href="https://fonts.googleapis.com/css?family=Montserrat"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    
    <link rel="stylesheet" href="assets/styles_Agent_Dashboard.css" />


  
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
}, 1000);
</script>


    <div id="wrapper">
      <div class="content-area">
        <div class="container-fluid">

          <div class="text-right mt-3 mb-3 d-fixed">
              <a href="Home" class="btn custom-btn mr-2">
                  <i class="fas fa-home"></i> <!-- icône de la maison -->
                  <span class="btn-text">Home</span>
              </a>
          </div>


          <div class="main">
            <div class="row mt-4">

              <div class="col-md-6">
                <div class="box shadow">
                  <div id="donutTop"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box shadow">
                  <div id="radialBar1"></div>
                </div>
              </div>
            </div>

            <div class="row mt-4 mb-5">
              <div class="col-md-6">
                <div class="row sparkboxes mt-4">
                  <div class="col-md-6">
                    <div class="box box1">
                      <div id="spark1">Nombre de simulation devis</div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="box box2">
                      <div id="spark2">Nombre de devis générés</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box body-bg">
                  <div
                    id="area-adwords"
                    style="background: #fff"
                    class="shadow"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="assets/scripts_Agent_Dashboard.js"></script>
  </body>
</html>
