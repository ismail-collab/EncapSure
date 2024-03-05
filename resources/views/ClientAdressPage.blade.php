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
  <link rel="stylesheet" href="style.css">
  
  <title>Client Pick Page</title>
 <!-- Add Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Ajoutez cela à la fin de votre body, avant vos autres scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom CSS -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
    }
    /*

    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    */

    /* NV CSS */
    .container {
        max-width: 500px; /*this was changed*/ 
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
    /* Fin NV CSS */


    /*Ceci a était modifiée  () ajouter td */
/*
    .table tbody td {
        color: #ffffff;
    }
*/
    /* fin modification */

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

   

    button {
        border: none;
        background-color: #1e52a8;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        margin: 5px;
    }

    button:hover {
        background-color: #0d3d7a;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    select, input[type="text"] {
        display: block;
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
    }


/*ceci ajoutée pour les btn*/ 

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
    
/*fin ajout pour les btn*/ 


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
<form action="Adress_To_Pay" method="post">
@csrf
<table>
    <thead>
    <tr>    
        <td>Contract N°</td>
        <td>Receipt</td>
        <td>Amount To Pay</td>
</tr>
</thead>
<tbody>
<tr>
    @php $i=1  @endphp
    @foreach ($RECPS as $rec)
    <tr>
    <input type="hidden" name="recps[{{$i++}}]" value="{{$rec['id']}}-{{$rec['receipt']}}-{{$rec['contract_num']}}-{{$rec['left_amount']}}">
    <td>{{$rec['contract_num']}}</td>
    <td>{{$rec['receipt']}}</td>
    <td>{{$rec['left_amount']}}</td>
    </tr>
    @endforeach
</tr>
</tbody>
</table>

    <label for="country">Country:</label>
    <select id="country" name="country">Select Country</select>
    <br>
    <label for="city">City:</label>
    <select id="city" name="city"><option>Select City</option></select>
    <br>
    <label for="zip">Zip Code:</label>
    <input type="text" id="zip" name="zip">

<br>
<td><button class="next_btn">Next</button></td>
    
</form> -->




<!-- Navbar -->
<div class="navbar">
  <a href="Welcome" class="navbar-brand">
    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo"> EncapSure
  </a>
  <div class="nav-items">
  <a href="HomeAgent" class="nav-link"><i class="fas fa-user"></i> {{ session()->get('name') }}</a>
  <a href="#" class="nav-link nav-link-notification"><i class="fas fa-bell"></i> Notification</a>
  <a href="Logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>

  

<div class="container">
<h2><i class="fas fa-truck"></i> Mode de livraison</h2>
    <form action="Adress_To_Pay" method="post">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>Contrat</th>
                <th>Numéro de réception</th>
                <th>Montant à payer</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            @php $i=1  @endphp
    @foreach ($RECPS as $rec)
    <tr>
    <input type="hidden" name="recps[{{$i++}}]" value="{{$rec['id']}}-{{$rec['receipt']}}-{{$rec['contract_num']}}-{{$rec['left_amount']}}">
    <td>{{$rec['contract_num']}}</td>
    <td>{{$rec['receipt']}}</td>
    <td>{{$rec['left_amount']}}</td>
    </tr>
    @endforeach
            </tr>
        </tbody>
    </table>
    
    <div class="form-group">
        <label for="country">Pays :</label>
        <select id="country" name="country" class="form-control"></select>
    </div>

    <div class="form-group">
        <label for="city">Ville :</label>
        <select id="city" name="city" class="form-control"></select>
    </div>

    <div class="form-group">
            <label for="postal-code">Code postal :</label>
        <input type="text" id="postal-code" name="zip" class="form-control">
    </div>

    <div class="form-group">

        <!-- this was changed -->
        <button type="submit" class="btn btn-block" id="next"> Valider <i class="fas fa-check"></i></button>
        <button type="button" class="btn btn-block" onclick="window.history.back();"><i class="fas fa-arrow-left"></i> Retour</button>
        <!--Fin changement -->

    </div>
</div>
</form>




<!-- Contenu principal -->
<div class="content">
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



</body>

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

var HttpClientG = function(){
    this.get = function(Reqdata, aUrl, aCallback) {
        var anHttpRequest = new XMLHttpRequest();
        anHttpRequest.onreadystatechange = function() {
            if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
            aCallback(anHttpRequest.responseText);
        }
        anHttpRequest.open("GET",aUrl,true);
        anHttpRequest.setRequestHeader('Content-Type', 'application/json; charset=UTF-8' , );
        anHttpRequest.send(JSON.stringify(Reqdata));
    }
}

var clientGet= new HttpClientG();

$(document).ready(function(e) {
        $('.next_btn').on('click',function() {
            var currentRow = $(this).closest("tr");
            var contract_num = currentRow.find("td:eq(1)").text();
            var receipt = currentRow.find("td:eq(2)").text();

        });
    
    });

    var selectedCountry = document.getElementById('country');
    var selectedCity = document.getElementById('city');
    var CountryName = "";
    var Country ="";
    var City = "";


  //clientGet.get("","https://countryapi.io/api/all?apikey=SIkOWUkFMDcwWKIYA0nU1fF2mXcw09hqKs1qFpnD", function(response) {
   
    clientGet.get("","https://restcountries.com/v3.1/all", function(response) {
    var ResArray=JSON.parse(response);
    var options="<option>Select Country</option>";
    var SortArray = []

    for (var i=0;i<Object.keys(ResArray).length;i++) {
          SortArray.push(ResArray[i]["name"]["common"]);
    }

    SortArray.sort();

    for (var i=0;i<Object.keys(ResArray).length;i++) {
        options += "<option value='"+SortArray[i]+"'>"+SortArray[i]+"</option>";
    }

    selectedCountry.innerHTML=options;

  });


     Country = {"country": selectedCountry.value};

    selectedCountry.addEventListener('change', event => {
    var CountryName = event.target.value;

    if (CountryName) {


        var settings = {
  "url": "https://countriesnow.space/api/v0.1/countries/cities",
  "method": "POST",
  "timeout": 0,
  "data": {"country":CountryName},
};

$.ajax(settings).done(function (response) {
  console.log(response);

    var options="<option>Select City</option>";
    var SortArray = []

    for (var i=0;i<Object.keys(response["data"]).length;i++) {
          SortArray.push(response["data"][i]);
    }

    SortArray.sort();

    for (var i=0;i<Object.keys(response["data"]).length;i++) {
        options += "<option value='"+SortArray[i]+"'>"+SortArray[i]+"</option>";
    }

    selectedCity.innerHTML=options;

    
       });
    }

});


selectedCity.addEventListener('change', event => {
    City = event.target.value;
 console.log(City);
});










</script>


</html>