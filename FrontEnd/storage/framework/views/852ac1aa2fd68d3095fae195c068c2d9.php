<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.8.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>User Page</title>

  <link rel="stylesheet" href="styles.css" />
<script src="script.js" defer></script>


<title>Interface de paiement</title>
<!-- Add Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



<!-- Debut sidebar.html -->

<!-- Ajoutez les liens vers Bootstrap CSS et Font Awesome icons -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>

.sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        background-color: #1e52a8;
        z-index: 999;
        transition: all 0.3s ease;
    }

    .sidebar ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .sidebar li {
        padding: 20px 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: background-color 0.3s ease;
    }

    .sidebar li:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        font-size: 18px;
        transition: color 0.3s ease;
    }

    .sidebar a:hover {
        color: #0d3d7a;
    }

    .sidebar i {
        margin-right: 10px;
        transition: transform 0.3s ease;
    }

    .sidebar a:hover i {
        transform: scale(1.1);
    }
    

</style>

<!-- Fin sidebare -->


<!-- Custom CSS -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
    }

    .container {
        max-width: 400px;
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

    input[type="text"], input[type="password"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ffffff;
        border-radius: 5px;
    }

    button[type="submit"], button[type="button"] {
        display: block;
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        color: #ffffff;
        font-weight: bold;
        cursor: pointer;
        margin-bottom: 10px;
    }

    button[type="submit"] {
        background-color: #008000;
    }

    button[type="submit"]:hover {
        background-color: #ffffff;
    }

    button[type="button"] {
        background-color: #ff6666;
    }

    button[type="button"]:hover {
        background-color: #ffffff;
    }
    
</style>
  
</head>

<script>

    async function loadSidebar() {
      const response = await fetch('sidebar.html');
      const text = await response.text();
      const parser = new DOMParser();
      const html = parser.parseFromString(text, 'text/html');
      const sidebar = html.querySelector('.sidebar');
      document.body.appendChild(sidebar);
    }
    loadSidebar();

</script>


<body>

<div class="container_progress_bar">
        <div class="steps">
          <span class="circle active">1</span>
          <span class="circle">2</span>
          <span class="circle">3</span>
          <span class="circle">4</span>
          <div class="progress-bar">
            <span class="indicator"></span>
          </div>
        </div>
        <div class="buttons">
          <button id="prev" disabled>Prev</button>
          <button id="next">Next</button>
</div>

<!--
<br>
<br>
<form action="DevisPay" method="POST">
    <?php echo csrf_field(); ?>
    <div>
    <span > Credit Card Number : </span>
    <input type="text" name="ccn" required>
    </div>
    <span > Security Code : </span>
    <input type="text" name="sc" required>
    </div>
    <span > Expires : </span>
    <input type="month" name="exp" required>
    </div>
    <input type="hidden" name="" value="">
    <div>
    <button type="submit">Submit</button>
    </div>

</form> -->

<div class="container">
    <h2><i class="fas fa-credit-card"></i> Paiement</h2>
    <form action="DevisPay" method="POST" id="payment-form">
    <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="ccn">Numéro de carte de crédit :</label>
            <input type="text" id="credit-card-number" name="ccn" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="sc">Code de sécurité :</label>
            <input type="text" id="security-code" name="sc" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="exp">Date d'expiration :</label>
            <input type="month" id="expires" name="exp" class="form-control">
        </div>

        <button type="button" class="btn btn-block" onclick="goBack()">
            <i class="fas fa-arrow-left"></i> Retour
        </button>
        <button type="submit" class="btn btn-block">
            <i class="fas fa-lock"></i> Submit
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

    document.getElementById('payment-form').addEventListener('submit', function(event) {
        event.preventDefault();
    
        const creditCardNumber = document.getElementById('credit-card-number').value.trim();
        const securityCode = document.getElementById('security-code').value.trim();
        const expires = document.getElementById('expires').value.trim();

        if (creditCardNumber === '' || securityCode === '' || expires === '') {
            alert('Veuillez remplir tous les champs.');
        } 
        else {document.getElementById('payment-form').submit();}
    });


document.getElementById('payment-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const creditCardNumber = document.getElementById('credit-card-number').value.trim();
    const securityCode = document.getElementById('security-code').value.trim();
    const expires = document.getElementById('expires').value.trim();

    document.querySelectorAll('.error-message').forEach(el => el.remove());

    let hasErrors = false;

    if (creditCardNumber === '') {
        showError('credit-card-number', 'Le numéro de carte de crédit est obligatoire.');
        hasErrors = true;
    } else if (!/^\d{16}$/.test(creditCardNumber)) {
        showError('credit-card-number', 'Le numéro de carte de crédit doit contenir exactement 16 chiffres.');
        hasErrors = true;
    }

    if (securityCode === '') {
        showError('security-code', 'Le code de sécurité est obligatoire.');
        hasErrors = true;
    } else if (!/^\d{3,4}$/.test(securityCode)) {
        showError('security-code', 'Le code de sécurité doit contenir 3 ou 4 chiffres.');
        hasErrors = true;
    }

    if (expires === '') {
        showError('expires', "La date d'expiration est obligatoire.");
        hasErrors = true;
    }

    else {document.getElementById('payment-form').submit();}

});


function showError(inputId, message) {
    const input = document.getElementById(inputId);
    const errorMessage = document.createElement('div');
    errorMessage.className = 'error-message';
    errorMessage.style.fontSize = '0.8em';
    errorMessage.style.marginTop = '5px';
    errorMessage.style.fontWeight = 'bold'; // Add this line to make the error messages bold
    errorMessage.style.textDecoration = 'underline'; // Ajoutez cette ligne pour souligner le message d'erreur
    errorMessage.style.color = '#ff6666'; // Modifiez cette ligne pour définir la couleur du message d'erreur en #ff6666

    errorMessage.textContent = message;
    input.parentNode.appendChild(errorMessage);
}

</script>




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

var clientPost= new HttpClient();



</script>
  
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/ClientDevisPayPage.blade.php ENDPATH**/ ?>