<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">

    <title>Souscription</title>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="Clstyle.css">
<link rel="stylesheet" href="style.css">

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;

    }

    .container {
        width: 800px;
        height: 600px;
        margin: 2% auto;
        background-color: #1e52a8;
        border-radius: 10px;
        position: relative;
        overflow: hidden;
    }

    .container form {
        width: 800px;
        position: relative;
        background-color: #1e52a8;
        top: 20px;
        margin: 2% auto;

    }

    h4 {
      color:#000;
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

    input[type="text"], input[type="password"], input[type="email"], input[type="tel"], input[type="date"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ffffff;
        border-radius: 5px;
    }

    select {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ffffff;
        border-radius: 5px;
        color: #8f8f8f;
        background-color: #ffffff;
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
  position: absolute;
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
  max-width: 480px;
  width: 100%;
  padding: 60px 40px;
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

#overfail {
  position: absolute;
  align-items: center;
  display:none;
  width: 100%;
  height:100%;
  background: rgba(0, 0, 0, 0.3);

}

#fail {
  position: relative;
  align-items: center;
  text-align:center;
  max-width: 480px;
  width: 100%;
  padding: 60px 40px;
  border-radius: 24px;
  background-color: #fff;
  margin-top: 30%;
  margin-left: 50%;
  opacity: 0;
  transition: all 0.3s ease;
  transform: translate(-50%, -50%) scale(1.2);
}

#fail i {
  font-size: 60px;
  color: #1e52a8;
}

