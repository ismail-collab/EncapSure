<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">

    <title>Tableau de bord client</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <link rel="stylesheet" href="style.css">


    <!-- Ajoutez cela à la fin de votre body, avant vos autres scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <style>


        .active {
            font-weight: bold;
            color: #1e52a8;
        }




        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        h2 {
            color: #1e52a8;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #1e52a8;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #1e52a8;
            color: #ffffff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-edit, .btn-delete {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .btn-edit i, .btn-delete i {
            font-size: 18px;
        }

        .btn-edit i {
            color: #1e52a8;
        }

        .btn-delete i {
            color: #ff6666;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        #searchInput {
            width: 60%;
            padding: 10px;
            margin-right: 5px;
        }

        #searchButton {
            padding: 10px;
        }


        .footer {
            poistion: fixed;
        }

    /*this is for btn consulter */

    .btn-view {
    background-color: transparent;
    border: none;
    cursor: pointer;
    }

    .btn-view i {
        font-size: 18px;
        color: #1e52a8;
    }

        /*Fin*/





          /* Ajoutez ce style pour le bouton "Confirmer" */
          #searchButton {
            background-color: #1e52a8; /* Couleur de fond bleu */
            color: #ffffff; /* Couleur du texte blanc */
            border: none; /* Retirer la bordure */
            cursor: pointer; /* Curseur en forme de main */
            padding: 10px 20px; /* Espacement autour du texte */
            transition: background-color 0.3s; /* Transition en douceur pour l'effet de survol */
        }

        #searchButton:hover {
            background-color: #0d2f6b; /* Couleur de fond bleu foncé lors du survol */
        }      




        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        h1 {
            color: #1e52a8;
            text-align: center;
            margin-bottom: 30px;
        }

        #rubriques {
            color: #1e52a8; /* Met l'écriture en bleu */

            justify-content: center;
            font-size: 1.2rem;
        }

        #rubriques div {
            padding: 10px 15px;
            margin: 0 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            border: 2px solid #1e52a8; /* Ajoutez une bordure bleue autour des rubriques */

        }

        #rubriques div i {
        color: #1e52a8; /* Met les icônes en bleu */
        }
        #rubriques div:hover {
            background-color: #1e52a8;
            color: #ffffff;
        }

        .active {
            background-color: #1e52a8;
            color: #ffffff;
        }

        #rubriques div:hover i {
            color: #ffffff; /* Met les icônes en blanc lors du survol */
        }

        .active i {
            color: #ffffff; /* Met les icônes en blanc lors de la sélection */
        }
        #rubriques .active i {
    color: #ffffff;
        }


        .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        display: none;
    }

    .popup {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        width: 80%;
        max-width: 400px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .popup h2 {
        margin-top: 0;
    }

    .popup p {
        margin-bottom: 20px;
    }

    .popup select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
    }

    .popup button {
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin: 5px;
    }

    .popup button.confirm {
        background-color: #1e52a8;
        color: white;
    }

    .popup button.confirm:hover {
        background-color: #0d3d7a;
    }

    .popup button.cancel {
        background-color: #ff6666;
        color: white;
    }

    .popup button.cancel:hover {
        background-color: #e60000;
    }



    
.pops {

    position: fixed; /* Positionnement fixe par rapport à la fenêtre */
    top: 0; /* Positionnement en haut de la fenêtre */
    left: 0; /* Positionnement à gauche de la fenêtre */
    z-index: 1000; /* Place le pop-up au-dessus d'autres éléments */
}

.pops-content {
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  align-items: center;
  text-align: center;
  position: absolute;
  display:none;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1000;
}

/* Style spécifique pour le conteneur du document PDF de la vignette */
/* Style spécifique pour le conteneur du document PDF de la vignette */
.vignette-pdf button#confirm {
  position: absolute; /* Positionnement absolu par rapport au conteneur div */
  left: 0; /* Centré horizontalement */
  bottom: 0; /* Positionnement en bas du conteneur */
  width: 100%; /* Largeur du bouton à 100% de la largeur du conteneur */
  border-radius: 0; /* Supprimer les coins arrondis pour une meilleure apparence */
}

