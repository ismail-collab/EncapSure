<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.8.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">
  <meta name="description" content="">
  <script type="text/javascript" src="/jquery/jquery.js"></script>
  
  
  <title>Client Pick Page</title>
  <!-- Add Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="style.css">


    <!-- Ajoutez cela à la fin de votre body, avant vos autres scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom CSS -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
    }

    .container {
        max-width: 1200px;
        margin: 50px auto;
        padding: 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        border: 1px solid #1e52a8;
        padding: 10px;
        text-align: center;
    }

    .table th {
        background-color: #1e52a8;
        color: white;
    }

    .table tbody tr:nth-child(odd) {
        background-color: #f2f2f2;
    }

    .table tbody tr:hover {
        background-color: #d9e2f3;
    }

    button {
        border: none;
        background-color: #1e52a8;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0d3d7a;
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



<!--

<form action="Pick_To_Adress" method="post">
    <?php echo csrf_field(); ?>
<table>
    <thead>
    <tr>
        <td></td>
        <td>Product</td>
        <td>Contract N°</td>
        <td>Receipt</td>
        <td>Period</td>
        <td>Left Amount</td>
        <td>Total Amount</td>
        
</tr>
</thead>
<tbody>
<tr>
    <?php $i=0 ?>
    <?php $__currentLoopData = $PRODUCT; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
    <td><input type="checkbox" name="recps[<?php echo e($i+=1); ?>]" value="<?php echo e($prod->receipt); ?>-<?php echo e($prod->contract_num); ?>-<?php echo e($prod->left_amount); ?>"></td>
    <td><?php echo e($prod->product); ?></td>
    <td><?php echo e($prod->contract_num); ?></td>
    <td><?php echo e($prod->receipt); ?></td>
    <td><?php echo e($prod->start_date); ?> To <?php echo e($prod->end_date); ?></td>
    <td><?php echo e($prod->left_amount); ?></td>
    <td><?php echo e($prod->total_amount); ?></td>
    
</tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tr>
</tbody>
</table>
<td><button class="pay_btn">Pay</button></td>
</form>

-->



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
  <a href="Home" class="nav-link"><i class="fas fa-user"></i> <?php echo e(session()->get('name')); ?></a>
  <a href="#" class="nav-link nav-link-notification"><i class="fas fa-bell"></i> Notification</a>
  <a href="Logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>


<div class="content">


    <div class="container">

    <div class="client-header">
        <h1 class="text-center mb-5 interactive client-text"> <i class="fas fa-clock"></i> Gestion des échéances contractuelles</h1>
    </div>


<div class="container">
    <form action="Pick_To_Adress" method="post">
    <?php echo csrf_field(); ?>
    <table class="table">
        <thead>
            <tr>
                <th>Sélection</th>
                <th>Produit</th>
                <th>N° Contrat</th>
                <th>Numéro de réception</th>
                <th>Période</th>
                <th>Montant restant</th>
                <th>Montant total</th>
            </tr>
        </thead>
        <tbody>
<tr>
    <?php $i=0 ?>
    <?php $__currentLoopData = $PRODUCT; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if ($prod->left_amount!=0) { ?>
    <tr>
    <td><input type="checkbox" name="recps[<?php echo e($i+=1); ?>]" value="<?php echo e($prod->receipt); ?>-<?php echo e($prod->contract_num); ?>-<?php echo e($prod->left_amount); ?>"></td>
    <td><?php echo e($prod->product); ?></td>
    <td><?php echo e($prod->contract_num); ?></td>
    <td><?php echo e($prod->receipt); ?></td>
    <td><?php echo e($prod->start_date); ?> To <?php echo e($prod->end_date); ?></td>
    <td><?php echo e($prod->left_amount); ?></td>
    <td><?php echo e($prod->total_amount); ?></td>
    
</tr>
<?php } ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tr>
</tbody>
    </table>

    <div>
        <button class="validate d-inline-block mr-2" class="pay_btn" id="payAll"><i class="fas fa-credit-card"></i> Payer</button>
        <button type="reset" onclick="window.history.back();" class="retour d-inline-block"><i class="fas fa-arrow-left"></i> Retour</button>
    </div>

</form>
</div>







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

/* effectuer des requêtes POST et écoute les clics sur les éléments avec
 la classe 'pay_btn', récupérant des informations depuis une ligne de tableau. */
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

var client= new HttpClient();


$(document).ready(function(e) {
        $('.pay_btn').on('click',function() {
            var currentRow = $(this).closest("tr");
            var contract_num = currentRow.find("td:eq(1)").text();
            var receipt = currentRow.find("td:eq(2)").text();
        });
    });


</script>
  
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/ClientPickPage.blade.php ENDPATH**/ ?>