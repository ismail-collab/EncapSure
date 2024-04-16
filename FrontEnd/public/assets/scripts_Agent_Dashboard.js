// Déclaration des variables pour stocker les éléments HTML. 
var devis = document.getElementById("dev_g");
var subs = document.getElementById("sub_g");

// Définition de HttpClient pour effectuer des requêtes HTTP
var HttpClient = function(){
    // Cette méthode fait une requête HTTP POST asynchrone à une URL spécifiée
  this.get = function(Reqdata, aUrl, aCallback) {
      var anHttpRequest = new XMLHttpRequest();
      anHttpRequest.onreadystatechange = function() {
              // Si la requête est complète et le statut est OK, appelez la fonction de rappel avec la réponse.
          if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
          aCallback(anHttpRequest.responseText);
      }
      anHttpRequest.open("POST",aUrl,true);
      anHttpRequest.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
      anHttpRequest.send(JSON.stringify(Reqdata));
  }
}


// Création d'un nouvel HttpClient et récupération des informations sur la simulation
var client= new HttpClient();
client.get(null,'http://localhost:9090/siminfo', function (response) { 

// Analyse de la réponse JSON en un objet JavaScript
var resp = JSON.parse(response);
  console.log(resp);

// Configuration du graphique Sparkline à l'aide de la bibliothèque ApexCharts
  var spark1 = {
    chart: {
      id: 'sparkline1',
      type: 'line',
      height: 50,
      sparkline: {
        enabled: true
      },
      group: 'sparklines'
    },
    series: [{
      name: 'purple',
      data: []
    }],
    stroke: {
      curve: 'smooth'
    },
    markers: {
      size: 0
    },
    tooltip: {
      fixed: {
        enabled: true,
        position: 'right'
      },
      x: {
        show: false
      }
    },
    title: {
      text: resp[0]['devis_cancel'],
      style: {
        fontSize: '26px'
      }
    },
    colors: ['#734CEA']
  }

  new ApexCharts(document.querySelector("#spark1"), spark1).render();

});



var url='http://localhost:9090/devisinfo';




// Récupération des statistiques de devis
function StatsAPI() {
  return new Promise((resolve, reject) => {

    var totalsub = 0;  //initialisation de souscription
    var totaldev = 0;  //initialisation de devis 

    // Faire une requête HTTP et analyser les données reçues
    client.get(null,url, function (response) {

    var resp = JSON.parse(response);
    console.log(resp);
    
    var total = resp.length; // total des devis et souscription
    var condevis = 0; // nombre totale de devis 

    var packs = ['Securité','Securité-Plus','Serenité'];
    var packnum = [0,0,0];
    var max = "";
    
    totaldev = resp.length;
    
    for (var i=0; i<resp.length; i++) {
    
      if (resp[i]['devis_doc']!=null) {
        condevis++;
      } 

      if (resp[i]['pack']==1) {
        packnum[0]++; // increment de pack 1
      }
      else if (resp[i]['pack']==2) {
        packnum[1]++; // increment de pack 2
      }
      else {
        packnum[2]++; // increment de pack 3
      }
    
    }
    
    if (packnum[0]>packnum[1] && packnum[0]>packnum[2]) {
      max="Securité"; // sécurité la plus choisie 
    }
    else if (packnum[1]>packnum[0] && packnum[1]>packnum[2]) {
      max="Securité Plus"; // securité plus la plus choisie 
    }
    else {
      max="Serenité"; // serenite la plus choisie
    }

    
    
    

// Calculs et configuration du graphique en fonction des données reçues 
    var spark2 = {
      chart: {
        id: 'sparkline2',
        type: 'line',
        height: 50,
        sparkline: {
          enabled: true
        },
        group: 'sparklines'
      },
      series: [{
        name: 'green',
        data: []
      }],
      stroke: {
        curve: 'smooth'
      },
      markers: {
        size: 0
      },
      tooltip: {
        fixed: {
          enabled: true,
          position: 'right'
        },
        x: {
          show: false
        }
      },
      title: {
        text: condevis,
        style: {
          fontSize: '26px'
        }
      },
      colors: ['#34bfa3']
    }


    
var optionsDonutTop = {
  chart: {
    height: 265,
    type: 'donut',
    offsetY: 20
  },
  plotOptions: {
    pie: {
      customScale: 0.86,
      donut: {
        size: '72%',
      },
      dataLabels: {
        enabled: false
      }
    }
  },
  colors: ['#775DD0', '#00C8E1', '#FFB900'],
  title: {
    text: 'La Formule de Garantie la plus choisie : '+ max
  },
  series: packnum, // alimentation de graphique 
  labels: packs, // alimentation de graphique 
  legend: {
    show: true
  }
}

var chartDonut2 = new ApexCharts(document.querySelector('#donutTop'), optionsDonutTop);
chartDonut2.render().then(function () {
  // window.setInterval(function () {
  //   chartDonut2.updateSeries([getRandom(), getRandom(), getRandom()])
  // }, 1000)
});



  
    new ApexCharts(document.querySelector("#spark2"), spark2).render();
     
    resolve(totaldev);
    });
  });
}