.modal-box i {
  font-size: 60px;
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


/*
  <span>Souscripteur</span>
  <span>Contrat</span>
  <span>Livraison</span>
  <span>Paiment</span>
  <span>Document</span>
  <span>Signature</span>
*/


/* CSS pour centrer les labels*/
.steps .circle:nth-child(1)::before {
  content: "Souscripteur";
}

.steps .circle:nth-child(2)::before {
  content: "Contrat";
}

.steps .circle:nth-child(3)::before {
  content: "Livraison";
}

.steps .circle:nth-child(4)::before {
  content: "Paiement";
}

.steps .circle:nth-child(5)::before {
  content: "Document";
}

.steps .circle:nth-child(6)::before {
  content: "Signature";
}


/*fin CSS pour centrer les labels*/ 



/* pour mettre le process de devis plis pres de progressbar */
.client-text {
  color: white; /* Couleur du texte blanc */
  background-color: #1e52a8; /* Couleur de fond bleu */
  display: inline; /* Affichage en ligne pour aligner le texte avec l'icône */
  padding: 10px; /* Espacement autour du texte */
  margin-bottom: 5px; /* Ajouté pour déplacer le texte vers la progress bar */
}

.client-header {
  display: flex; /* Alignement horizontal de l'icône et du texte */
  justify-content: center; /* Centrer le contenu horizontalement */
  align-items: center; /* Centrer le contenu verticalement */
}

.container_progress_bar {
  margin-top: -10px;
}

/* fin process de devis plis pres de progressbar */


</style>
</head>
<body>



<div id="loading-spinner"></div>

<script>
    
    document.getElementById("loading-spinner").style.display = "flex"; // Afficher le spinner

// Ici, votre code AJAX...

setTimeout(function() {
    document.getElementById("loading-spinner").style.display = "none"; // Cacher le spinner après 2 secondes
}, 1000);</script>





<!-- Sidebar -->
<div class="sidebar">

  <div class="sidebar-logo">
   <a href="Home"> <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="Logo"> </a>

<div class="sidebar-logo-text">EncapSure</div>
<div class="sidebar-line"></div>

</div>


  <div class="sidebar-header">
    <a href="Home">
    <i class="fas fa-user-circle"></i> <?php echo e(session()->get('name')); ?></a>
    </a>

  </div>


  <ul class="list-unstyled components">
    <li></li>


    <li>
      <a href="Home">
       <i class="fas fa-home"></i> Home
      </a>
    </li>

    <li>
      <a href="ClientTB">
        <i class="fas fa-calculator"> </i> Devis
      </a>
    </li>
    <li>
      <a href="ClientTB">
        <i class="fas fa-file-contract"></i> Souscription
      </a>
    </li>

    <li>
      <a href="ClientTB">
        <i class="fas fa-user-cog"></i> Gérer Compte
      </a>
    </li>

    <li>
      <a href="Logout">
        <i class="fas fa-sign-out-alt"></i> Déconnexion
      </a>
    </li>
  </ul>
</div>




<div class="client-header">
<h1 class="text-center mb-5 interactive client-text">Processus de Souscription</h1>
</div>



<!-- New version -->


<div class="container_progress_bar">
  <div class="steps">


    <span class="circle active">
     <i class="fas fa-user"></i>
    </span>


    <span class="circle">
      <i class="fas fa-file-contract"></i>
    </span>


    <span class="circle">
      <i class="fas fa-shipping-fast"></i>
    </span>


    <span class="circle">
      <i class="fas fa-credit-card"></i>
    </span>

    <span class="circle">
    <i class="fas fa-file-upload"></i>
    </span>


        <span class="circle">
      <i class="fas fa-file-signature"></i>
    </span>


    <div class="progress-bar">
      <span class="indicator"></span>
    </div>


  </div>
</div>

<!-- fin new version -->

 


<!--Old version -->
<!--
<div class="container_progress_bar">
<div class="steps">
  <span>Souscripteur</span>
  <span>Contrat</span>
  <span>Livraison</span>
  <span>Paiment</span>
  <span>Document</span>
  <span>Signature</span>
</div>
        <div class="steps">
          <span class="circle active"><i class="fas fa-file-contract"></i></span>
          <span class="circle"><i class="fas fa-file-contract"></i></span>
          <span class="circle"><i class="fas fa-shipping-fast"></i></span>
          <span class="circle"><i class="fas fa-credit-card"></i></span>
          <span class="circle"><i class="fas fa-file-contract"></i></span>
          <span class="circle"><i class="fas fa-file-signature"></i></span>
        <div class="progress-bar">
         <span class="indicator"></span>
        </div>
        </div>
</div>
-->
<!--Fin Old version -->


<div class="container">
    
<form id="SubForm" action="SubProc" method="POST" >
    <?php echo csrf_field(); ?>
    <div class="Forms" id="F1">
    <h2><i class="fas fa-user"></i> Souscripteur</h2>
    <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cl_ln">Nom</label>
                    <input type="text" id="cl_ln" name="cl_ln"  class="form-control" readonly="readonly" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Prénom</label>
                    <input type="text" id="cl_fn" name="cl_fn" class="form-control" readonly="readonly" required>
                </div>
            </div>

            <div class="form-row">
            
                <div class="form-group col-md-6">
                    <label for="email">Email </label>
                    <input type="email" id="email" name="email" class="form-control" readonly="readonly" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="phoneNumber">Mobile</label>
                    <input type="text" id="phoneNumber" name="phone" class="form-control" readonly="readonly" required>
                </div>
            </div>

            <div class="form-row">
            
                <div class="form-group col-md-6">
                    <label for="gender">Genre </label>
                    <input type="text" id="gender" name="gender" class="form-control" readonly="readonly" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="profession">Profession </label>
                    <input type="text" id="profession" name="job" class="form-control" readonly="readonly" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="idNumber">Numéro d'identité </label>
                    <input type="text" id="idNumber" name="cin" class="form-control" readonly="readonly" required>
                </div>
               
                <div class="form-group col-md-6">
                    <label for="dateOfBirth">Date de naissance </label>
                    <input type="date" id="dateOfBirth" name="bday" class="form-control" readonly="readonly" required>
                </div>
                
            </div>
</div> <!--F1-->



<div class="Forms" id="F2">
<h2><i class="fas fa-file-contract"></i> Votre Contrat</h2>
<div class="form-group">
            <label for="frac">Fractionnement :</label>
            <select id="frac" name="fraction" class="form-control" required>
            <option value="" selected disabled hidden><i class="fas fa-chevron-down"></i>--choisir--</option>
            <!-- changement de ceci Semestrielle -->
            <option value="Semestrielle"><i class="far fa-calendar-alt"></i> Semestrielle</option>
            <option value="Trimestrielle"><i class="far fa-calendar-alt"></i> Trimestrielle</option>
            <option value="Annuelle"><i class="far fa-calendar-alt"></i> Annuelle</option>
            <!-- fin changement de ceci -->
            </select>
        </div>

        
<!-- rendre ceci par defaut Annuelle  -->
<div class="form-group">
    <label for="renew">Renouvellement :</label>
    <select id="renew" name="renew" class="form-control" required>
        <option value="" disabled hidden>----- Choisir -----</option>
        <option value="Année" selected>Annuelle</option>
    </select>
</div>
<!-- fin renouvellement defaut Annuelle  -->

        <!-- fin renouvellement defaut Annuelle  -->

        
        <div class="form-group">
            <label for="effect_date">Date d'effet :</label>
            <input type="date" id="effect_date" name="effect_date" class="form-control">
        </div>

       <!-- ceci a changée type de text vers date --> 
        <div class="form-group">
    <label for="dl">Échéance contractuelle :</label>
    <input type="date" id="dl" name="deadline" readonly="readonly" class="form-control">
    </div>
       <!-- fin changement --> 

</div> <!--F2-->


<div class="Forms" id="F3">
<h2><i class="fas fa-shipping-fast"></i> Mode de livraison</h2>
<div class="form-group">

                <label for="deliv_type">Sélectionnez un mode de livraison:</label>
                <select id="deliv_type" name="deliv_type">
                    <option value="standard">Livraison standard</option>
                    <option value="express">Livraison express</option>
                    <option value="pickup">Point relais</option>
                </select>
            </div>
            <div class="form-group">
                <label for="adress">Adresse de livraison:</label>
                <input type="text" id="adress" name="deliv_adr"  placeholder="Entrez votre adresse" required>
            </div>
   

</div><!--F3-->


<div class="Forms" id="F4">
<h2><i class="fas fa-credit-card"></i> Paiement</h2>
<div class="form-group">
            <label for="ccn">Numéro de carte de crédit :</label>
            <input type="text" id="ccn" class="form-control"  min="16" max="16" required>
        </div>
        
        <div class="form-group">
            <label for="code">Code de sécurité :</label>
            <input type="password" id="code" class="form-control" min="3" max="3" required>
        </div>
        
        <div class="form-group">
            <label for="expire">Date d'expiration :</label>
            <input type="month" id="expire" class="form-control" required>
        </div>

</div> <!--F4-->

</form>

<div class="buttons">
    <button id="prev" disabled>Prev</button>
    <button id="next" >Next</button>
</div>

<section>
   <!-- <button class="show-modal">
      <i class="fas fa-sync"></i> Convertir la Simulation en Devis
    </button> -->
      <span class="overlay"></span>
    <div class="modal-box">
    <i class="fas fa-money-bill-wave"></i>
      <h4 id="amount"></h4>
      <div class="buttons">
        <button type="reset" class="close-btn">Confirmer</button>
        <button id="down_btn" onClick="Cancelation();" class="down_btn">Annuler</button>
      </div>
    </div>


  </section>

  <section id="overfail">
    
  <div id="fail">
  <i class="fas fa-exclamation-triangle"></i>
      <h4> Désolé, votre solvabilité actuelle ne permet pas cette transaction </h4>
      <div class="buttons">
        <button id="down_btn" onClick="Cancelation();" class="down_btn">Annuler</button>
      </div>
    </div>
</section>

<!--  <div id="pops" class="pops">
    <div class="pops_content">
    <h4 id="pop_text"></h4>
    <button  id="confirm" onClick="document.getElementById('pops').style.display='none'">Confirm</button>
    <button  id="cancel" onClick="window.location.href='Home'">Cancel</button>
    </div>
    
</div> -->
</div>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
    
<script>

// loading spinner for api's 

document.getElementById("next").addEventListener("click", function() {
    if (this.innerHTML === "Payer") {
        // Affiche le spinner de chargement
        document.getElementById("loading-spinner").style.display = "flex";

        // Cache le spinner après 5 secondes
        setTimeout(function() {
            document.getElementById("loading-spinner").style.display = "none";
        }, 5000);
    }
});




// fin loading spinner for api's

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



  function Cancelation() {

    client.get(null,'http://localhost:9090/subcancel', function (response) {
      window.location.href='Home';
    });
    
  }









    var Form1 = document.getElementById('F1');
    var Form2 = document.getElementById('F2');
    var poptxt = document.getElementById('pop_text');
    var pops = document.getElementById('pops');
    var confirm = document.getElementById('confirm');
    var cancel = document.getElementById('cancel');
    var fail = document.getElementById('fail');
    var overfail = document.getElementById('overfail');

    var date_ef = document.getElementById("effect_date");
    var DL = document.getElementById("dl");
    var frac = document.getElementById("frac");
    var renew = document.getElementById("renew");

    var nom = document.getElementById('cl_ln');
    var prenom = document.getElementById('cl_fn');
    const gender = document.getElementById('gender');
    const email = document.getElementById('email');
    const profession = document.getElementById('profession');
    const idNumber = document.getElementById('idNumber');
    const dateOfBirth = document.getElementById('dateOfBirth');
    const phoneNumber = document.getElementById('phoneNumber');

    const deliv_type = document.getElementById('deliv_type');
    const adress = document.getElementById('adress');

    const ccn = document.getElementById('ccn');
    const code = document.getElementById('code');
    const expire = document.getElementById('expire');
        
    var money = parseInt("<?php echo e($DEVIS->money); ?>");
    var prog = 1;
    var form = 'F';
    var currentForm = 1;
    var extraP = 800;
    var extraN = 100;
    var Data={}



    const section = document.querySelector("section"),
      overlay = document.querySelector(".overlay"),
      showBtn = document.querySelector(".show-modal"),
      closeBtn = document.querySelector(".close-btn");
      confBtn = document.querySelector(".down_btn");


    closeBtn.addEventListener("click", () =>
      section.classList.remove("active")
    );



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

var theurl='http://localhost:9090/cinapi';
var client= new HttpClient();
let Exists = true;

//client.get(Data,theurl, function(response) {});


document.addEventListener('DOMContentLoaded', function() {
  Data = { "dv_usern": "<?php echo e(session()->get('user')); ?>" };

client.get(Data, theurl, function (response) {
  var resp = JSON.parse(response);

  //console.log(resp[0]["client_lastname"]);

  nom.value = resp[0]["client_lastname"];
  prenom.value = resp[0]["client_firstname"];
  email.value = resp[0]["email"];
  gender.value = resp[0]["gender"];
  profession.value = resp[0]["job"];
  idNumber.value = resp[0]["cin"];
  dateOfBirth.value = resp[0]["birth_date"];
  phoneNumber.value = resp[0]["phone"];

 
});
}, false);






function goBack() {
    window.history.back();
}

function showError(inputId, message) {
    const input = document.getElementById(inputId);
    const errorMessage = document.createElement('div');
    errorMessage.className = 'error-message';
    errorMessage.style.fontSize = '0.8em';
    errorMessage.style.marginTop = '5px';
    errorMessage.style.fontWeight = 'bold';
    errorMessage.style.textDecoration = 'underline';
    errorMessage.style.color = '#ff6666';

    console.log("show error running");
    errorMessage.textContent = message;
    input.parentNode.appendChild(errorMessage);
}


function validateEmail(email) {
  const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return regex.test(String(email).toLowerCase());
}
 

function updateProgressBar(currentPage) {
    const circles = document.querySelectorAll(".circle");
    const progressBar = document.querySelector(".indicator");
    
    let currentStep = currentPage;
    
    circles.forEach((circle, index) => {
        circle.classList[`${index < currentStep ? "add" : "remove"}`]("active");
    });
    
    progressBar.style.width = `${((currentStep - 1) / (circles.length - 1)) * 100}%`;
}

function addYears(date, years) {
  date.setFullYear(date.getFullYear() + years);
  return date;
}





function CinAPI() {
  return new Promise((resolve, reject) => {
    var cin = "";
    var Exists;

    Data = { "dv_usern": "<?php echo e(session()->get('user')); ?>" };

    client.get(Data, theurl, function (response) {
      var resp = JSON.parse(response);


      nom.value=resp[0]["client_lastname"];

      cin = resp[0]["cin"];
      console.log(cin);

      if (!(idNumber.value.trim() === resp[0]["cin"])) {
        Exists = false;
      } else {
        Exists = true;
      }

      resolve(Exists);
    });
  });
}



async function CinTest() {
  var exists = await CinAPI();
  console.log(exists+ " in the async");

  return exists;
 
}






/* cette fonction a était chngée */
/*
date_ef.addEventListener("change", function (){

    var start_date = date_ef.value;
    var deadline = date_ef.value;

    deadline = new Date(start_date);
    deadline = addYears(deadline, 1);
    deadline = deadline.toISOString().split('T');
    DL.value=deadline[0];

});
*/
/*fin fonction precedente*/ 


/* NV fonction */
function addYears(date, years) {
    var result = new Date(date);
    result.setFullYear(result.getFullYear() + years);
    return result;
}

var date_ef = document.getElementById("effect_date");
var DL = document.getElementById("dl");

date_ef.addEventListener("change", function () {

    var start_date = date_ef.value;
    var deadline = date_ef.value;

    deadline = new Date(start_date);
    deadline = addYears(deadline, 1);
    
    // Formatage de la date
    var year = deadline.getFullYear();
    var month = String(deadline.getMonth() + 1).padStart(2, '0');
    var day = String(deadline.getDate()).padStart(2, '0');
    var formattedDate = year + '-' + month + '-' + day;
    
    DL.value = formattedDate;

});
/* fin NV fonction */




document.getElementById("prev").addEventListener("click", function () {

   if (prog == 4) {
    document.getElementById("next").innerHTML="Next";
    Form1.style.left = "1000px";

currentForm -= 1;
prog = prog-1;
updateProgressBar(prog);


form = 'F'+currentForm;
form = form.replace(/^\s+|\s+$/g,'');
console.log(form);

Form1 = document.getElementById(form);
Form1.style.left = "100px";
   } 

   else if (prog==2) {

    Form1.style.left = "1000px";

currentForm -= 1;
prog = prog-1;
updateProgressBar(prog);

document.getElementById("prev").disabled=true;

form = 'F'+currentForm;
form = form.replace(/^\s+|\s+$/g,'');
console.log(form);

Form1 = document.getElementById(form);
Form1.style.left = "100px";

}

    else {
        Form1.style.left = "1000px";

        currentForm -= 1;
        prog = prog-1;
        updateProgressBar(prog);


    form = 'F'+currentForm;
    form = form.replace(/^\s+|\s+$/g,'');
    console.log(form);

    Form1 = document.getElementById(form);
    Form1.style.left = "100px";

    }
});




document.getElementById("next").addEventListener("click", async function () {

    if (prog==1) {
    document.querySelectorAll('.error-message').forEach(el => el.remove());
    let hasErrors = false;

    if (nom.value.trim() === '') {
        showError('cl_ln', 'Le nom est obligatoire.');
        hasErrors = true;
    }

    if (prenom.value.trim() === '') {
        showError('cl_fn', 'Le prénom est obligatoire.');
        hasErrors = true;
    }

    if (gender.value.trim() === '') {
        showError('gender', 'Le genre est obligatoire.');
        hasErrors = true;
    }

    if (profession.value.trim() === '') {
        showError('profession', 'La profession est obligatoire.');
        hasErrors = true;
    }

    if (idNumber.value.trim() === '') {
        showError('idNumber', 'CIN est obligatoire.');
        hasErrors = true;
    }
    else if (idNumber.value.trim().length != 8) {
        showError('idNumber', 'CIN doit contenir 8 caractères.');
        hasErrors = true;
    }
    else {
    const isValidCin = await CinTest();
    if (!isValidCin) {
      showError('idNumber', 'CIN invalid.');
      hasErrors = true;
    }
  }
  

    if (dateOfBirth.value.trim() === '') {
        showError('dateOfBirth', 'La date de naissance est obligatoire.');
        hasErrors = true;
    }

    if (email.value.trim() === '') {
        showError('email', 'L\'adresse e-mail est obligatoire.');
        hasErrors = true;
    } else {
      
        if (validateEmail(email.value.trim())==false) {
            showError('email', 'Veuillez entrer une adresse e-mail valide.');
            hasErrors = true;
        }
    }

    if (phoneNumber.value.trim() === '') {
        showError('phoneNumber', 'Mobile est obligatoire.');
        hasErrors = true;
    } else if (phoneNumber.value.trim().length != 8) {
        showError('phoneNumber', 'Mobile doit contenir 8 caractères.');
        hasErrors = true;
    }

    if (hasErrors) { console.log("cant pass");}
    else {
        Form1.style.left = "-800px";

        currentForm += 1;
        prog = prog+1;
        updateProgressBar(prog);

    document.getElementById("prev").disabled=false;

    form = 'F'+currentForm;
    form = form.replace(/^\s+|\s+$/g,'');
    console.log(form);

    Form1 = document.getElementById(form);
    Form1.style.left = "100px";

    }
}



else if (prog==2) {

    document.querySelectorAll('.error-message').forEach(el => el.remove());
    let hasErrors = false;

    if (frac.value.trim() === '') {
        showError('frac', 'La fractionnement est obligatoire.');
        hasErrors = true;
    }

    if (renew.value.trim() === '') {
        showError('renew', 'La renouvellement est obligatoire.');
        hasErrors = true;
    }

    if (date_ef.value.trim() === '') {
        showError('effect_date', 'La date d\'effect est obligatoire.');
        hasErrors = true;
    }

    if (dl.value.trim() === '') {
        showError('dl', 'La date d\'echeance est obligatoire.');
        hasErrors = true;
    }

    if (hasErrors) { console.log("cant pass");}
    else {
        Form1.style.left = "-800px";

        currentForm += 1;
        prog = prog+1;
        updateProgressBar(prog);

    document.getElementById("prev").disabled=false;

    form = 'F'+currentForm;
    form = form.replace(/^\s+|\s+$/g,'');
    console.log(form);

    Form1 = document.getElementById(form);
    Form1.style.left = "100px";

    }

}


else   
if (prog==3) {

    document.querySelectorAll('.error-message').forEach(el => el.remove());
    let hasErrors = false;

    if (deliv_type.value.trim() === '') {
        showError('deliv_type', 'Type de livraison est obligatoire.');
        hasErrors = true;
    }

    if (adress.value.trim() === '') {
        showError('adress', 'Une adresse est obligatoire.');
        hasErrors = true;
    }

    if (hasErrors) { console.log("cant pass");}
    else {
        money=parseInt("<?php echo e($DEVIS->money); ?>");
       // pops.style.display = "block";
        var delivery = document.getElementById('deliv_type').value;
        console.log(delivery);
        if (delivery=="express") {
            money = money + 10;
        }
        else {
            money = parseInt("<?php echo e($DEVIS->money); ?>");
        }
       // poptxt.innerHTML="Le montant a payer est de : "+money+" TND";

        amount.innerHTML = "Le montant a payer est de :  <br> "+money+" TND";
        Form1.style.left = "-800px";
        section.classList.add("active")
 
currentForm += 1;
prog = prog+1;
updateProgressBar(prog);

document.getElementById("prev").disabled=false;

form = 'F'+currentForm;
form = form.replace(/^\s+|\s+$/g,'');
console.log(form);
document.getElementById("next").innerHTML="Payer";
Form1 = document.getElementById(form);
Form1.style.left = "100px";
}

}

    else if (prog==4){

        document.querySelectorAll('.error-message').forEach(el => el.remove());
    let hasErrors = false;

    if (ccn.value.trim() === '') {
        showError('ccn', 'Le numero de carte est obligatoire.');
        hasErrors = true;
    }

    else if (ccn.value.trim().length != 16) {
        showError('ccn', 'Numero de carte doit contenir 16 caractères.');
        hasErrors = true;
    }

// mock paiemenent 

    else if (ccn.value.trim() == '1111222233334444' || ccn.value.trim() == '5555666677778888' || ccn.value.trim() == '9999000011112222' ) {
        showError('ccn', 'Désolé, votre solvabilité actuelle ne permet pas cette transaction');
        overfail.style.display='block';
        fail.style.opacity='1';
        hasErrors = true;
    }

    if (code.value.trim() === '') {
        showError('code', 'Le code est obligatoire.');
        hasErrors = true;
    }
    else if (code.value.trim().length != 3) {
        showError('code', 'Code de carte doit contenir 3 caractères.');
        hasErrors = true;
    }

    if (expire.value.trim() === '') {
        showError('expire', 'La date d\'expiration est obligatoire.');
        hasErrors = true;
    }

    if (hasErrors) { console.log("cant pass");}
    else {document.getElementById('SubForm').submit();}
        

    }

else {
        Form1.style.left = "-800px";

        currentForm += 1;
        prog = prog+1;
        updateProgressBar(prog);

    document.getElementById("prev").disabled=false;

    form = 'F'+currentForm;
    form = form.replace(/^\s+|\s+$/g,'');
    console.log(form);

    Form1 = document.getElementById(form);
    Form1.style.left = "100px";

    }

});




</script>




</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/SubsForms.blade.php ENDPATH**/ ?>