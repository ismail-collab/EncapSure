<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="shortcut icon" href="assets/images/3d-cube.png" type="image/x-icon">

    <title>Devis</title>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="Clstyle.css">
<link rel="stylesheet" href="style.css">
<!-- code ajoutée pour les packs  -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- code ajoutée pour les packs  -->

<style>

    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;

    }

    .container {
        width: 800px;
        height: 590px;
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


/* CSS pour card */
.card {
    width: 100%; // s'assurer que la carte occupe toute la largeur du conteneur swiper-slide
    height: 100px; 
    flex-basis: 100%; // s'assurer que la carte occupe toute la largeur du conteneur swiper-slide
    margin-bottom: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    transition: all 0.3s ease;
}
/* Fin CSS pour cards */


    /* CSS pour card */




/* CSS pour centrer les labels*/
.steps .circle:nth-child(1)::before {
  content: "Véhicule";
}

.steps .circle:nth-child(2)::before {
  content: "Spécifications Auto";
}

.steps .circle:nth-child(3)::before {
  content: "Formule de Garantie";
}

.steps .circle:nth-child(4)::before {
  content: "Souscripteur";
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
   <a href="Home"> <img src="{{ asset('images/logo.svg') }}" alt="Logo"> </a>

<div class="sidebar-logo-text">EncapSure</div>
<div class="sidebar-line"></div>

  </div>


  <div class="sidebar-header">
    <a href="Home">
    <i class="fas fa-user-circle"></i> {{ session()->get('name') }}</a>
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
<h1 class="text-center mb-5 interactive client-text">Processus de Devis</h1>
</div>



<div class="container_progress_bar">
  <div class="steps">
    <span class="circle active">
      <i class="fas fa-car"></i>
    </span>
    <span class="circle">
      <i class="fas fa-cogs"></i>
    </span>
    <span class="circle">
      <i class="fas fa-shield-alt"></i>
    </span>
    <span class="circle">
      <i class="fas fa-user"></i>
    </span>
    <div class="progress-bar">
      <span class="indicator"></span>
    </div>
  </div>
</div>


<div class="container">
    <form id="DevisForm" action="WordMaker" method="POST">
        @csrf
        <div class="Forms" id="F1">
            <h2><i class="fas fa-car"></i> Données Véhicule</h2>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="immat_type">Type d'immatriculation</label>
                        <select id="immat_type" name="immat_type" class="form-control" required>
                            <option value="" selected hidden>-- Choisissez --</option>
                            <option value="TU">TU</option>
                            <option value="RS">RS</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="immat">Immatriculation</label>
                        <input type="text" id="immat" name="immat" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Serie">Serie</label>
                        <div style="position: relative;">
                            <input type="number" id="Serie" name="serie" class="form-control" required>
                            <span id="serie_prefix" style="position: absolute; left: -25px; top: 50%; transform: translateY(-50%); color: white; font-weight: bold; font-size: 1.1em;"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usage_type">Type d'usage</label>
                        <select id="usage_type" name="usage_type" class="form-control" required>
                            <option value="" selected disabled hidden>-- Choisissez --</option>
                            <option value="usage affaire">usage affaire</option>
                            <option value="usage commerce">usage commerce</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marque">Marque</label>
                        <input type="text" id="marque" name="marque" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="model">Modèle</label>
                        <input type="text" id="model" name="model" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="circ_date">Date de mise en circulation</label>
                        <input type="date" id="circ_date" name="circ_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mileage">Kilométrage</label>
                        <input type="number" id="mileage" name="km" class="form-control" required>
                    </div>
                </div>
            </div>
        </div> <!-- F1 -->



<div class="Forms" id="F2">
<h2><i class="fas fa-cogs"></i> Spécifications Automobile</h2>

<div class="form-row">
<div class="col-md-6">
  <div class="form-group">
      <label for="seat">Nombre de places</label>
      <input type="number" id="seat" name="seat" class="form-control" required>
  </div>

  <div class="form-group">
      <label for="horse">Nombre de chevaux</label>
      <input type="number" id="horse" name="horse" class="form-control" required>
  </div>

  <div class="form-group">
      <label for="bonus_malus">Classe Bonus/Malus</label>
      <input type="number" id="bonus_malus" name="bonus_malus" class="form-control" value="8" disabled>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
      <label for="price_new">valeur a neuf</label>
      <input type="number" id="price_new" name="price_new" class="form-control" required>
  </div>

  <div class="form-group">
      <label for="price_venal">Valeur vénale</label>
      <input type="number" id="price_venal" name="price_venal" class="form-control" required>
  </div>
</div>


</div>

</div><!--F2-->
<div class="Forms" id="F3">
    <h2><i class="fas fa-shield-alt"></i> Choisissez votre garantie</h2>
    <div id="swip" class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($INFOS as $inf)
                <div class="swiper-slide">
                    <div class="card three">
                        <div class="top">
                            <div class="title">{{$inf['pack_name']}}</div>
                            <div class="price-sec">
                                <span class="price"><u>{{$inf['price']}}DT</u></span>
                            </div>
                        </div>
                        <div class="details">
                            @php 
                                if ($inf['gr1']!=0) { echo ' <div class="one"> <span>Responsabilité civile</span> <i class="fas fa-check"></i> </div> '; } 
                                if ($inf['gr2']!=0) { echo ' <div class="one"> <span>Assistance 24/7</span> <i class="fas fa-check"></i> </div> '; } 
                                if ($inf['gr3']!=0) { echo ' <div class="one"> <span>Protection juridique</span> <i class="fas fa-check"></i> </div> '; } 
                                if ($inf['gr4']!=0) { echo ' <div class="one"> <span>Garantie dommages</span> <i class="fas fa-check"></i> </div> '; } 
                                if ($inf['gr5']!=0) { echo ' <div class="one"> <span>Vol et incendie</span> <i class="fas fa-check"></i> </div> '; } 
                                if ($inf['gr6']!=0) { echo ' <div class="one"> <span>Assurance tous risques</span> <i class="fas fa-check"></i> </div> '; } 
                                if ($inf['gr7']!=0) { echo ' <div class="one"> <span>Franchise modulable</span> <i class="fas fa-check"></i> </div> '; } 
                            @endphp
                        </div>
                        <input type="radio" name="pack" value="{{$inf['pack_id']}}" id="pack{{$inf['pack_id']}}" required>
                        <input type="hidden" name="money" value="{{$inf['price']}}" id="{{$inf['pack_id']}}" >
                        <label>Choisir</label>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Add Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>


<script>
var swiper = new Swiper('.swiper-container', {
    slidesPerView: 3, // afficher trois slides à la fois
    spaceBetween: 10, // espace entre les slides
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});


</script>

<div class="Forms" id="F4">
<h2><i class="fas fa-user"></i> Informations personnelles</h2>

<div class="form-row">
    <div class="col-md-6">

    <div class="form-group">
        <label for="cl_ln">Nom</label>
        <input type="text" id="cl_ln" name="cl_ln" class="form-control" required>
 </div>

 <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" required>
 </div>


<div class="form-group">
      <label for="dateOfBirth">Date de naissance</label>
      <input type="date" id="dateOfBirth" name="bday" class="form-control" required>
</div>


<div class="form-group">
    <label for="phoneNumber">Numéro de téléphone</label>
    <input type="text" id="phoneNumber" name="phone" class="form-control" required>
</div>
                        

</div>

<div class="col-md-6">
<div class="form-group">
  <label for="cl_fn">Prenom</label>
  <input type="text" id="cl_fn" name="cl_fn" class="form-control" required>
 </div>
  <div class="form-group">
    <label for="gender">Genre</label>
    <select id="gender" name="gender" class="form-control" required>
      <option value="" selected disabled hidden>-- Choisissez --</option>
      <option value="homme">Homme</option>
      <option value="femme">Femme</option>
    </select>
  </div>

  <div class="form-group">
   <label for="profession">Profession</label>
   <input type="text" id="profession" name="job" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="idNumber">Numéro d'identité</label>
    <input type="text" id="idNumber" name="cin" class="form-control" required>
    <input type="hidden" id="finalMoney" name="final_money" value="0"  required>
  </div>
  
</div>
</div>    


</div><!--F3-->

</form>

<!-- debut icons ajoutée pour les btn -->
<div class="buttons">
    <button id="prev" disabled><i class="fas fa-arrow-left"></i> Précédent</button>
    <button id="next" >Suivant <i class="fas fa-arrow-right"></i> </button>
</div>
<!-- fin icons ajoutée pour les btn -->


<section>
   <!-- <button class="show-modal">
      <i class="fas fa-sync"></i> Convertir la Simulation en Devis
    </button> -->
      <span class="overlay"></span>
    <div class="modal-box">
    <i class="fas fa-sync"></i> <!-- badelt el icone lena -->
      <h3>Voulez-vous convertir la simulation en devis?</h3>
      <h4 id="amount"></h4>
      <div class="buttons">
        <button type="reset" id="convert_btn" class="close-btn">Oui, convertir</button>
        <button id="down_btn" classe="btn-pop" onClick="Cancelation();" class="down_btn">Annuler</button>
      </div>
    </div>
</section>

</div>








<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
<script>
var swiper = new Swiper('.swiper-container', {
  slidesPerView: 1,
  spaceBetween: 10,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
</script>


    
<script>


/*ceci est */ 
/**/ 


  /*add this for TU or RS */

  document.getElementById("immat_type").addEventListener("change", function() {
    var seriePrefix = document.getElementById("serie_prefix");
    seriePrefix.textContent = this.value;
});

/* fin JS for TU and RS */

        var Form1 = document.getElementById('F1');
        var Form2 = document.getElementById('F2');
        var prog = 1;
        var form = 'F';
        var currentForm = 1;
        var extraP = 800;
        var extraN = 100;

         function goBack() {
             window.history.back();
         }
 
         const section = document.querySelector("section"),
      overlay = document.querySelector(".overlay"),
      showBtn = document.querySelector(".show-modal"),
      closeBtn = document.querySelector(".close-btn");
      confBtn = document.querySelector(".down_btn");



    closeBtn.addEventListener("click", () =>
      section.classList.remove("active")
    );


    const nom = document.getElementById('cl_ln');
    const prenom = document.getElementById('cl_fn');
    const gender = document.getElementById('gender');
    const email = document.getElementById('email');
    const profession = document.getElementById('profession');
    const idNumber = document.getElementById('idNumber');
    const dateOfBirth = document.getElementById('dateOfBirth');
    const phoneNumber = document.getElementById('phoneNumber');
    const seat = document.getElementById('seat');
    const horse = document.getElementById('horse');
    const price_new = document.getElementById('price_new');
    const price_venal = document.getElementById('price_venal');
    const immat = document.getElementById('immat');
    const marque = document.getElementById('marque');
    const model = document.getElementById('model');
    const mileage = document.getElementById('mileage');
    const circ_date = document.getElementById('circ_date');
    const immat_type = document.getElementById('immat_type');
    const Serie = document.getElementById('Serie');
    const usage_type = document.getElementById('usage_type');
    const pack_s = document.getElementById('pack_s');
    const pack_sp = document.getElementById('pack_sp');
    const pack_sn = document.getElementById('pack_sn');
    const amount = document.getElementById('amount');
    const pack = document.querySelector("pack");
    const final_money = document.getElementById("finalMoney");




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

var url='http://localhost:9090/cinapi';
var client= new HttpClient();


client.get({"dv_usern": "{{session()->get('user')}}" },url, function (response){
  console.log(response);

  var resp = JSON.parse(response);

  immat.value = resp[0]['immat'];
  immat_type.value = resp[0]['immat_type'];
  Serie.value = resp[0]['serie'];
  usage_type.value = resp[0]['usage_type'];
  marque.value = resp[0]['marque'];
  model.value = resp[0]['model'];
  circ_date.value = resp[0]['circ_date'];
  mileage.value = resp[0]['km'];
  seat.value = resp[0]['seat'];
  horse.value = resp[0]['horse'];
  price_new.value = resp[0]['price_new'];
  price_venal.value = resp[0]['price_venal'];

  nom.value = resp[0]['client_firstname'];
  prenom.value = resp[0]['client_lastname'];
  gender.value = resp[0]['gender'];
  email.value = resp[0]['email'];
  profession.value = resp[0]['job'];
  idNumber.value = resp[0]['cin'];
  dateOfBirth.value = resp[0]['birth_date'];
  phoneNumber.value = resp[0]['phone'];


});















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
swip.style.display="block";

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
     swip.style.display="none";
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


immat.addEventListener("change", function () {

if (immat.value.trim().length == 6 || immat_type.value=="RS") {
 Serie.disabled=true;
 Serie.value=0;

 }

 else if (immat.value.trim().length == 4 && immat_type.value=="TU") {
 Serie.disabled=false;
 Serie.value=0;

 }

});

immat_type.addEventListener("change", function () {

if (immat.value.trim().length == 6 || immat_type.value=="RS") {
Serie.disabled=true;
Serie.value=0;

}

else if (immat.value.trim().length == 4 && immat_type.value=="TU") {
Serie.disabled=false;
Serie.value=0;

}

});


document.getElementById("next").addEventListener("click", function () {

if (prog==1) {

 document.querySelectorAll('.error-message').forEach(el => el.remove());
 let hasErrors = false;

 if (immat.value.trim() === '') {
     showError('immat', "L'immatriculation est obligatoire");
     hasErrors = true;
 }
 else if (immat.value.trim().length > 6) {
     showError('immat', "L'immatriculation doit contenir 4 ou 6 caractères.");
     hasErrors = true;

 }
 else if (immat.value.trim().length != 4 && immat_type.value=="TU" ) {
     showError('immat', "L'immatriculation TU doit contenir 4 caractères.");
     hasErrors = true;

 }
 else if (immat.value.trim().length != 6 && immat_type.value=="RS" ) {
     showError('immat', "L'immatriculation RS doit contenir 6 caractères.");
     hasErrors = true;

 } 


 if (model.value.trim() === '') {
     showError('model', 'Le model est obligatoire.');
     hasErrors = true;
 }

 if (marque.value.trim() === '') {
     showError('marque', 'La marque est obligatoire.');
     hasErrors = true;
 }

 if (mileage.value.trim() === '') {
     showError('mileage', 'Le kilometrage est obligatoire.');
     hasErrors = true;
 }

 if (circ_date.value.trim() === '') {
     showError('circ_date', 'La date est obligatoire.');
     hasErrors = true;
 }

 if (immat_type.value.trim() === '') {
     showError('immat_type', 'Le type immatriculation est obligatoire.');
     hasErrors = true;
 }

 if (Serie.value.trim() === '') {
     showError('Serie', 'La serie est obligatoire.');
     hasErrors = true;
 }   else if (Serie.value.trim().length !=3 && immat_type.value=="TU" ) {
     showError('Serie', "Serie doit contenir 3 caractères.");
     hasErrors = true;

 }

 if (usage_type.value.trim() === '') {
     showError('usage_type', 'Le type usage est obligatoire.');
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
if (prog==2) {

 document.querySelectorAll('.error-message').forEach(el => el.remove());
 let hasErrors = false;

 if (seat.value.trim() === '') {
     showError('seat', 'Le nombre des places est obligatoire.');
     hasErrors = true;
 }

 if (horse.value.trim() === '') {
     showError('horse', 'Le nombre de cheveaux est obligatoire.');
     hasErrors = true;
 }

 if (price_new.value.trim() === '') {
     showError('price_new', 'Le prix est obligatoire.');
     hasErrors = true;
 }

 if (price_venal.value.trim() === '') {
     showError('price_venal', 'Le prix venale est obligatoire.');
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
 swip.style.display="block";

 }

}

else
if (prog==3) {
console.log(document.querySelector('input[name=pack]:checked'));
var money=0;
if (document.querySelector('input[type=radio]:checked')) { 
 
 if (immat.value.trim() == '1234' || immat.value.trim() == '2345' || immat.value.trim() == '3456' ) {
     amount.innerHTML= "This vehicle is blacklisted";
     convert_btn.style.display="none";
     section.classList.add("active");
     swip.style.display="none";
 }
 else {

money= document.getElementById(document.querySelector('input[name="pack"]:checked').value).value;
amount.innerHTML = "Le montant total de devis est : "+(parseInt(price_new.value.trim()/1000)+parseInt(money))+" TND";
Form1.style.left = "-800px";
final_money.value = (parseInt(price_new.value.trim()/1000)+parseInt(money));
console.log("FINAL MONEY IS : ",final_money.value);
section.classList.add("active");

currentForm += 1;
prog = prog+1;
updateProgressBar(prog);

document.getElementById("prev").disabled=false;

form = 'F'+currentForm;
form = form.replace(/^\s+|\s+$/g,'');
console.log(form);
document.getElementById("next").innerHTML="Submit";
Form1 = document.getElementById(form);
Form1.style.left = "100px";
swip.style.display="none";

}

} else { 
alert('You must choose a pack');
}

}


else if (prog==4){

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

 else if (idNumber.value.trim() == '12345678' || idNumber.value.trim() == '23456789' || idNumber.value.trim() == '34567890') {
     showError('idNumber', 'CIN blacklisté');
     hasErrors = true;
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

 if (hasErrors) { console.log("cant pass"); }
 else {
   document.getElementById('DevisForm').submit();
 }

}

});


function Cancelation() {

client.get(null,'http://localhost:9090/dvcancel', function (response) {
  window.location.href='Home';
});

}


</script>




</body>
</html>