<?php
require_once __DIR__ . '/database_connection.php';


// Register user
if(isset($_POST['overwrite_btn'])){
   $email = trim($_POST['email']);
   $password = trim($_POST['password']);

   $isValid = true;

   // Check fields are empty or not
   if($email == '' || $password == ''){
     $isValid = false;
     echo "Si prega di riempire tutti i campi.";
   }

   // Check if Email-ID is valid or not
   if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $isValid = false;
     echo "Email invalida.";
   }

   if($isValid){

     // Check if Email-ID already exists
     $stmt = $conn->prepare("SELECT * FROM utenti WHERE email = ?");
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $result = $stmt->get_result();
     $stmt->close();
     if($result->num_rows > 0){
        // Overwriting password
        $insertSQL = "UPDATE utenti SET password = ? WHERE email= ?";
        $stmt = $conn->prepare($insertSQL);
        $stmt->bind_param("ss",$password,$email);
        $stmt->execute();
        $stmt->close();
   
        echo "Nuova password salvata con successo."; 
     } else {
       $isValid = false;
       echo "L'email inserita non è già registrata.";
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
    <title>EduSogno - Reimposta password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets\styles\style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        <div class="title">Reimposta la password</div>
        <div class="container">
            <!-- Reset mask -->
            <div class="login_card">
                <form method="post" action="">
                    <!-- username input -->
                    <label for="email">Inserisci l'e-mail</label>
                    <input class="input_field_style" type="text" name="email" id="email" placeholder="name@example.com">
                    <!-- password input -->
                    <label for="password">Inserisci la nuova password</label>
                    <input class="input_field_style" type="text" name="password" id="password" placeholder="Scrivila qui">
                    <!-- submit button -->
                    <input class="blue_btn access_btn" type="submit" value="Salva nuova password" name="overwrite_btn" id="overwrite_btn">
                </form>
                <div class="invite">Vuoi reigstrare un altro profilo? <a href="register.php">Registrati</a> </div>
            </div>
        </div>
    </main>
</body>
</html>