<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">
<title>Vérifier Document Client</title>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="Clstyle.css">


<link rel="stylesheet" href="style.css">

<script type="text/javascript" src="/jquery/jquery.js"></script>


<!-- Ajoutez cela à la fin de votre body, avant vos autres scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>

    
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

/* old version table */

/*
    table {
        width: 98%;
        margin: 4% auto;
        border-collapse: collapse;
    }

    th, td {
        text-align: center;
        padding: 4px;
        border: 1px solid #000;
        text-align: left;
    }

    th {
        background-color: #1e52a8;
        color: white;
    }

    td button {
        padding: 4px 6px;
        font-size: 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        background-color: #1e52a8;
        color: white;
    }
*/

/* fin old version table */ 




/*New Css for the table*/ 
/*
    table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table th, table td {
        
    
            border: 1px solid #1e52a8;
            font-size: 14px;
            width: 300px;
            padding: 10px;
            text-align: left;
            white-space: nowrap;

        }

        table th {
            background-color: #1e52a8;
            color: #ffffff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

*/
/* Fin new css for the table */ 
    

    td button:hover {
        background-color: #0d3d7a;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
        display: none;
    }

    .motif {
        width:100%;
    }

    .bons {
        display:flex;
        margin-left: 1%;
        margin-top: 8%;
        position: absolute;

        
    }

    .bons button {
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin: 5px;
    }

    .bons button.confirm {
        background-color: #1e52a8;
        color: white;
    }

    .bons button.confirm:hover {
        background-color: #0d3d7a;
    }

    .bons button.cancel {
        background-color: #ff6666;
        color: white;
    }

    .bons button.cancel:hover {
        background-color: #e60000;
    }

    .popup {

        background-color: #ffffff;
        padding: 40px;
        border-radius: 10px;
        width: 80%;
        height: 220px;
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

    .navbar {
            background-color: #1e52a8;
        }
        
        .navbar-brand,
        .navbar-nav .nav-link {
            color: #ffffff;
        }

        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 20px;
        }



/* CSS ajoutée pour les btn */


  .retour .confirmer{
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin: 5px;
    }


    .retour {
        background-color: #BEBEBE;
        color: #000000;
        
    }

    .retour:hover {
    background-color: #D3D3D3;
}

.confirmer {
        background-color: #1e52a8;
        color: white;
        height: 45px;
        width: 115px;
        border-radius: 5px;
        border: none;
    }

    .confirmer:hover {
        background-color: #0d3d7a;
    }

    .validate {
        background-color: #1e52a8;

        display:inline;
        color: white;
    }

    .validate:hover {
        background-color: #0d3d7a;
    }





.reject {
        background-color: #ff6666;
        color: white;

        display:inline;
    }

.reject:hover {
        background-color: #e60000;
    }

/* fin css pour les btn */


/* Debut CSS pour recherche par filtre */
.search-container {
    display: flex;
    justify-content: center;
    align-items: center; /* Ajouté pour aligner les éléments verticalement */
    margin-bottom: 20px;
}

#searchInput {
    width: 60%;
    padding: 10px;
    margin-top: 10px; /* Ajoutez une marge en haut pour déplacer l'input vers le bas */
    margin-right: 5px;
    border: 1px solid; /* Ajoute une bordure */
}



/* Fin CSS pour recherche par filtre */


/*CSS ajouter pour l'affichage de page PDF*/ 

.pops {
    /* Ajoutez vos autres propriétés ici */
    position: fixed; /* Positionnement fixe par rapport à la fenêtre */
    top: 0; /* Positionnement en haut de la fenêtre */
    left: 0; /* Positionnement à gauche de la fenêtre */
    z-index: 1000; /* Place le pop-up au-dessus d'autres éléments */
}

.pops-content {
  /* Ajoutez les styles suivants pour centrer le contenu et ajouter une position relative */
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
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
  width: 750px; /* Définir la largeur pour correspondre à la largeur de l'élément iframe */
  position: relative; /* Positionnement relatif pour permettre un positionnement absolu des éléments enfants */
}

