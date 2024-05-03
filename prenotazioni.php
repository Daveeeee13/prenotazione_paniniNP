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

  <title>Bar NP - I tuoi ordini</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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
  <section id="topbar" class="d-flex align-items-center fixed-top ">
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
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <?php 
          //controllo se l'utente è amministratore, per far comparire il menu a discesa dedicato all'amministrazione
              try {
                if($_SESSION["AUTENTICATO"]=="ok"){
                  $connessione = mysqli_connect("localhost", "root", "root", "panini");
                
                  $sql = "SELECT * FROM utente WHERE username='$_SESSION[USER]';";
                  
                  $risultato = $connessione->query($sql);
                  $array=$risultato->fetch_assoc();

                  if($array["ruolo"]=="admin"){
                    ?>

                          <li class="dropdown"><a href="#"><span style="color: black;">Amministrazione</span> <i class="bi bi-chevron-down"></i></a>

                                <ul>
                                  <li><a href="#">Drop Down 1</a></li>
                                  <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                    <ul>
                                      <li><a href="#">Deep Drop Down 1</a></li>
                                      <li><a href="#">Deep Drop Down 2</a></li>
                                      <li><a href="#">Deep Drop Down 3</a></li>
                                      <li><a href="#">Deep Drop Down 4</a></li>
                                      <li><a href="#">Deep Drop Down 5</a></li>
                                    </ul>
                                  </li>
                                  <li><a href="#">Drop Down 2</a></li>
                                  <li><a href="#">Drop Down 3</a></li>
                                  <li><a href="#">Drop Down 4</a></li>
                                </ul>
                              </li>

                    <?php
                  }

                }
                
              }catch (Exception $e) {
                
              }

          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="php/logout.php" class="book-a-table-btn scrollto">Logout</a>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Lista Prenotazioni</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Prenotazioni Eseguite</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
      <div class="container">
      <?php
	// Qui il ciclo di lettura delle righe del file e corrispondente creazione delle
	// righe della tabella.
	try {
		//al posto di localhost solitamente si inserisce l'IP
		$connessione = mysqli_connect("localhost", "root", "root", "panini");
		//query 
		$sql ="SELECT * FROM prenotazioni WHERE username='$_SESSION[USER]'";  
	
		$risultato = $connessione->query($sql);
		$num_righe = $risultato->num_rows;
		if ($num_righe > 0) {
			echo "<table id='utenti' class='tabella'>
				<tr>
					<th>N° prenotazione (per ritiro)</th>
					<th>Data ritiro</th>
					<th>Contenuto</th>
				</tr>";
			while ($arr = $risultato->fetch_assoc()) {
				$riga="<tr><td>".$arr['n_prenotazione']."'</td><td>".$arr["data_ritiro"]."</td><td>".$arr["messaggio"]."</td></tr>";
				echo $riga;
			}
			echo "</table>";
		}
	}
	catch (Exception $e) {
	}
	if (!empty($msg))
		echo $msg;
?>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>Delicious</h3>
      <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
      <div class="social-links">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>Delicious</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/delicious-free-restaurant-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
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