/* Style spécifique pour le conteneur du document PDF de la visite technique */
.visite-pdf button#confirm {
  position: absolute; /* Positionnement absolu par rapport au conteneur div */
  left: 0; /* Centré horizontalement */
  bottom: 0; /* Positionnement en bas du conteneur */
  width: 100%; /* Largeur du bouton à 100% de la largeur du conteneur */
  border-radius: 0; /* Supprimer les coins arrondis pour une meilleure apparence */
}

.close-button-wrapper {
  left:0;
  width: 55%; /* Définir la largeur pour correspondre à la largeur de l'élément iframe */
  position: relative; /* Positionnement relatif pour permettre un positionnement absolu des éléments enfants */
  margin: auto;
  margin-top: 35px;
  background-color: #green;

}

#confirm {
    height: 40px;
    background-color: green;
    color: #fff;
}

#confirm:hover {
    height: 40px;
    background-color: black;
    color: #fff;
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


setTimeout(function() {
    document.getElementById("loading-spinner").style.display = "none"; // Cacher le spinner après 2 secondes
}, 1000);

</script>



<div>
    <br>
    <br>
    <br>
    <br>
</div>
       
<div class="client-header">
  <h1 class="text-center mb-5 interactive client-text"><i class="fas fa-user"></i> Compte Client</h1>
</div>



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



    <div class="container">
        <div id="rubriques" class="d-flex">
            <div id="mesDevis" class="mr-4"><i class="fas fa-file-invoice"></i> Mes Devis</div>
            <div id="mesSouscriptions" class="mr-4"><i class="fas fa-file-signature"></i>  Mes Souscriptions</div>
            <div id="mesEcheances" class="mr-4"><i class="fas fa-calendar-alt"></i>   Mes Échéances</div>
            <div id="gererCompte" class="mr-4" onclick="window.location.href='UserSettings'"><i class="fas fa-user-cog"></i>  Gérer compte personnel</div>
            <!-- Bouton de retour -->
            <button class="retour" onclick="window.history.back();" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</button>
        </div>

        <div id="tableau" class="mt-4">
            <!-- Le contenu du tableau sera généré dynamiquement ici -->
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
        const rubriques = document.getElementById("rubriques");
        const tableau = document.getElementById("tableau");

        rubriques.addEventListener("click", function (event) {
            const target = event.target;

            if (target.id === "mesDevis" || target.id === "mesSouscriptions" || target.id === "mesEcheances") {
                const activeRubrique = document.querySelector(".active");
                if (activeRubrique) {
                    activeRubrique.classList.remove("active");
                }
                target.classList.add("active");
                updateTableau(target.id);
            }
        });



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

var url='http://localhost:9090/cldevishist';
var client= new HttpClient();



function CloseIt(x) {
    document.getElementById('pops-content'+x).style.display='none';
}

