<?php
session_start();
require_once __DIR__ . '/database_connection.php';

// login logic
if(isset($_POST['login_btn'])){

    $uname = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    // se i campi email e password non sono vuoti
    if ($uname != "" && $password != ""){

        // verifico se l'email è registrata nel db
        $sql_query1 = "select count(*) as cntUser from utenti where email='".$uname."'";
        $result1 = mysqli_query($conn,$sql_query1);
        $row = mysqli_fetch_array($result1);

        $count = $row['cntUser'];
        // se l'email è corretta
        if($count > 0){
            // verifico che anche la password sia registrata
            $sql_query2 = "select count(*) as cntUser from utenti where email='".$uname."' and password='".$password."'";
            $result2 = mysqli_query($conn,$sql_query2);
            $row2 = mysqli_fetch_array($result2);

            $count2 = $row2['cntUser'];
            // se email e password sono corrette accedo
            if($count2 > 0){
                $_SESSION['uname'] = $uname;
                header('Location: home.php');
            }else{
                echo "Password non riconosciuta";
            }
        }else{
            echo "Email non riconosciuta";
        }

    }else {
        echo "Per accedere inserire sia email che password";
    }

}

// Password reset logic
if(isset($_POST['reset_btn'])){

    $uname = mysqli_real_escape_string($conn,$_POST['email']);

    if ($uname != ""){

        $sql_query = "select count(*) as cntUser from utenti where email='".$uname."'";
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
            // se l'email è presente nel db invio email con link di reset
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <!-- email input -->
                    <label for="email">Inserisci l'e-mail</label>
                    <input class="input_field_style" type="text" name="email" id="email" placeholder="name@example.com">
                    <!-- password input -->
                    <div class="eye">
                        <label for="password">Inserisci la password</label>
                        <input class="input_field_style" type="password" name="password" id="password" placeholder="Scrivila qui">
                        <i class="fa-solid fa-eye" id="togglePassword"></i>
                    </div>
                    <!-- submit button -->
                    <input class="blue_btn access_btn" type="submit" value="ACCEDI" name="login_btn" id="login_btn">
                    <!-- password reset button -->
                    <input class="red_btn access_btn" type="submit" value="Reimposta Password" name="reset_btn" id="reset_btn">
                </form>
                <div class="invite">Non hai ancora un profilo? <a href="register.php">Registrati</a> </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="assets\js\script.js"></script>
</body>
</html>