// Récupération des statistiques d'abonnements
function SubsAPI() {
  return new Promise((resolve, reject) => {
    var subs = 0;
    var money = 0;
var total = 0;

var chiffres = [];
var dates = [];

    client.get(null, 'http://localhost:9090/substats', function (response) {
      var resp = JSON.parse(response);


      subs=resp.length;
      console.log('in subs api');

      for (var i=0; i<resp.length;i++) {

        money = money + 1;
        total = total + 1;

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


// Analyser les données et générer le graphique Area   
  var optionsArea = {
    chart: {
      height: 421,
      type: 'area',
      background: '#fff',
      stacked: true,
      offsetY: 39,
      zoom: {
        enabled: false
      }
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: false
        }
      }
    },
    stroke: {
      curve: 'straight'
    },
    colors: ["#3F51B5", '#2196F3'],
    series: [{
        name: "Nombre de souscriptions",
        data: chiffres
      }
    ],
    fill: {
      type: 'gradient',
      gradient: {
        inverseColors: false,
        shade: 'light',
        type: "vertical",
        opacityFrom: 0.9,
        opacityTo: 0.6,
        stops: [0, 100, 100, 100]
      }
    },
    title: {
      text: 'Nombre de souscriptions effectuées : ' + resp.length,
      align: 'left',
      offsetY: -5,
      offsetX: 20
    },
    markers: {
      size: 0,
      style: 'hollow',
      strokeWidth: 8,
      strokeColor: "#fff",
      strokeOpacity: 0.25,
    },
    grid: {
      show: false,
      padding: {
        left: 35,
        right: 15
      }
    },
    yaxis: {
      type: 'number'
    },
    labels: dates,
    xaxis: {
      type: 'date',
      tooltip: {
        enabled: false
      }
    },
    legend: {
      offsetY: -50,
      position: 'top',
      horizontalAlign: 'right'
    }
  }


  var chartArea = new ApexCharts(document.querySelector('#area-adwords'), optionsArea);
  chartArea.render();
  
      resolve(subs);
    });
  });
}


////////////////////////////////////////////////// STATS CHECK ///////////////////////////////////////////

// Vérification des statistiques
async function StatsCheck() {
  var numdev = await StatsAPI();
  var numsub = await SubsAPI();
  console.log(numdev+"/"+numsub+ " in the async");

  var final = (numsub/numdev)*100;

// Générer le graphique Radial Bar avec les résultats calculés
  var optionsCircle1 = {
    chart: {
      type: 'radialBar',
      height: 266,
      width: 600,
      zoom: {
        enabled: false
      },
      offsetY: 10
    },
    colors: ['#E91E63'],
    plotOptions: {
      radialBar: {
        dataLabels: {
          name: {
            show: false
          },
          value: {
            offsetY: 0
          }
        }
      }
    },
    series: [final.toFixed(2)],
    theme: {
      monochrome: {
        enabled: false
      }
    },
    legend: {
      show: false
    },
    title: {
      text: 'Conversion de devis en souscriptions',
      align: 'center'
    }
  }
  
  var chartCircle1 = new ApexCharts(document.querySelector('#radialBar1'), optionsCircle1);
  chartCircle1.render();


  return final;
 
}




// Attendez que la page ait complètement chargé avant d'appeler la fonction StatsCheck
window.addEventListener("load", async function () {
  StatsCheck();
});


// Configuration globale ApexCharts pour désactiver les étiquettes de données
window.Apex = {
  dataLabels: {
    enabled: false
  }
};