/*Fin CSS pour la page PDF*/ 


</style>
</head>
<body>

<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notificationModalLabel"><i class="fas fa-bell" style="color: #1e52a8;"></i> Notification</h5>
        <button  class="close" data-dismiss="modal" aria-label="Close">
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
    <br>
    <br>
</div>

<!-- Contenu principal -->
<div class="content">

 <div class="container">


    <div class="client-header">
        <h1 class="text-center mb-5 interactive client-text"> <i class="fas fa-search"></i> Vérifier Document Clients</h1>
    </div>

<!-- ajout de recherche par filtre -->
    <div class="search-container">
         <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Rechercher...">
        <button id="searchButton" class="validate" onclick="searchFunction()"><i class="fas fa-search"></i> Confirmer</button>
        <button onclick="window.history.back();" class="retour"><i class="fas fa-arrow-left"></i> Retour</button> 
    </div>
<!-- Fin recherche par filtre -->


        <table>
            <thead>
                <tr>


<!--

                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>E-mail</th>
-->

                    <th>N° Contrat</th>

<!--
                    <th>N° quittance</th>
-->

                    <th>Période</th>
                    <th>Montant</th>
                    <th>Quittance de vignette</th>
                    <th>Quittance de visite technique</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
        
            <?php $__currentLoopData = $DLS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>

<!--
                    <td><?php echo e($dl->client_lastname); ?></td>
                    <td><?php echo e($dl->client_firstname); ?></td>
                    <td><?php echo e($dl->client_email); ?></td>
-->
                    <td><?php echo e($dl->contract_num); ?></td>
<!--
                    <td><?php echo e($dl->receipt); ?></td>
