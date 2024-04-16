// Nous définissons deux variables qui ciblent les éléments HTML avec les IDs "dev_g" et "sub_g" respectivement.
var devis = document.getElementById("dev_g");
var subs = document.getElementById("sub_g");

// Nous définissons un constructeur pour notre client HTTP personnalisé.
var HttpClient = function(){
  this.get = function(Reqdata, aUrl, aCallback) {
      var anHttpRequest = new XMLHttpRequest();
      anHttpRequest.onreadystatechange = function() {

          // Si la requête est terminée (readyState == 4) et le statut est OK (status == 200),
          // nous appelons la fonction de rappel avec le texte de la réponse.
          if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
          aCallback(anHttpRequest.responseText);
      }
      anHttpRequest.open("POST",aUrl,true);
      anHttpRequest.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
      anHttpRequest.send(JSON.stringify(Reqdata));
  }
}

// Nous définissons l'URL vers laquelle nous voulons envoyer notre requête.
var url='http://localhost:9090/devisinfo';
// Nous instancions notre client HTTP.
var client= new HttpClient();

// Nous envoyons une requête à l'URL définie, sans corps de requête (null), 
// et nous définissons une fonction de rappel pour traiter la réponse.
client.get(null,url, function (response) {

// Nous analysons la réponse JSON en un objet JavaScript.
var resp = JSON.parse(response);

console.log(resp);

// Nous mettons à jour l'élément HTML ciblé avec le nombre d'éléments dans la réponse.
devis.innerHTML=resp['length'];


// Nous définissons trois tableaux pour stocker les données d'âge.
var secAge = [0,0,0]; // pack 1 age 
var secPAge = [0,0,0]; // pack 2 age
var serAge = [0,0,0]; // pack 3 age 


// calcul de l'age des clients
function calculateAge(birthDate) {
  const today = new Date();
  const birthDateObj = new Date(birthDate); 
  let age = today.getFullYear() - birthDateObj.getFullYear();
  const monthDifference = today.getMonth() - birthDateObj.getMonth();

  if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDateObj.getDate())) {
    age--;
  }

  return age;
}


for (var i=0; i<resp.length;i++) {

  console.log(resp[i]['birth_date']);

  if (resp[i]['pack']==1) {

    if (calculateAge(resp[i]['birth_date'])>=20 && calculateAge(resp[i]['birth_date'])<=39 ) {

      secAge[0]++; // pack 1 age entre 20 et 39

    }
    else if (calculateAge(resp[i]['birth_date'])>=40 && calculateAge(resp[i]['birth_date'])<=59 ) {

      secAge[1]++; // pack 1 age entre 40 et 59

    }
     else {
      secAge[2]++; // pack 1 age +60
     }

  }

  else if (resp[i]['pack']==2) {

    if (calculateAge(resp[i]['birth_date'])>=20 && calculateAge(resp[i]['birth_date'])<=39 ) {

      secPAge[0]++; // pack 2 age entre 20 et 39

    }
    else if (calculateAge(resp[i]['birth_date'])>=40 && calculateAge(resp[i]['birth_date'])<=59 ) {

      secPAge[1]++; // pack 2 age entre 40 et 59

    }
     else {
      secPAge[2]++; // pack 3 age +60
     }

  }

  else {

    if (calculateAge(resp[i]['birth_date'])>=20 && calculateAge(resp[i]['birth_date'])<=39 ) {

      serAge[0]++;

    }
    
    else if (calculateAge(resp[i]['birth_date'])>=40 && calculateAge(resp[i]['birth_date'])<=59 ) {

      serAge[1]++;

    }
    
    else {
      serAge[2]++;
     }

  }

  

}

// Nous définissons trois tableaux pour stocker les données des prix de vehicule.

var firstRang = [0,0,0]; // pack 1 prix vehicule 
var secRang = [0,0,0]; // pack 2 prix vehicule 
var thirdRang  = [0,0,0]; // pack 3 prix vehicule 

