<!DOCTYPE html>

<?php 
session_start();
if(!$_SESSION["AUTENTICATO"]=="ok"){
    header("Location: php/login.php");

}
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Prenotazione - NewtonPertini</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Delicious
  * Template URL: https://bootstrapmade.com/delicious-free-restaurant-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
      <i class="bi bi-phone d-flex align-items-center"><span>+39 boh</span></i>
      <i class="bi bi-clock ms-4 d-none d-lg-flex align-items-center"><span>Lun-Sab: 10:40 - 10:55</span></i>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <div class="logo me-auto">
        <h1><a href="index.html">Bar NP</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#menu">Menu</a></li>
          <li><a class="nav-link scrollto" href="#book-a-table">Prenota</a></li>
          <li><a class="nav-link scrollto" href="prenotazioni.php">Prenotazioni attive</a></li>
          <?php 
          //controllo se l'utente è amministratore, per far comparire il menu a discesa dedicato all'amministrazione
                  if($_SESSION["RUOLO"]=="admin"){
                    ?>

                    <li class="dropdown"><a href="#"><span>Amministrazione</span> <i class="bi bi-chevron-down"></i></a>
                                <ul>
                                  <li><a href="admin/aggiungi_prodotto.php">Aggiungi Prodotto</a></li>
                                  <li><a href="admin/modifica_prodotto.php">Modifica Listino</a></li>
                                  <li><a href="admin/rimuovi_prodotto.php">Rimuovi Prodotto</a></li>
                                  <li><a href="admin/visualizza_prenotazioni.php">Visualizza Prenotazioni</a></li>
                                  <li><a href="admin/blacklista_utente.php">Blacklista utente</a></li>
                                  <li><a href="admin/registra_utente.php">Registra Utente</a></li>
                                  <li><a href="admin/visualizza_utenti.php">Visualizza Utenti</a></li>
                                </ul>
                              </li>

                  <?php
                  }
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="php/logout.php" class="book-a-table-btn scrollto">Logout</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url(assets/img/sandwich.jpg);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown"><span>Bar</span> NewtonPertini</h2>
                <p class="animate__animated animate__fadeInUp">Gusta le nostre prelibatezze</p>
                <div>
                  <a href="#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Menu</a>
                  <a href="#book-a-table" class="btn-book animate__animated animate__fadeInUp scrollto">Prenota!</a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
      <div class="container">

        <div class="section-title">
          <h2>Consulta il nostro <span>Menu</span></h2>
        </div>

        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="menu-flters">
              <li data-filter="*" class="filter-active">Mostra tutto</li>
              <li data-filter=".filter-panino">Panini</li>
              <li data-filter=".filter-brioche">Brioche</li>
              <li data-filter=".filter-pizza">Pizze</li>
            </ul>
          </div>
        </div>

        <div class="row menu-container">

        <?php 
         try {
          $connessione = mysqli_connect("localhost", "root", "root", "panini");
          
          $sql = "SELECT * FROM listino;";
          
          $risultato = $connessione->query($sql);
              while ($array = mysqli_fetch_assoc($risultato)) {
                //echo $array["tipo"];
                  //print_r($array);
                  ?>
                 
                 <div class="col-lg-6 menu-item <?php echo "filter-".$array["tipo"] ?>">
                        <div class="menu-content">
                          <a href="#"><?php echo $array["nome"]?></a><span>€<?php echo $array["prezzo"]?></span>
                        </div>
                        <div class="menu-ingredients">
                          <?php echo $array["ingredienti"]?>
                        </div>
                      </div>
                  <?php
              }
        }catch (Exception $e) {
          
      }
        ?>

        </div>

      </div>
    </section><!-- End Menu Section -->

    <!-- ======= Book A Table Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container">

        <div class="section-title">
          <h2>Effettua la <span>prenotazione</span> . . .</h2>
          <p>. . . e sei sicuro di mangiare!</p>
        </div>

        <form action="risultato_prenotazione.php" method="post">
        <div class="row">
            <div class="text-center" class="col-lg-4 col-md-6 form-group mt-3">
              <input required type="date" class="form-control" name="data" id="data" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" placeholder="Scegli la data del ritiro...">
              <div class="validate"></div>
            </div>
            
          </div>
          <!--<div class="form-group mt-3">
            <textarea class="form-control" name="messaggio" rows="5" placeholder="Inserisci qui la prenotazione seguendo il formato 'quantità prodotto,'&nbsp;Es: 3 panini prosciutto cotto, 1 pizza"></textarea>
            <div class="validate"></div>
          </div>-->
      <br>
          <?php 
          
          try {
            $connessione = mysqli_connect("localhost", "root", "root", "panini");
            
            $sql = "SELECT * FROM listino;";
            
            $risultato = $connessione->query($sql);
                while ($array = mysqli_fetch_assoc($risultato)) {
                  
                  echo $array["nome"]." : " ?>
                  <select name=<?php echo $array["nome_gestionale"]?>>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                  </select><br></br>

                  <?php
                }
          }catch (Exception $e) {
            
        }
          
          ?>


          <div class="form-group mt-3">
      <b>Plesso presso la quale ritirare l'ordine: </b>
            <select name="plesso">
              <option value="Newton">Newton</option>
              <option value="Pertini">Pertini</option>
            </select>
            <div class="validate"></div>
          </div>
          <div class="mb-3">
          </div>
          <div class="text-center"><button style="background: #ffa012; border: 0; padding: 10px 24px; border-radius: 50px;" type="submit" name="invio">Effettua la prenotazione</button></div>
        </form>


      </div>
    </section><!-- End Book A Table Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>Bar NewtonPertini</h3>
      <p>Prodotti offerti da nomeAzienda</p>
      <div class="social-links">
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>Bar NewtonPertini</span></strong>.
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/delicious-free-restaurant-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>,
        Developed by <a href="https://carrarodavide.it">Davide Carraro</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>