-->
                    <td><?php echo e($dl->start_date); ?> Au <?php echo e($dl->end_date); ?></td>
                    <td><?php echo e($dl->left_amount); ?></td>

                    <?php if ($dl->state=="Waiting for documents upload" || $dl->state=="Not Paid" || $dl->state=="Waiting for payment" || $dl->state=="Waiting documents submission") { ?>

                        <td> No document : <?php echo e($dl->state); ?> </td>
                        <td> No document : <?php echo e($dl->state); ?> </td>
                        <td><?php echo e($dl->state); ?></td>


                    <?php } else if ($dl->state=="Completed") { ?>


                        <td>
                        <a href="#" onClick="ShowPOPS(<?php echo e($dl->contract_num); ?>);" id="vig_view"><i class="fas fa-eye"></i> View</a>
<div id="pops<?php echo e($dl->contract_num); ?>" class="pops">
              
    <div class="pops-content vignette-pdf">
        <iframe height="800" width="800" src="data:application/pdf;base64,<?php echo e($dl->vignette); ?>" ></iframe>
        <div class="close-button-wrapper">
            <button  id="confirm" onClick="ClosePOPS(<?php echo e($dl->contract_num); ?>);">Close</button>
        </div>
    </div>      
</div>
                    </td>
                    <td>
                        <a href="#" onClick="ShowPOPS(<?php echo e($dl->receipt); ?>);" id="tv_view"><i class="fas fa-eye"></i> View</a>
<div id="pops<?php echo e($dl->receipt); ?>" class="pops">

<div class="pops-content visite-pdf">
    <iframe height="800" width="800" src="data:application/pdf;base64,<?php echo e($dl->tech_visit); ?>" ></iframe>
     <div class="close-button-wrapper">
        <button id="confirm" onClick="ClosePOPS(<?php echo e($dl->receipt); ?>);">Close</button>
     </div>
</div>
            </div>
                    </td>
                    <td><?php echo e($dl->state); ?></td>
                    
                    <?php } else { ?>

                    <td>
                    <a href="#" onClick="ShowPOPS(<?php echo e($dl->contract_num); ?>);" id="vig_view"><i class="fas fa-eye"></i> View</a>
<div id="pops<?php echo e($dl->contract_num); ?>" class="pops">
              
    <div class="pops-content vignette-pdf">
        <iframe height="800" width="800" src="data:application/pdf;base64,<?php echo e($dl->vignette); ?>" ></iframe>
        <div class="close-button-wrapper">
            <button  id="confirm" onClick="ClosePOPS(<?php echo e($dl->contract_num); ?>);">Close</button>
        </div>
    </div>
             
</div>

<div id="THEBTNS<?php echo e($dl->receipt); ?>">
    <button class="validate" onClick="ValidVig(<?php echo e($dl->receipt); ?>);" >Valider</button>
    <button class="reject" onClick="ShowOV('ov<?php echo e($dl->receipt); ?>');" >Rejeter</button>
</div>
                    </td>
                    <td>
                        <a href="#" onClick="ShowPOPS(<?php echo e($dl->receipt); ?>);" id="tv_view"><i class="fas fa-eye"></i> View</a>

<div id="pops<?php echo e($dl->receipt); ?>" class="pops">

<div class="pops-content visite-pdf">
    <iframe height="800" width="800" src="data:application/pdf;base64,<?php echo e($dl->tech_visit); ?>" ></iframe>
     <div class="close-button-wrapper">
        <button id="confirm" onClick="ClosePOPS(<?php echo e($dl->receipt); ?>);">Close</button>
     </div>
</div>


    </div>

        <div id="ov<?php echo e($dl->receipt); ?>" class="overlay">
            <div class="popup">
                <div>
                <h3>Motif de rejet</h3>
                <select name="motif" class="motif" id="reason<?php echo e($dl->receipt); ?>">
                    <option value="">Sélectionner un motif</option>
                    <option value="documents_flous">Documents flous</option>
                    <option value="documents_non_valides">Documents non valides</option>
                    <option value="document_expire">Document expiré</option>
                </select>

                </div>

            </div>
            <div class="bons">
                <button class="confirm" onClick="RejectVig(<?php echo e($dl->receipt); ?>);">Confirmer</button>
                <button class="cancel" onClick="CloseOV('ov<?php echo e($dl->receipt); ?>')">Annuler</button>
                </div>
        </div>


        <div id="ov<?php echo e($dl->receipt); ?>2" class="overlay">
            <div class="popup">
                <div>
                <h3>Motif de rejet</h3>
                <select name="motif" class="motif" id="reason<?php echo e($dl->receipt); ?>2">
                    <option value="">Sélectionner un motif</option>
                    <option value="documents_flous">Documents flous</option>
                    <option value="documents_non_valides">Documents non valides</option>
                    <option value="document_expire">Document expiré</option>
                </select>
                </div>

            </div>
                <div class="bons">
                <button class="confirm" onClick="RejectTech(<?php echo e($dl->receipt); ?>);">Confirmer</button>
                <button class="cancel" onClick="CloseOV('ov<?php echo e($dl->receipt); ?>2')">Annuler</button>

            </div>
            </div>

        </div>
        <div id="THEBTNS<?php echo e($dl->receipt); ?>2">
                        <button class="validate" onClick="ValidTech(<?php echo e($dl->receipt); ?>);" >Valider</button>
                        <button class="reject" onClick="ShowOV('ov<?php echo e($dl->receipt); ?>2');"  >Rejeter</button>
                    </div>
                    </td>
                    <td><?php echo e($dl->state); ?></td>
                    
            
                    <?php } ?>
                </tr>
  
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            
        </table>



    </div>
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
function searchFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementsByTagName("table")[0];
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>


<script>

    const validateButtons = document.querySelectorAll('.validate');
    const rejectButtons = document.querySelectorAll('.reject');
    const overlay = document.querySelector('.overlay');
    const confirmBtn = document.querySelector('.confirm');
    const cancelBtn = document.querySelector('.cancel');
    var poptxt = document.getElementById('pop_text');

    function ShowPOPS (x){
        var pops = document.getElementById('pops'+x);
        pops.style.display="block";

    }

    function ClosePOPS (x){
        var pops = document.getElementById('pops'+x);
        pops.style.display="none";

    }
    
    var confirm = document.getElementById('confirm');
    var tv = document.getElementById('tv_view');
    var vig = document.getElementById('vig_view');
    var tv_valid = document.getElementById('tv_valid');
    var vig_valid = document.getElementById('vig_valid');
    var tv_reject = document.getElementById('tv_reject');
    var vig_reject = document.getElementById('vig_reject');
    var reject_confirm = document.getElementById('reject_confirm');
    var checked = 0;
    var currentRow;
    var reasonTech="";
    var reasonVig="";
    var reason="";
    var currentRec="";
    var doc_location;

    
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

