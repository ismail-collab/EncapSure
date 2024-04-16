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
  
  <title>User Page</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">

  
  
  
</head>
<body>
  
<section data-bs-version="5.1" class="menu menu1 cid-twSaooDyQA" once="menu" id="menu1-w">
    

    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="Home_page">
                        <img src="assets/images/3d-cube.png" alt="Logo" style="height: 3rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white text-primary display-7" href="Home_page">Insurance Company</a></span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
			  <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="Home_page">Profile</a></li>  <!--To change the link not valid page -->
			  <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="Settings_page">Settings</a></li>
                    <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="Home_page#features1-1i">Dashboard</a></li> <!--To change the link not valid page -->
                    <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="Home_page#contacts2-1r">Something else</a> <!--To change the link not valid page -->
                    </li></ul>
                
                <div class="navbar-buttons mbr-section-btn"><a class="btn btn-secondary display-4" href="Home_page"><span class="mobi-mbri mobi-mbri-logout mbr-iconfont mbr-iconfont-btn"></span>Logout</a></div>
            </div>
        </div>
    </nav>
</section>

<form action="DownFiles" method="POST">
    <?php echo csrf_field(); ?>
    <br>
    <br>
    <span>Download Devis PDF</span>
    <button type="submit" id="down_btn" name="down_btn">Download</button>
    </div>
</form>
  
  <script>

$(document).ready(function(e) {
        $('#down_btn').click(function(){
            var myTimeout = setTimeout(PageReload, 3000);


            function PageReload(){
                window.location.href='http://127.0.0.1:8000/Subs';
            }
            
            console.log("click");
            
        });

    });

  </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/ClientFileDownload.blade.php ENDPATH**/ ?>