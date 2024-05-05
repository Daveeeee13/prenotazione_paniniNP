<?php 
session_start();
    if(!$_SESSION["AUTENTICATO"]=="ok"){
        header("Location: php/login.php");

    }

    if(isset($_POST["invio"])){
        
        try {

        $connessione = mysqli_connect("localhost", "root", "root", "panini");
        
        //$sql = "INSERT INTO prenotazioni (data_ritiro, username, `Panino con cotto`, `Pizza Margherita`, `Panino con soppressa`, `Panino con crudo`, `Panino con formaggio`, Brioche, plesso_ritiro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if(!isset($_GET["prenotato"])){
            $sql = "INSERT INTO prenotazioni (data_ritiro, username, panino_cotto, pizza_margherita, panino_soppressa, panino_crudo, panino_formaggio, brioche, plesso_ritiro) VALUES ('".
            $_POST["data"]."','".
            $_SESSION["USER"]."','".
            $_POST["panino_cotto"]."','".
            $_POST["pizza_margherita"]."','".
            $_POST["panino_soppressa"]."','".
            $_POST["panino_crudo"]."','".
            $_POST["panino_formaggio"]."','".
            $_POST["brioche"]."','".
            $_POST["plesso"]
            ."');";

        $risultato = $connessione->query($sql);
        $connessione->close();
        header("Location: risultato_prenotazione.php?data='$_POST[data]'&prenotato=ok");
        }/*else if(isset($_GET["data"])){

            $sql="SELECT n_prenotazione FROM prenotazioni WHERE data_ritiro='$_GET[data]'";
            $risultato = $connessione->query($sql);
            $connessione->close();
        }*/else{
            header("Location: index.php");
        }

        }catch (Exception $e) {
          
        }
    }


?>

<html>
<head><meta charset="utf-8">

    <title>Bar NP - Risultato Prenotazione</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>

<body onload="">
    <div class="login-container">
        <h2>Prenotazione effettuata correttamente</h2>
        
        <button><a href="prenotazioni.php">Visualizza tutti i tuoi ordini</a></button>
    </div>
</body>
</html>




