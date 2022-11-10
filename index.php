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
if(isset($_POST['reset_btn'])){

    $uname = mysqli_real_escape_string($conn,$_POST['email']);

    if ($uname != ""){

        $sql_query = "select count(*) as cntUser from utenti where email='".$uname."'";
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
            // invio email
            $to = "$uname";
            $subject = "Reimposta la password di Edusogno";
            
            $message = "<b>Clicca sul link per reimpostare la password di Edusogno.</b>";
            $message .= "<a href=\"http://localhost:8888/edusogno-esercizio/reset_password.php\">Reimposta la password.</a>";
            
            $headers = "From:info@edusogno.com \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html\r\n";
            
            $retval = mail($to,$subject,$message,$headers);
            if( $retval == true ) {
                echo "Message sent successfully...";
            }else {
                echo "Message could not be sent...";
            }
        }else{
            echo "L'indirizzo email non risulta registrato";
        }

    }else{
        echo "Inserire indirizzo email a cui sarà inviato il link per reimpostare la password";
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
                    <!-- password reset button -->
                    <input class="red_btn access_btn" type="submit" value="Reimposta Password" name="reset_btn" id="reset_btn">
                </form>
                <div class="invite">Non hai ancora un profilo? <a href="register.php">Registrati</a> </div>
            </div>
        </div>
    </main>
</body>
</html>