var theurl='http://localhost:9090/agenttask';
var client= new HttpClient();



//client.get(Data,theurl, function(response) {});

function Decide() {
    if (checked==2 && reasonVig=="valid" && reasonTech=="valid") {
        return "YES";
    }
    else {
        return "NO";
    }
}

function ValidVig(x) {

    console.log('IM HERE IN VIG');
    document.getElementById('ov'+x).style.display='none';
    document.getElementById('THEBTNS'+x).style.display='none';

    if (currentRec==x) {
        checked++;
        reasonVig="valid";
    }

    else {
        checked=1;
        currentRec=x;
        reasonVig="valid";
    }
    

    if (checked==2 && reasonVig!="" && reasonTech!="") {
       
        client.get({"receipt":currentRec,"reason_vig":reasonVig,"reason_tech":reasonTech,"decision":Decide()},theurl, function(response) {});

  
    }
}


function ValidTech(x) {

    console.log('IM HERE IN TECH');
    document.getElementById('ov'+x+'2').style.display='none';
    document.getElementById('THEBTNS'+x+'2').style.display='none';

if (currentRec==x) {
    checked++;
    reasonTech="valid";
}

else {
    checked=1;
    currentRec=x;
    reasonTech="valid";
}


if (checked==2 && reasonVig!="" && reasonTech!="") {
   
    client.get({"receipt":currentRec,"reason_vig":reasonVig,"reason_tech":reasonTech,"decision":Decide()},theurl, function(response) {});

 
 }
}



















function RejectVig(x) {
    console.log('IM HERE IN VIG');
    document.getElementById('ov'+x).style.display='none';
    document.getElementById('THEBTNS'+x).style.display='none';

if (currentRec==x) {
    checked++;
    reasonVig=document.getElementById('reason'+x).value;
    console.log(reasonVig);
}

else {
    checked=1;
    currentRec=x;
    reasonVig=document.getElementById('reason'+x).value;
    console.log(reasonVig);
}


if (checked==2 && reasonVig!="" && reasonTech!="") {
   
    console.log('reason vig : '+reasonVig+' / reason Tech : '+reasonTech)

    client.get({"receipt":currentRec,"reason_vig":reasonVig,"reason_tech":reasonTech,"decision":Decide()},theurl, function(response) {});

    window.location.reload();
  }
}






function RejectTech(x) {

    console.log('IM HERE IN TECH');
    document.getElementById('ov'+x+'2').style.display='none';
    document.getElementById('THEBTNS'+x+'2').style.display='none';

if (currentRec==x) {
    checked++;
    reasonTech=document.getElementById('reason'+x+'2').value;
    console.log(reasonTech);
}

else {
    checked=1;
    currentRec=x;
    reasonTech=document.getElementById('reason'+x+'2').value;
    console.log(reasonTech);
}


if (checked==2 && reasonVig!="" && reasonTech!="") {
   
    console.log('reason vig : '+reasonVig+' / reason Tech : '+reasonTech)

    client.get({"receipt":currentRec,"reason_vig":reasonVig,"reason_tech":reasonTech,"decision":Decide()},theurl, function(response) {});
 
    window.location.reload();

  }
}
    function ShowOV(x) {
        var ov = document.getElementById(x);
        ov.style.display = 'flex';
    }

    function CloseOV(x) {
        var ov = document.getElementById(x);
        ov.style.display = 'none';
    }



</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/AgentHome.blade.php ENDPATH**/ ?>