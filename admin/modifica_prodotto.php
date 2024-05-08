<!DOCTYPE html>
<?php 
session_start();
if((!$_SESSION["AUTENTICATO"]=="ok") or !$_SESSION["RUOLO"]=="admin"){
    header("Location: php/login.php");

}
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bar NP - Modifica Prodotto</title>

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

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
                                  <li><a href="aggiungi_prodotto.php">Aggiungi Prodotto</a></li>
                                  <li><a href="modifica_prodotto.php">Modifica Listino</a></li>
                                  <li><a href="rimuovi_prodotto.php">Rimuovi Prodotto</a></li>
                                  <li><a href="visualizza_prenotazioni.php">Visualizza Prenotazioni</a></li>
                                  <li><a href="blacklista_utente.php">Blacklista utente</a></li>
                                  <li><a href="registra_utente.php">Registra Utente</a></li>
                                  <li><a href="visualizza_utenti.php">Visualizza Utenti</a></li>
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
          <h2>Modifica prodotto</h2>
          <ol>
            <li><a href="../index.php">Home</a></li>
            <li>Modifica Prodotto</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
      <div class="container">
      <?php

	

    //se non è cliccato il pulsante stampa tutti gli utenti
    if(!isset($_GET["id"])){
      try {
      $connessione = mysqli_connect("localhost", "root", "root", "panini");
      $sql ="SELECT * FROM listino";  
    
      $risultato = $connessione->query($sql);
      $num_righe = $risultato->num_rows;
      if ($num_righe > 0) {
        echo "<table id='utenti' class='tabella'>
          <tr>
            <th>id</th>
            <th>Nome</th>
            <th>Ingredienti</th>
            <th>Quantità</th>
            <th>Prezzo</th>
            <th>Tipo</th>
          </tr>";
        while ($arr = $risultato->fetch_assoc()) {
          //questo controllo serve per controllare se l'utente è blacklistato o no, facendo così l'immagine cambierà a seconda se l'utente è blacklistato o meno
            $riga="<tr><td>".$arr['id']."</td><td>".$arr['nome']."</td><td>".$arr["ingredienti"]."</td><td>".$arr["quantita"]."</td><td>".$arr["prezzo"]."</td><td>".$arr["tipo"]."</td><td><a href='modifica_prodotto.php?id=$arr[id]'><img src='../assets/img/modify.png'/></a></td></tr>";
            echo $riga;
        }
        echo "</table>";
      }
      $connessione->close();
    }
    catch (Exception $e) {
    }
		
	}
        //se ho cliccato l'id, prende dal DB le informazioni corrispondenti a quell'id nella tabella e mi precompila il form
        try{
        if (isset($_GET["id"])) {
          $connessione = mysqli_connect("localhost", "root", "root", "panini");
          $sql ="SELECT id, nome, nome_gestionale, quantita, ingredienti, prezzo, tipo FROM listino WHERE id='$_GET[id]'"; 
          $risultato = $connessione->query($sql); 
          $arr = $risultato->fetch_assoc();
        ?>

        <form action="modifica_prodotto.php" method="post">
        <div class="row">
            <div class="text-center" class="col-lg-4 col-md-6 form-group mt-3">
              ID: <input disabled type="number" name="id" value="<?php echo $arr["id"]?>">
              <div class="validate"></div>
            </div>
          </div>

        <div class="row">
            <div class="text-center" class="col-lg-4 col-md-6 form-group mt-3">
              Nome: <input type="text" name="nome" value="<?php echo $arr["nome"]?>">
              <div class="validate"></div>
            </div>
          </div>

          <div class="row">
            <div class="text-center" class="col-lg-4 col-md-6 form-group mt-3">
              Nome Gestionale: <input type="text" name="nome_gestionale" value="<?php echo $arr["nome_gestionale"]?>">
              <div class="validate"></div>
            </div>
          </div>

          <div class="row">
            <div class="text-center" class="col-lg-4 col-md-6 form-group mt-3">
              Quantità: <input type="number" name="quantita" value="<?php echo $arr["quantita"]?>">
              <div class="validate"></div>
            </div>
          </div>

          <div class="row">
            <div class="text-center" class="col-lg-4 col-md-6 form-group mt-3">
              Ingredienti: <input type="text" name="ingredienti" value="<?php echo $arr["ingredienti"]?>">
              <div class="validate"></div>
            </div>
          </div>

          <div class="row">
            <div class="text-center" class="col-lg-4 col-md-6 form-group mt-3">
              Prezzo: <input type="text" name="prezzo" value="<?php echo $arr["prezzo"]?>">
              <div class="validate"></div>
            </div>
          </div>
          <div class="form-group mt-3">
          <div class="text-center" class="col-lg-4 col-md-6 form-group mt-3">
      Tipo:
            <select name="tipo">
              <option value="panino">Panino</option>
              <option value="brioche">Brioche</option>
              <option value="pizza">Pizza</option>
            </select>
            <div class="validate"></div>
            </div>
          </div>
          <div class="mb-3">
          </div>
          <div class="text-center"><button style="background: #ffa012; border: 0; padding: 10px 24px; border-radius: 50px;" type="submit" name="invio">Modifica Prodotto</button></div>
        </form>


        <?php

          $connessione->close();
        }	
      }catch (Exception $e) {
      }

      
      //form aggiornato, update nel DB
      if(isset($_POST["invio"])){
        try {
          $connessione = mysqli_connect("localhost", "root", "root", "panini");
          $sql = "UPDATE listino SET nome='$_POST[nome]', nome_gestionale='$_POST[nome_gestionale]', quantita='$_POST[quantita]', ingredienti='$_POST[ingredienti]', prezzo='$_POST[prezzo]', tipo='$_POST[tipo]' WHERE id='$_POST[id]';";
            
          $connessione->query($sql);

        }
        catch (Exception $e) {

        }
        $connessione->close();
        //header('Location: modifica_prodotto.php');
      }



?>


      </div>
    </section>

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