for (var i=0; i<resp.length;i++) {

  console.log(resp[i]['price_new']+ "AND" + resp[i]['pack']);

if (resp[i]['pack']==1) {

  if (resp[i]['price_new']>4999 && resp[i]['price_new']<25001 ) {

    firstRang[0]++; // pack 1 prix entre 5000 et 25000

  }
  else if (resp[i]['price_new']>25000 && resp[i]['price_new']<35001 ) {

    firstRang[1]++; // pack 1 prix entre 26000 et 35000 

  }
   else {
    firstRang[2]++; // pack 1 prix +35000
   }

}

else if (resp[i]['pack']==2) {

  if (resp[i]['price_new']>4999 && resp[i]['price_new']<25001 ) {

    secRang[0]++; // pack 2 prix entre 5000 et 25000

  }
  else if (resp[i]['price_new']>25000 && resp[i]['price_new']<35001 ) {

    secRang[1]++; // pack 2 prix entre 26000 et 35000 

  }
   else {
    secRang[2]++; // pack 2 prix +35000
   }

}

else {

  if (resp[i]['price_new']>4999 && resp[i]['price_new']<25001 ) {

    thirdRang[0]++; // pack 3 prix +35000

  }
  
  else if (resp[i]['price_new']>25000 && resp[i]['price_new']<35001 ) {

    thirdRang[1]++; // pack 3 prix +35000

  }
  
  else {
    thirdRang[2]++; // pack 3 prix +35000
   }

}



}
  
console.log(firstRang + "/" + secRang + "/" + thirdRang);

// Intervalle age client
var Stickoptions = {
  series: [{
  name: 'Securité',
  data: secAge // alimentation pack 1 intervalle age
}, {
  name: 'Securité-plus',
  data: secPAge // alimentation pack 2 intervalle age
}, {
  name: 'Serenité',
  data: serAge // alimentation pack 3 intervalle age
}],
  chart: {
  type: 'bar',
  height: 350
},
plotOptions: {
  bar: {
    horizontal: false,
    columnWidth: '55%',
    endingShape: 'rounded'
  },
},
dataLabels: {
  enabled: false
},
stroke: {
  show: true,
  width: 2,
  colors: ['transparent']
},
xaxis: {
  title: {
    text: 'Intervale age client'
  },
  categories: ['20-39 Ans', '40-59 Ans', '60+ Ans'],
},
yaxis: {
  title: {
    text: 'Nombre de pack de sécurité'
  }
},
fill: {
  opacity: 1
},

};

var Stickchart = new ApexCharts(document.querySelector("#Stickchart"), Stickoptions);
Stickchart.render();

//intervalle prix vehicule
var Stickoptions2 = {
  series: [{
  name: 'Securité',
  data: firstRang  // alimentation pack 1 intervalle prix
}, {
  name: 'Securité-plus',
  data: secRang  // alimentation pack 2 intervalle prix
}, {
  name: 'Serenité',
  data: thirdRang  // alimentation pack 3 intervalle prix
}],
  chart: {
  type: 'bar',
  height: 350
},
plotOptions: {
  bar: {
    horizontal: false,
    columnWidth: '55%',
    endingShape: 'rounded'
  },
},
dataLabels: {
  enabled: false
},
stroke: {
  show: true,
  width: 2,
  colors: ['transparent']
},
xaxis: {
  title: {
    text: 'Intervale prix vehicule'
  },
  categories: ['5,000 - 25,000 TND', '26,000 - 35,000 TND', '35,000+ TND'],
},
yaxis: {
  title: {
    text: 'Nombre de pack de sécurité'
  }
},
fill: {
  opacity: 1
},

};


var Stickchart2 = new ApexCharts(document.querySelector("#Stickchart2"), Stickoptions2);
Stickchart2.render();

});



/*client.get(null,'http://localhost:9090/devisinfo', function (response) {});*/

