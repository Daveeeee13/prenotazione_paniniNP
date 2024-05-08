<?php

session_start();

if(isset($_SESSION["AUTENTICATO"]) and $_SESSION["AUTENTICATO"]=="ok"){
                    
    header("Location: ../index.php");
    
}

if (isset($_POST["login"])) {
    try {
        $connessione = mysqli_connect("localhost", "root", "root", "panini");

        // Prevenzione SQL injection
        $username = mysqli_real_escape_string($connessione, $_POST["username"]);
        $password = mysqli_real_escape_string($connessione, $_POST["password"]);

        // Query SQL per il login
        $sql = "SELECT * FROM utente WHERE username='$username' AND pwd='$password'";
        $risultato = $connessione->query($sql);
        $arr = $risultato->fetch_assoc();

        if ($risultato && $risultato->num_rows > 0 && $arr["blacklist"]=="no") {
            // Utente trovato, imposto le variabili di sessione
            $_SESSION["AUTENTICATO"] = "ok";
            $_SESSION["USER"] = $username;
            $_SESSION["RUOLO"]=$arr["ruolo"];

            $connessione->close();

            header('Location: ../index.php');
            exit();
        } else {
            // Utente non trovato, reindirizzo alla pagina di login
            header('Location: login.php');
            exit();
        }
    } catch (Exception $e) {
        // Gestione eccezioni
    }
}

?>

<html>
<head>
    <title>Bar NP - Login</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/login.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        function redirectAccount(){
            var url="sign-in.php";
            window.location.href = url; 
        }
    </script>

</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input required type="text" name="username" placeholder="Username"><br><br>
        <input required type="password" name="password" placeholder="Password"><br><br>
        <input style="background-color:#DAF7A6" name="login" type="submit" value="Login">
    </form>
    <!--<button style="background-color:gray" type="submit" name="redirectAccount" onclick="redirectAccount();">o registra un account</button>-->
</div>

</body>
</html>