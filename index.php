<?php
session_start();
require_once __DIR__ . '/database_connection.php';

if(isset($_POST['login_btn'])){

    $uname = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    if ($uname != "" && $password != ""){

        $sql_query = "select count(*) as cntUser from utenti where email='".$uname."' and password='".$password."'";
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
            header('Location: home.php');
        }else{
            echo "Email e password invalide";
        }

    }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSogno</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets\styles\style.css">
</head>
<body>
    <!-- Header section -->
    <header>
        <div class="logo">
            <a href="index.php"><img src="assets\img\logo.jpg" alt="Edusogno logo"></a>
        </div>
    </header>

    <!-- Main section -->
    <main>
        <div class="title">Hai già un account?</div>
        <div class="container">
            <!-- Login mask -->
            <div class="login_card">
                <form method="post" action="">
                    <!-- username input -->
                    <label for="email">Inserisci l'e-mail</label><br>
                    <input class="input_field_style" type="text" name="email" id="email" placeholder="name@example.com"><br>
                    <!-- password input -->
                    <label for="password">Inserisci la password</label><br>
                    <input class="input_field_style" type="password" name="password" id="password" placeholder="Scrivila qui"><br>
                    <!-- submit button -->
                    <input class="blue_btn access_btn" type="submit" value="ACCEDI" name="login_btn" id="login_btn">
                </form>
                <div class="invite">Non hai ancora un profilo? <a href="register.php">Registrati</a> </div>
            </div>
        </div>
    </main>
</body>
</html>