function Show(x){
    document.getElementById('pops-content'+x).style.display='block';
}



        function updateTableau(rubrique) {
            let html = "";
            switch (rubrique) {
                case "mesDevis":
                    client.get({"dv_usern":"<?php echo e(session()->get('user')); ?>"},url, function (response) {

                        var resp=JSON.parse(response);

                        console.log(resp);
                        var rows = '<table class="table"><thead><tr><th>Date</th><th>Formule de garantie</th><th>Montant</th><th>Devis PDF</th><th>Action</th></tr></thead><tbody>';

                        for (var i=0;i<resp.length;i++) {

                            rows =rows+"<tr><td>"+resp[i]['date']+"</td><td>"+resp[i]['pack']+"</td><td>"+resp[i]['money']+" TND </td><td><a href='#' onClick='Show("+i+")'>Consulter <i class='fas fa-eye'></i> </a>  </td> <td><a href='#' onClick='deleteDevis("+i+")'><i class='fas fa-trash-alt'></i></a> </td></tr>   <div id='pops-content"+i+"' class='pops-content visite-pdf'><iframe height='700' width='800' src='data:application/pdf;base64,"+resp[i]['devis_doc']+"' ></iframe><div class='close-button-wrapper'>        <button id='confirm' onClick='CloseIt("+i+");'>Close</button></div></div>"; // Ajout de l'icône de suppression
                        }

                        rows = rows + "</tbody></table>";
                        
                        document.getElementById("tableau").innerHTML = rows;
                    });
                    break;
                case "mesSouscriptions":
                    var url2='http://localhost:9090/clsubstats';
                    client.get({"sub_usern":"<?php echo e(session()->get('user')); ?>"},url2, function (response) {

var resp=JSON.parse(response);

console.log(resp);
var rows = '<table class="table"><thead><tr><th>N° Contrat</th><th>Date d\'effet</th><th>Date de fin</th><th>Contrat Assurance PDF</th></tr></thead><tbody>';

for (var i=0;i<resp.length;i++) {

    rows =rows+"<tr><td>"+resp[i]['sub_id']+"</td><td>"+resp[i]['effect_date']+"</td><td>"+resp[i]['deadline']+"</td><td><a href='#' onClick='Show("+i+")'>Consulter <i class='fas fa-eye'></i> </a>  </td></tr>   <div id='pops-content"+i+"' class='pops-content visite-pdf'><iframe height='700' width='800' src='data:application/pdf;base64,"+resp[i]['contract']+"' ></iframe><div class='close-button-wrapper'>        <button id='confirm' onClick='CloseIt("+i+");'>Close</button></div></div>";
}

rows = rows + "</tbody></table>";

document.getElementById("tableau").innerHTML = rows;
});
                
                    break;

                case "mesEcheances":
                    var url3='http://localhost:9090/cldlstats';
                    client.get({"dl_usern":"<?php echo e(session()->get('user')); ?>"},url3, function (response) {

var resp=JSON.parse(response);

console.log(resp);
var rows = '<table class="table"><thead><tr><th>N° Contrat</th><th>Produit</th><th>Période</th><th>Montant restant</th><th>Montant total</th><th>Action</th></tr></thead><tbody>';

for (var i=0;i<resp.length;i++) {

    rows =rows+"<tr><td>"+resp[i]['contract_num']+"</td><td>"+resp[i]['product']+"</td><td>"+resp[i]['start_date']+" To "+resp[i]['end_date']+"</td><td>"+resp[i]['left_amount']+"</td><td>"+resp[i]['total_amount']+"</td>";
    if (resp[i]['state']=="Waiting documents submission") {
        rows = rows + "<td><a href='reupload/"+resp[i]['contract_num']+"'>Upload Documents</a></td>";
    }
    else if (resp[i]['state']=="Not Paid"){
        rows = rows + "<td>Not Paid</td>";
    }
    else {
        rows = rows + "<td>Completed</td>";
    }
}

rows = rows + "</tbody></table>";

document.getElementById("tableau").innerHTML = rows;
});
                    break;


                    default:
                    html = '<h2><i class="fas fa-hand-pointer"></i> Veuillez sélectionner une rubrique</h2>';
                    break;


            }
        
        }
        updateTableau(""); // Affiche le texte par défaut au chargement de la page


    function deleteDevis(i) {
    var confirmation = confirm("Voulez-vous confirmer la suppression du devis ?");

    if (confirmation) {
        var url4='http://localhost:9090/cldevisdel';
                    client.get({"devis_id":i},url4, function (response) {

                        window.location.href='ClientTB';
                    });
        // Continuez avec la suppression du devis
        // Vous devrez remplir cette partie avec le code nécessaire pour supprimer le devis
    }
}


    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/ClientTB.blade.php ENDPATH**/ ?>