<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">

    <title>Gestion des packs de sécurité</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
    <!-- Ajoutez cela à la fin de votre body, avant vos autres scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

        .btn-edit, .btn-delete, .btn-add {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .btn-edit i, .btn-delete i, .btn-add i {
            font-size: 18px;
        }

        .btn-edit i {
            color: #1e52a8;
        }

        .btn-delete i {
            color: #ff6666;
        }

        .btn-add {
            background-color: #1e52a8;
            color: #ffffff;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        .btn-add:hover {
            background-color: #0d2f6b;
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



<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel"><i class="fas fa-check-circle" style="color: #1e52a8;"></i> Suppression réussie</h5>
        <button class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Le pack de sécurité a été supprimé avec succès.
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


<script>

function Delete(x) {
    client.get({"pack_id":x},url, function (response){
        console.log(response);
        // Afficher le modale après la suppression
        $('#successModal').modal('show');
        // Vous pouvez également recharger la page pour mettre à jour les données
        setTimeout(function() {
            window.location.href='GererPack';
        }, 2000);
    });
}


</script>






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
  <a href="HomeAdmin" class="nav-link"><i class="fas fa-user"></i> <?php echo e(session()->get('name')); ?></a>
  <a href="#" class="nav-link nav-link-notification"><i class="fas fa-bell"></i> Notification</a>
  <a href="Logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>


<div>
  <br>
  <br>
  <br>
</div>


<div class="container">

       
<div class="client-header">
  <h1 class="text-center mb-5 interactive client-text"><i class="fas fa-shield-alt"></i> Gérer packs de sécurité</h1>
</div>

<div>
    <button type="button" class="yes" onclick="window.location.href='AjouterPack'">   <i class="fas fa-plus"></i> Ajouter un pack de sécurité </button>
    <button class="retour" onclick="window.history.back();" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</button>
</div>
    
<div class="container">
    <table>
    <thead>
        <tr>
            <th>Pack ID </th>
            <th>Nom du pack</th>
            <th>Prix</th>
            <th>Responsabilité civile</th>
            <th>Assistance 24/7</th>
            <th>Protection juridique</th>
            <th>Garantie dommages</th>
            <th>Vol et incendie</th>
            <th>Assurance tous risques</th>
            <th>Franchise modulable</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    
    <?php $__currentLoopData = $INFOS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($inf['pack_id']); ?></td>
            <td><?php echo e($inf['pack_name']); ?></td>
            <td><?php echo e($inf['price']); ?> TND</td>
    <?php for ($i=1;$i<count($inf)-2;$i++) {
        if ($inf['gr'.$i]!=0) { echo '<td><i class="fas fa-check"></i></td>'; } else { echo '<td>-</td>'; } 
    } ?>
            <td>
                <button class="btn-edit" id="Mod_<?php echo e($inf['pack_id']); ?>" onClick="editPack('<?php echo e($inf['pack_id']); ?>','<?php echo e($inf['pack_name']); ?>','<?php echo e($inf['price']); ?>',<?php   for ($i=1;$i<count($inf)-2;$i++) { if ($i==count($inf)-3) { echo $inf['gr'.$i]; } else { echo  $inf['gr'.$i].','; } }  ?>)"><i class="fas fa-edit"></i></button>
                <button class="btn-delete" id="Del_<?php echo e($inf['pack_id']); ?>" onClick="Delete('<?php echo e($inf['pack_id']); ?>')"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</div>
<br>
<br>
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

<!-- Fin Footer --> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('.btn-add').on('click', function () {
             // Redirige vers une page pour ajouter un nouveau pack de sécurité
        });

        $('.btn-edit').on('click', function () {
            window.location.href='EditPack';
        });

        $('.btn-delete').on('click', function () {
            // Ajoutez ici le code pour supprimer le pack de sécurité sélectionné
        });
    });
</script>



<script>
        $(document).ready(function () {
            $('.btn-add').on('click', function () {
                window.location.href = 'ajouter-pack.html'; // Redirige vers une page pour ajouter un nouveau pack de sécurité
            });



            $('.btn-delete').on('click', function () {
                // Ajoutez ici le code pour supprimer le pack de sécurité sélectionné
                
            });
        });


function editPack(id,name,money,gr1,gr2,gr3,gr4,gr5,gr6,gr7) {

    sessionStorage.clear();
    sessionStorage.setItem('pack_id', id);
    sessionStorage.setItem('packName', name);
    sessionStorage.setItem('price', money);
    sessionStorage.setItem('gr1', gr1);
    sessionStorage.setItem('gr2', gr2);
    sessionStorage.setItem('gr3', gr3);
    sessionStorage.setItem('gr4', gr4);
    sessionStorage.setItem('gr5', gr5);
    sessionStorage.setItem('gr6', gr6);
    sessionStorage.setItem('gr7', gr7);

    window.location.href = 'EditPack';


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

var url='http://localhost:9090/delpack';
var client= new HttpClient();


        function Delete(x) {

            client.get({"pack_id":x},url, function (response){
                console.log(response);
                window.location.href='GererPack';
            });
        }

        function deleteSecurityPack(row) {
            if (confirm('Voulez-vous vraiment supprimer ce pack de sécurité ?')) {
                row.remove();
            }
        }
    </script>

</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/GererPack.blade.php ENDPATH**/ ?>