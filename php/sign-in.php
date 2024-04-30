<html>
<head>
    <title>Bar NP - Sign-in</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/login.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        function redirectAccount(){
            var url="login.php";
            window.location.href = url; 
        }
    </script>
</head>


<?php
if (isset($_POST["sign-in"])) {
    try {
        $connessione = mysqli_connect("localhost", "root", "root", "progettoinglese");

       
        $sql = "INSERT INTO utente (username, pwd, email, nome, cognome, nome_scuola, ruolo, data_registrazione) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = mysqli_prepare($connessione, $sql);
        $role = "user";

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssss", $_POST["username"], $_POST["password"], $_POST["email"], $_POST["name"], $_POST["surname"], $_POST["school_name"], $role);

            mysqli_stmt_execute($stmt);
        }
        mysqli_close($connessione);
    } catch (Exception $e) {
    }

    header("Location: registered.html");
    exit();
}

?>

<body>

<div class="login-container">
    <h2>Sign in</h2>
    <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
        <input required type="text" name="username" placeholder="Your username"><br><br>
        <input required type="email" name="email" placeholder="Your email"><br><br>
        <input required type="password" name="password" placeholder="Your password"><br><br>
        <input required type="text" name="name" placeholder="Your name"><br><br>
        <input required type="text" name="surname" placeholder="Your surname"><br><br>
        <input required type="text" name="school_name" placeholder="School name"><br><br>
        <input style="background-color:#DAF7A6" name="sign-in" type="submit" value="Sign In">
    </form>
    <button style="background-color:gray" type="submit" name="redirectAccount" onclick="redirectAccount();">Or login</button>
</div>

</body>
</html>



