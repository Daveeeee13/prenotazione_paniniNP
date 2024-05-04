<?php 
session_start();
    if(!$_SESSION["AUTENTICATO"]=="ok"){
        header("Location: php/login.php");

    }

    if(isset($_POST["invio"]) or isset($_GET["prenotato"])){
        
        try {

        $connessione = mysqli_connect("localhost", "root", "root", "panini");
        
        $sql = "INSERT INTO prenotazioni (data_ritiro, username, Panino con cotto, Pizza Margherita, Panino con soppressa, Panino con crudo, Panino con formaggio, Brioche, plesso_ritiro) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($connessione, $sql);

            if ($stmt) {
                //sss indica che sono 3 stringhe
                mysqli_stmt_bind_param($stmt, "sssssssss", $_POST["data"], $_SESSION["USER"], $_POST["Panino con cotto"], $_POST["Pizza Margherita"], $_POST["Panino con soppressa"], $_POST["Panino con crudo"], $_POST["Panino con formaggio"], $_POST["Brioche"] , $_POST["plesso"]);

                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                //prelevo n_prenotazione assegnata con l'auto increment nel db per stamparla poi nel sito
                $sql = "SELECT n_prenotazione FROM prenotazioni WHERE n_prenotazione='$_POST[data]';";
                $risultato = $connessione->query($sql);
                $riga=$risultato->fetch_assoc();
                $n = $riga['n_prenotazione'];
                $connessione->close();
                header("Location: risultato_prenotazione.php?numero_prenotazione=$n&prenotato=ok");
                exit();
            }
        }catch (Exception $e) {
          
        }

?>

<html>
<head><meta charset="utf-8">

    <title>Bar NP - Risultato Prenotazione</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>

<body onload="">
    <div class="login-container">
        <h2>Prenotazione effettuata correttamente a numero <?php //echo $_GET["numero_prenotazione"]?></h2>
        
        <button><a href="prenotazioni.php">Visualizza tutti i tuoi ordini</a></button>
    </div>
</body>
</html>
<?php 
}else{
    header("Location: index.php");

}
?>