var url2='http://localhost:9090/substats';
client.get(null,url2, function (response) {

var resp = JSON.parse(response);
console.log(resp);

console.log("SUB STAT WORKING");
console.log(resp[0]['effect_date']);

var money = 0;
var total = 0;

var chiffres = [];
var dates = [];

for (var i=0; i<resp.length;i++) {

  money = money + parseInt(resp[i]['money']);
  total = total + parseInt(resp[i]['money']);

  if (resp.length==1) {
    chiffres.push(money);
    dates.push(resp[i]['effect_date']);
    money = 0;

  }
  else if (i==resp.length-1 && resp[i]['effect_date']==resp[i-1]['effect_date']) {
    chiffres.push(money);
    dates.push(resp[i]['effect_date']);
    money = 0;

  } 
  else if (i==resp.length-1 && resp[i]['effect_date']!=resp[i-1]['effect_date']) {
    chiffres.push(money);
    dates.push(resp[i]['effect_date']);
    money = 0;
  }
  else if (resp[i]['effect_date']!=resp[i+1]['effect_date']) {
    chiffres.push(money);
    dates.push(resp[i]['effect_date']);
    money = 0;
  }
  
}

console.log(dates, chiffres);

subs.innerHTML=resp['length'];

var optionsLine = {
  chart: {
    height: 328,
    type: 'line',
    zoom: {
      enabled: false
    },
    dropShadow: {
      enabled: true,
      top: 3,
      left: 2,
      blur: 4,
      opacity: 1,
    }
  },
  stroke: {
    curve: 'smooth',
    width: 2
  },
  //colors: ["#3F51B5", '#2196F3'],
  series: [{
      name: "Montant en TND",
      data: chiffres
    }
  ],
  title: {
    text: "Chiffre d'affaires généré par les souscriptions : "+total.toLocaleString()+" TND",
    align: 'left',
    offsetY: 5,
    offsetX: 2
  },
  subtitle: {
    text: 'Montant en TND',
    offsetY: 35,
    offsetX: 10
  },
  markers: {
    size: 6,
    strokeWidth: 0,
    hover: {
      size: 9
    }
  },
  grid: {
    show: true,
    padding: {
      bottom: 0
    }
  },
  labels: dates,
  xaxis: {
    tooltip: {
      enabled: false
    }
  },
  legend: {
    position: 'top',
    horizontalAlign: 'right',
    offsetY: -30
  }
}

var chartLine = new ApexCharts(document.querySelector('#line-adwords'), optionsLine);
chartLine.render();


});


var url3='http://localhost:9090/dlstats';
var client= new HttpClient();


client.get(null,url3, function (response) {

var resp = JSON.parse(response);
console.log("THIS IS DL STATS",resp);

var renews = [0,0];
var dates = [];
var chiffres = [];
var money = 0;
var total = 0;

for (var i=0; i<resp.length;i++) {

  money = money + parseInt(resp[i]['total_amount']);
  total = total + parseInt(resp[i]['total_amount']);

  if (resp[i]['state']=="Not Paid") {
    renews[1]+=1;
  }
  else {
    renews[0]+=1;
  }

  if (resp.length==1) {
    chiffres.push(money);
    dates.push(resp[i]['start_date']);
    money = 0;

  }
  
  else if (i==resp.length-1 && resp[i]['start_date']==resp[i-1]['start_date']) {
    chiffres.push(money);
    dates.push(resp[i]['start_date']);
    money = 0;

  } 

  else if (i==resp.length-1 && resp[i]['start_date']!=resp[i-1]['start_date']) {
    chiffres.push(money);
    dates.push(resp[i]['start_date']);
    money = 0;
  }

  else if (resp[i]['start_date']!=resp[i+1]['start_date']) {
    chiffres.push(money);
    dates.push(resp[i]['start_date']);
    money = 0;
  }
}

var optionsCircle4 = {
  series: renews,
  chart: {
  type: 'donut',
},
title: {
  text: "Renouvellements effectués",
  align: 'left',
  offsetY: 5,
  offsetX: 2
},
labels: ['Payé', 'En attent'],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
      width: 200
    },
    legend: {
      position: 'bottom'
    }
  }
}]
};

var chartCircle4 = new ApexCharts(document.querySelector('#radialBarBottom'), optionsCircle4);
chartCircle4.render();

