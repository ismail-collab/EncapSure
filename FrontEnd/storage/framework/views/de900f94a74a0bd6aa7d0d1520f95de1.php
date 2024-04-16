<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.8.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Devis Home Page</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

    button[type="submit"] {
        background-color: #008000;
    }

    button[type="submit"]:hover {
        background-color: #ffffff;
    }

    button[type="reset"] {
        background-color: #ff6666;
    }

    button[type="reset"]:hover {
        background-color: #ffffff
    }

    button[type="button"] {
        background-color: #ff6666;
    }

    button[type="button"]:hover {
        background-color: #ffffff;
    }
</style>


</head>
<body>
  

<!--
<h1> Vechile Info </h1>
<form action="DevisVI" method="POST" >
    <?php echo csrf_field(); ?>
    <div>
    <span > Marque : </span>
    <input type="text" name="marque" required>
    </div>
    <div>
    <span > Model : </span>
    <input type="text" name="model" required>
    </div>
    <div>
    <span > Valeur : </span>
    <input type="text" name="value" required>
    </div>
    <div>
    <span > N° d'immatriculation : </span>
    <input type="text" name="immat" required>
    </div>
    <div>
    <span > Serie : </span>
    <input type="text" name="serie" required>
    </div>
    <div>
    <span > Date de mise en circulation : </span>
    <input type="date" name="circ_date" required>
    </div>
    <div>
    <span > Prénom : </span>
    <input type="text" name="cl_fn" required>
    </div>
    <div>
    <span > Nom : </span>
    <input type="text" name="cl_ln" required>
    </div>
    <div>
    <span > CIN : </span>
    <input type="text" name="cin" required>
    </div>
    <div>
    <span > Mobile : </span>
    <input type="text" name="phone" required>
    </div>
    <div>
    <span > Email : </span>
    <input type="text" name="email" required>
    </div>
    <div>
    <span > Adresse : </span>
    <input type="text" name="adr" required>
    </div>
    <div>
    <div>
    <span > Pack : </span>
    <input type="radio" name="pack" value="Security"> Pack Security
    <input type="radio" name="pack" value="Security+"> Pack Security+
    <input type="radio" name="pack" value="Serenity"> Pack Serenity
    <input type="radio" name="pack" value="SecuritySuper"> Pack Security Super
    </div>
    <button type="submit">Submit</button>
    </div>
    <div>
    <button type="reset">Reset</button>
    </div>

</form>
-->

<div class="container">
    <h2>Info véhicule</h2>
    <form action="DevisVI" method="POST" id="vehicle-form">
    <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="marque">Marque :</label>
            <input type="text" name="marque" class="form-control">
        </div>

        <div class="form-group">
            <label for="model">Modèle :</label>
            <input type="text" name="model" class="form-control">
        </div>

        <div class="form-group">
            <label for="value">Valeur :</label>
            <input type="text" name="value" class="form-control">
        </div>

        <div class="form-group">
            <label for="immat">Numéro d'immatriculation :</label>
            <input type="text" name="immat" class="form-control">
        </div>

        <div class="form-group">
            <label for="serie">Série :</label>
            <input type="text" name="serie" class="form-control">
        </div>

        <div class="form-group">
            <label for="circ_date">Date de mise en circulation :</label>
            <input type="date" name="circ_date" class="form-control">
        </div>

        <div class="form-group">
            <label for="cl_fn">Prénom :</label>
            <input type="text" name="cl_fn" class="form-control">
        </div>

        <div class="form-group">
            <label for="cl_ln">Nom :</label>
            <input type="text" name="cl_ln" class="form-control">
        </div>

        <div class="form-group">
            <label for="cin">CIN :</label>
            <input type="text" name="cin" class="form-control">
        </div>

        <div class="form-group">
            <label for="phone">Mobile :</label>
            <input type="tel" name="phone" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="adr">Adresse :</label>
            <input type="text" name="adr" class="form-control">
        </div>

        <div class="form-group">
            <label>Packs de sécurité :</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pack" id="packSecurity" value="packSecurity" checked>
                <label class="form-check-label" for="packSecurity">Pack Security - Description du pack Security</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pack" id="packSecurityPlus" value="packSecurityPlus">
                <label class="form-check-label" for="packSecurityPlus">Pack Security+ - Description du pack Security+</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pack" id="packSerenity" value="packSerenity">
                <label class="form-check-label" for="packSerenity">Pack Serenity - Description du pack Serenity</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pack" id="packSecuritySuper" value="packSecuritySuper">
                <label class="form-check-label" for="packSecuritySuper">Pack Security Super - Description du pack Security Super</label>
            </div>

        </div>


        <button type="button" class="btn" onclick="goBack()">
            <i class="fas fa-arrow-left"></i> Retour
        </button>
        <button type="reset" class="btn">
            <i class="fas fa-undo"></i> Réinitialiser
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
    function goBack() {
        window.history.back();
    }
</script>
  
</body>
</html>
<?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/ClientDevisPage.blade.php ENDPATH**/ ?>