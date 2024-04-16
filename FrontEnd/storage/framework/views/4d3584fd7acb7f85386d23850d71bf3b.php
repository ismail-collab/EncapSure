<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.8.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Subscription Page</title>
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
        max-width: 600px;
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

    input[type="text"], input[type="email"], input[type="tel"], input[type="date"] {
        display: block;
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
    }

   button[type="submit"], button[type="reset"], button[type="button"] {
    display: inline-block;
    width: 30%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    color: #ffffff;
    font-weight: bold;
    cursor: pointer;
    margin: 5px;
}

button[type="reset"] {
    background-color: orange;
}

button[type="reset"]:hover {
    background-color: #ff8c00;
}


</style>

</head>
<body>
  
<!--
<h1> Insert info </h1>
<form action="subs_in" method="POST" >
    <?php echo csrf_field(); ?>
    <div>
    <span > nom : </span>
    <input type="text" name="cl_fn" required>
    </div>
    <div>
    <span > prenom : </span>
    <input type="text" name="cl_ln" required>
    </div>
    <div>
    <span > nationalite : </span>
    <input type="text" name="nat" required>
    </div>
    <div>
    <span > date naissance : </span>
    <input type="date" name="bday" required>
    </div>
    <div>
    <span > email : </span>
    <input type="text" name="email" required>
    </div>
    <div>
    <span > phone : </span>
    <input type="text" name="phone" required>
    </div>
    <div>
    <span > cin : </span>
    <input type="text" name="cin" required>
    </div>
    <div>
    <span > delivery adress : </span>
    <input type="text" name="deliv_adr" required>
    </div>
    <fieldset>
    <div>
    <span > delivery type : </span>
    <input type="radio" name="deliv_type" value="agence"> Agence
    <input type="radio" name="deliv_type" value="express"> Livraison Express
    </div>
    </fieldset>
    <div>
    <span > Adress : </span>
    <input type="text" name="adr" required>
    </div>
    <div>
    <span > Fractionnement : </span>
    <input type="text" name="fraction" required>
    </div>
    <div>
    <button type="submit">Submit</button>
    </div>
    <div>
    <button type="reset">Reset</button>
    </div>
</form>  -->


<div class="container">
    <h2>Formulaire de souscription assurance</h2>
    <form action="subs_in" method="POST" id="insurance-form">
    
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="cl_fn" class="form-control">
        </div>
   
<div class="form-group">
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="cl_ln" class="form-control">
</div>

<div class="form-group">
    <label for="nationalite">Nationalité :</label>
    <input type="text" id="nationalite" name="nat" class="form-control">
</div>

<div class="form-group">
    <label for="dateNaissance">Date de naissance :</label>
    <input type="date" id="dateNaissance" name="bday" class="form-control">
</div>

<div class="form-group">
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" class="form-control">
</div>

<div class="form-group">
    <label for="phone">Téléphone :</label>
    <input type="tel" id="phone" name="phone" class="form-control">
</div>

<div class="form-group">
    <label for="cin">CIN :</label>
    <input type="text" id="cin" name="cin" class="form-control">
</div>

<div class="form-group">
    <label for="adresseLivraison">Adresse de livraison :</label>
    <input type="text" id="adresseLivraison" name="deliv_adr" class="form-control">
</div>




        <div class="form-group">
            <label>Type de livraison :</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="deliv_type" id="standardDelivery" value="standard" checked>
                <label class="form-check-label" for="standardDelivery">Livraison Standard</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="deliv_type" id="expressDelivery" value="express">
                <label class="form-check-label" for="expressDelivery">Livraison Express</label>
            </div>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adr" class="form-control">
        </div>

        <div class="form-group">
            <label for="fractionnement">Fractionnement :</label>
            <input type="text" id="fractionnement" name="fraction" class="form-control">
        </div>


<button type="button" class="btn" onclick="goBack()">
    <i class="fas fa-arrow-left"></i> Retour
</button>


<button type="submit" class="btn">
    <i class="fas fa-check"></i> Soumettre
</button>
     
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById('').addEventListener('submit', function(event) {
        event.preventDefault();
        // Ajoutez ici le code pour gérer la soumission du formulaire, par exemple en envoyant les données à un serveur.
        alert('Formulaire soumis');
    });
    
    
    function goBack() {
    window.history.back();
}
</script>

</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/SubscriptionPage.blade.php ENDPATH**/ ?>