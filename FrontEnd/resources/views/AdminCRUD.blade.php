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
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

h2 {
    color: #1e52a8;
    text-align: center;
    margin-bottom: 20px;
}

/*
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    padding: 10px;
    border: 1px solid #cccccc;
    text-align: center;
}

table th, table td {
    padding: 10px;
    border: 1px solid #cccccc;
    text-align: center;
    color: #ffffff; 
}
*/

.btn-group {
    margin-bottom: 20px;
    display: flex;

}

.btn {
    margin-right: 10px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #ffffff; /* Texte "Type d'utilisateur" en blanc */
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
}, 1000);


</script>



<div>
    <br>
    <br>
    <br>
</div>


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




<!-- Contenu principal -->
<div class="content">

<div class="container">
    
<div class="client-header">
  <h1 class="text-center mb-5 interactive client-text"><i class="fas fa-users-cog"></i> Liste des utilisateurs</h1>
</div>


<div class="search-container">
  <input type="text" id="search-input" placeholder="Rechercher un utilisateur..." onkeyup="filterUsers()">

    <button type="button" class="validate" onclick="filterUsers()"><i class="fas fa-search"></i> Rechercher</button>
    <button type="button" class="retour" onclick="window.history.back();"><i class="fas fa-arrow-left"></i> Retour</button>
</div>

<!--This is some new shit -->
<div id="rubriques" class="d-flex">
    <div id="listeUtilisateurs" class="mr-4"><i class="fas fa-users"></i> Liste des utilisateurs</div>
    <div id="listeClients" class="mr-4"><i class="fas fa-user-tie"></i> Liste des clients</div>
    <div id="listeAgents" class="mr-4"><i class="fas fa-user-secret"></i> Liste des agents</div>
</div>
<!--Fin -->
<br>
    <div class="btn-group">
        <button type="button" class="yes" onclick="addUser()"><i class="fas fa-plus"></i> Ajouter un agent</button>
<!--fel user Controller n7otha thezni lel page ? no -->
       <button type="button" class="yes"  onclick="window.location.href='AdminCRUDaddClient'"><i class="fas fa-plus"></i> Ajouter un client</button> 
    <!--   <button type="button" class="reject" onclick="deleteSelectedClient()"><i class="fas fa-trash"></i> Supprimer Client</button> -->
        <button type="button" class="reject" onclick="deleteSelectedUsers()"><i class="fas fa-trash"></i> Supprimer</button>

    </div>
        

    
    <table id="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Role</th>

                <th>Sélectionner</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($USERS as $user)
        @php if ($user->role!='admin') {
            @endphp
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->lastname}}</td>
            <td>{{$user->firstname}}</td>
            <td>{{$user->role}}</td>
            <td><input type="checkbox" id="pick" name="selection" value="{{$user->username}}"></td>

        </tr>
        @php } @endphp
        @endforeach
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



/*debut js pour activation */
function activateRubrique(rubriqueId) {
    const rubriques = document.querySelectorAll("#rubriques div");

    rubriques.forEach((rubrique) => {
        if (rubrique.id === rubriqueId) {
            rubrique.classList.add("active");
        } else {
            rubrique.classList.remove("active");
        }
    });
}




// Ajout d'un écouteur d'événements pour la rubrique "Liste des utilisateurs"
document.getElementById("listeUtilisateurs").addEventListener("click", function () {
    activateRubrique("listeUtilisateurs");
    showAllUsers();
});

document.getElementById("listeClients").addEventListener("click", function () {
    activateRubrique("listeClients");
    showUsersByRole("client");
});

document.getElementById("listeAgents").addEventListener("click", function () {
    activateRubrique("listeAgents");
    showUsersByRole("agent");
});

// Appel de la fonction activateRubrique() au chargement de la page
document.addEventListener("DOMContentLoaded", function () {
    activateRubrique("listeUtilisateurs");
    showAllUsers();
});

/*fin js pour activation */



    // Ajout d'un écouteur d'événements pour la rubrique "Liste des utilisateurs"
    document.getElementById("listeUtilisateurs").addEventListener("click", function () {
        showAllUsers();
    });



    // Appel de la fonction showAllUsers() au chargement de la page
    document.addEventListener("DOMContentLoaded", function () {
        showAllUsers();
    });


/*debut liste des clients/agents*/ 
document.getElementById("listeClients").addEventListener("click", function () {
        showUsersByRole("client");
    });

    document.getElementById("listeAgents").addEventListener("click", function () {
        showUsersByRole("agent");
    });



    function showUsersByRole(role) {
    const allRows = document.querySelectorAll("#users-table tbody tr");

    allRows.forEach(row => {
        const userRole = row.querySelector("td:nth-child(5)").textContent;

        if (userRole === role) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}



function showAllUsers() {
    const allRows = document.querySelectorAll("#users-table tbody tr");

    allRows.forEach(row => {
        row.style.display = "";
    });
}

document.addEventListener("DOMContentLoaded", function () {
    showAllUsers();
});


/* fin liste des clietns/agents */

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


var theurl='http://localhost:9090/deleteuser';
var client= new HttpClient();
var Data = {} 

    function addUser() {
        window.location.href="Crudadd";
    }

    
    function editUser() {
        alert('Fonctionnalité non implémentée.');
    }
    
    
    function deleteSelectedUsers() {
        const checkboxes = document.getElementsByName('selection');
        const selectedUsers = [];
    
        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedUsers.push({"username":checkboxes[i].value});
            }
        }
    
        if (selectedUsers.length > 0) {
            if (confirm(`Êtes-vous sûr de vouloir supprimer les utilisateurs avec les IDs suivants : ${selectedUsers.join(', ')}?`)) {
     
                console.log(selectedUsers);
                client.get(selectedUsers,theurl, function (response){
                    console.log('Users Deleted'); 
                });
            }
        } else {
            alert('Veuillez sélectionner au moins un utilisateur à supprimer.');
        }
    }

    function updateUserList() {

        const clients = document.getElementsByClassName('client');
        const agents = document.getElementsByClassName('agent');
        
        for (let i = 0; i < clients.length; i++) {
            clients[i].style.display = (userType === 'client') ? '' : 'none';
        }

        for (let i = 0; i < agents.length; i++) {
            agents[i].style.display = (userType === 'agent') ? '' : 'none';
        }
    }

    updateUserList();

// recherche par filtre 
function filterUsers() {
    // Obtenez la valeur de recherche à partir de l'input
    var searchValue = document.getElementById('search-input').value.toUpperCase();

    // Obtenez toutes les lignes de la table
    var tableRows = document.getElementById('users-table').getElementsByTagName('tr');

    // Parcourez toutes les lignes de la table (sauf la première qui est l'en-tête de la table)
    for (var i = 1; i < tableRows.length; i++) {
        var columns = tableRows[i].getElementsByTagName('td');

        // Parcourez toutes les colonnes de chaque ligne (changez 5 en nombre de colonnes que vous voulez chercher)
        var match = false;
        for (var j = 0; j < 5; j++) {
            var cellContent = columns[j].innerHTML.toUpperCase(); // la valeur de chaque cellule

            // Si la cellule contient la valeur de recherche, définir match à vrai et sortir de la boucle
            if (cellContent.includes(searchValue)) {
                match = true;
                break;
            }
        }

        // Si match est vrai, alors la ligne devrait être visible, sinon elle sera cachée
        tableRows[i].style.display = match ? '' : 'none';
    }
}


</script>

</body>
</html>
