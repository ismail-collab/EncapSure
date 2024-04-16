<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">

    <title>Gestion des devis clients</title>
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


        .pops-content {
  /* Ajoutez les styles suivants pour centrer le contenu et ajouter une position relative */
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

        #confirm {
            height: 40px;
            width: 55%;
            background-color: green;
            color: #fff;
        }

        #confirm:hover {
            height: 40px;
            background-color: black;
            color: #fff;
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



        <div class="client-header">
            <h1 class="text-center mb-5 interactive client-text"> <i class="fas fa-file-invoice"></i> Consulter devis clients</h1>
        </div>


        <div class="search-container">

            <div class="search-container">
            <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Rechercher...">
                    <button class="validate" id="searchButton" onclick="searchFunction()"><i class="fas fa-search"></i> Confirmer</button>
                    <button class="retour" onclick="window.history.back();" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</button>
            </div>

        </div>

        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du client</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Devis PDF</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php  $dev=$DEVIS['DEVIS']; for ($i=0;$i<count($dev);$i++) { $thisD = $dev[$i]->devis_id; ?>
                <tr>
                    <td><?php echo e($dev[$i]->devis_id); ?></td>
                    <td><?php echo e($dev[$i]->client_firstname); ?>  <?php echo e($dev[$i]->client_lastname); ?></td>
                    <td><?php echo e($dev[$i]->email); ?></td>
                    <td><?php echo e($dev[$i]->phone); ?></td>
                    <td><a href="DownDFiles/<?php echo e($thisD); ?>">Download</a></td>
                    <div id='pops-content<?php echo e($dev[$i]->devis_id); ?>' class='pops-content visite-pdf'>
                        <iframe height='700' width='800' src='data:application/pdf;base64,<?php echo e($dev[$i]->devis_doc); ?>' ></iframe>
                        <div class='close-button-wrapper'>    
                            <button id='confirm' onClick='CloseIt(<?php echo e($dev[$i]->devis_id); ?>);'>Close</button>
                        </div>
                    </div>     
<td>
    <button class="btn-view" onClick="Show(<?php echo e($dev[$i]->devis_id); ?>)"><i class="fas fa-eye"></i></button>             
    <!-- <button class="btn-edit" onclick=""><i class="fas fa-edit"></i></button>-->
    <button class="btn-delete" onClick="Delete(<?php echo e($dev[$i]->devis_id); ?>)"><i class="fas fa-trash-alt"></i></button> 
</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>



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
        // (fonctions existantes inchangées)

        // Exemple de données pour remplir le tableau
        const data = [
    {
        id: 1,
        clientName: "Jean Dupont",
        email: "jean.dupont@email.com",
        quoteDate: "2023-04-01",
        abonnement: "Sécurité",
        pdfLink: "url_devis_pdf_jean_dupont",
    },
    {
        id: 2,
        clientName: "Marie Martin",
        email: "marie.martin@email.com",
        quoteDate: "2023-04-02",
        abonnement: "Sécurité+",
        pdfLink: "url_devis_pdf_marie_martin",
    },
];

function CloseIt(x) {
    document.getElementById('pops-content'+x).style.display='none';
}

function Show(x){
    document.getElementById('pops-content'+x).style.display='block';
}


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

var url='http://localhost:9090/devisdel';
var client= new HttpClient();
//see 3andou admin function delete
// narch awel mara nraha ; fel ui's mandoch ; /7atythom el kol melouel delete w see w update ema baed tfehmna na7iwhom ; 


function Delete(x) {

    client.get({"devis_id":x},url, function (response){

        console.log(response);
        window.location.href="GestionDevis";

    });

}


        
        const tableBody = document.querySelector("tbody");

        for (const row of data) {
            const tr = document.createElement("tr");




tableBody.appendChild(tr);
    }

    function searchFunction() {
    // Récupérer la valeur de recherche
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("dataTable");
    tr = table.getElementsByTagName("tr");

    // Boucler sur toutes les lignes de tableau et cacher celles qui ne correspondent pas à la recherche
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (var j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}


    function editFunction(id) {
        // Fonction d'édition à implémenter
    }

    function deleteFunction(id) {
        // Fonction de suppression à implémenter
    }



</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/GestionDevis.blade.php ENDPATH**/ ?>