var optionsArea = {
  chart: {
    height: 380,
    type: 'area',
    stacked: false,
  },
  stroke: {
    curve: 'straight'
  },
  series: [
    {
      name: "Montant en TND",
      data: chiffres
    }
  ],
  title: {
    text: "Chiffre d'affaires généré par les renouvellements : "+total.toLocaleString()+" TND",
    align: 'left',
    offsetY: 5,
    offsetX: 2
  },
  xaxis: {
    categories: dates,
  },
  tooltip: {
    followCursor: true
  },
  fill: {
    opacity: 1,
  },

}

var chartArea = new ApexCharts(
  document.querySelector("#areachart"),
  optionsArea
);

chartArea.render();






});




window.Apex = {
  chart: {
    foreColor: '#ccc',
    toolbar: {
      show: false
    },
  },
  stroke: {
    width: 3
  },
  dataLabels: {
    enabled: false
  },
  tooltip: {
    theme: 'dark'
  },
  grid: {
    borderColor: "#535A6C",
    xaxis: {
      lines: {
        show: true
      }
    }
  }
};

var spark1 = {
  chart: {
    id: 'spark1',
    group: 'sparks',
    type: 'line',
    height: 80,
    sparkline: {
      enabled: true
    },
    dropShadow: {
      enabled: true,
      top: 1,
      left: 1,
      blur: 2,
      opacity: 0.2,
    }
  },
  series: [{
    data: [25, 66, 41, 59, 25, 44, 12, 36, 9, 21]
  }],
  stroke: {
    curve: 'smooth'
  },
  markers: {
    size: 0
  },
  grid: {
    padding: {
      top: 20,
      bottom: 10,
      left: 110
    }
  },
  colors: ['#fff'],
  tooltip: {
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function formatter(val) {
          return '';
        }
      }
    }
  }
}

var spark2 = {
  chart: {
    id: 'spark2',
    group: 'sparks',
    type: 'line',
    height: 80,
    sparkline: {
      enabled: true
    },
    dropShadow: {
      enabled: true,
      top: 1,
      left: 1,
      blur: 2,
      opacity: 0.2,
    }
  },
  series: [{
    data: [12, 14, 2, 47, 32, 44, 14, 55, 41, 69]
  }],
  stroke: {
    curve: 'smooth'
  },
  grid: {
    padding: {
      top: 20,
      bottom: 10,
      left: 110
    }
  },
  markers: {
    size: 0
  },
  colors: ['#fff'],
  tooltip: {
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function formatter(val) {
          return '';
        }
      }
    }
  }
}



var spark3 = {
  chart: {
    id: 'spark3',
    group: 'sparks',
    type: 'line',
    height: 80,
    sparkline: {
      enabled: true
    },
    dropShadow: {
      enabled: true,
      top: 1,
      left: 1,
      blur: 2,
      opacity: 0.2,
    }
  },
  series: [{
    data: []
  }],
  stroke: {
    curve: 'smooth'
  },
  markers: {
    size: 0
  },
  grid: {
    padding: {
      top: 20,
      bottom: 10,
      left: 110
    }
  },
  colors: ['#fff'],
  xaxis: {
    crosshairs: {
      width: 1
    },
  },
  tooltip: {
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function formatter(val) {
          return '';
        }
      }
    }
  }
}



var spark4 = {
  chart: {
    id: 'spark4',
    group: 'sparks',
    type: 'line',
    height: 80,
    sparkline: {
      enabled: true
    },
    dropShadow: {
      enabled: true,
      top: 1,
      left: 1,
      blur: 2,
      opacity: 0.2,
    }
  },
  series: [{
    data: []
  }],
  stroke: {
    curve: 'smooth'
  },
  markers: {
    size: 0
  },
  grid: {
    padding: {
      top: 20,
      bottom: 10,
      left: 110
    }
  },
  colors: ['#fff'],
  xaxis: {
    crosshairs: {
      width: 1
    },
  },
  tooltip: {
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function formatter(val) {
          return '';
        }
      }
    }
  }
}



new ApexCharts(document.querySelector("#spark1"), spark1).render();
new ApexCharts(document.querySelector("#spark2"), spark2).render();
new ApexCharts(document.querySelector("#spark3"), spark3).render();
new ApexCharts(document.querySelector("#spark4"), spark4).render();







