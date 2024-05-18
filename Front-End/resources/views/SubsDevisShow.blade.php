<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <script type="text/javascript" src="/jquery/jquery.js"></script>

    <!-- Ajoutez cela à la fin de votre body, avant vos autres scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <style>

@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
section {
  position: fixed;
  height: 100%;
  width: 100%;
  background: #ffffff;
}
button {
  font-size: 18px;
  width: 300px;
  font-weight: 400;
  color: #fff;
  padding: 14px 22px;
  position:absolute;
  border: none;
  right: 0;
  margin-right: 150px;
  margin-top: 340px;
  background: #1e52a8;
  border-radius: 6px;
  cursor: pointer;
}
#frame {
  margin-top: 55px;
}
#mod_btn {
  font-size: 18px;
  font-weight: 400;
  color: #fff;
  padding: 14px 22px;
  position:absolute;
  border: none;
  right: 0;
  margin-right: 150px;
  margin-top: 410px;
  background: #008000; /*ceci est modifier de rouge en orange*/ 
  border-radius: 6px;
  cursor: pointer;
}

h1 {
  margin-top: 18%;
  margin-left: 18%;
}

/* hover modifier pour les 2 btn */

button:hover {
        background-color: #0d3d7a;
}

#mod_btn:hover {
        background-color: #e60000;
}


/* fin hover pour les 2  btns */




button.show-modal,
.modal-box {
  position: fixed;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

section.active .show-modal {
  display: none;
}

.overlay {
  position: fixed;
  height: 100%;
  width: 100%;
  background: rgba(0, 0, 0, 0.3);
  opacity: 0;
  pointer-events: none;
}

section.active .overlay {
  opacity: 1;
  pointer-events: auto;
}

.modal-box {
  display: flex;
  flex-direction: column;
  align-items: center;
  max-width: 380px;
  width: 100%;
  padding: 30px 20px;
  border-radius: 24px;
  background-color: #fff;
  opacity: 0;
  pointer-events: none;
  transition: all 0.3s ease;
  transform: translate(-50%, -50%) scale(1.2);
}

section.active .modal-box {
  opacity: 1;
  pointer-events: auto;
  transform: translate(-50%, -50%) scale(1);
}

.modal-box i {
  font-size: 70px;
  color: #1e52a8;
}

.modal-box h2 {
  margin-top: 20px;
  font-size: 25px;
  font-weight: 500;
  color: #333;
}

.modal-box h3 {
  font-size: 16px;
  font-weight: 400;
  color: #333;
  text-align: center;
}

.modal-box .buttons {
  margin-top: 25px;
}

.modal-box button {
  font-size: 14px;
  padding: 6px 12px;
  margin: 0 10px;
}


.retour {
      font-size: 18px;
      font-weight: 400;
      padding: 14px 22px;
      position:absolute;
      border: none;
      right: 0;
      margin-right: 150px;
      margin-top: 580px; /* Ajustez cette valeur pour positionner le bouton Retour en dessous du bouton Modifier le devis */
      border-radius: 6px;
      cursor: pointer;
    }

    
#del_btn {
      background-color: #ff6666;
      font-size: 18px;
      font-weight: 400;
      padding: 14px 22px;
      position:absolute;
      border: none;
      right: 0;
      margin-right: 150px;
      margin-top: 480px; /* Ajustez cette valeur pour positionner le bouton Retour en dessous du bouton Modifier le devis */
      border-radius: 6px;
      cursor: pointer;
    }


</style>
</head>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>



<body>



<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Voulez-vous confirmer la suppression du devis ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" id="confirmDelete">Confirmer</button>
      </div>
    </div>
  </div>
</div>


<!--
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
  -->
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
    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo"> EncapSure
  </a>
  <div class="nav-items">
    <a href="Profile" class="nav-link"><i class="fas fa-user"></i> {{ session()->get('name') }}</a>
    <a href="#" class="nav-link nav-link-notification"><i class="fas fa-bell"></i> Notification</a>
    <a href="Logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>


@foreach ($DEVIS as $dev)
@php if ($dev!=null) {  @endphp


  <section>

  <iframe id="frame" height="740" width="700" src="data:application/pdf;base64,{{$dev->devis_doc}}" ></iframe>
  
  </section>

  <button  id="proc_btn"> Procéder à la souscription</button>
  <button  id="mod_btn" onClick="window.location.href='Dvmod'"> Modifier le devis</button>
  <button  id="del_btn" onClick="DeleteDevis({{$dev->devis_id}})"> Supprimer le devis</button>

  @php } else { @endphp 
  <h1>Aucun devis existant, veuillez insérer un nouveau devis</h1>
  @php } @endphp
  @endforeach
  <button onclick="window.location.href='Home'" class="retour">Retour</button>



  
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

var url='http://localhost:9090/cldevisdel';
var client= new HttpClient();


    $(document).ready(function(e) {
        $('#proc_btn').click(function(){
            var myTimeout = setTimeout(PageReload, 100);


            function PageReload(){
                window.location.href='Subs';
            }
            
            console.log("click");
            
        });

    });

    function DeleteDevis(x) {
      var confirmation = confirm("Voulez-vous confirmer la suppression du devis ?");
      console.log("T",x);
      if (confirmation) {
        client.get({"devis_id":x},url, function (response) {

          console.log(response);
        window.location.href="Home";
      });
      }
    
    }

  </script>


<script>
  $(document).ready(function(e) {
    $('#proc_btn').click(function(){
        var myTimeout = setTimeout(PageReload, 100);

        function PageReload(){
            window.location.href='Subs';
        }
        
        console.log("click");
        
    });

    var devisIdToDelete; // pour stocker l'id du devis à supprimer

    $('#del_btn').click(function() {
      $('#confirmModal').modal('show'); // afficher le modal
      devisIdToDelete = $(this).data('devis-id'); // stocker l'id du devis à supprimer
    });

    // lorsqu'on clique sur le bouton "Confirmer" dans le modal
    $('#confirmDelete').click(function() {
      DeleteDevis(devisIdToDelete); // appeler la fonction de suppression
    });

});

function DeleteDevis(x) {
  var confirmation = confirm("Voulez-vous confirmer la suppression du devis ?");
  console.log("T",x);
  if (confirmation) {
    client.get({"devis_id":x},url, function (response) {

      console.log(response);
    window.location.href="Home";
  });
  }
}

</script>

</body>
</html>