<?php
require_once __DIR__ . '/database_connection.php';


// Register user
if(isset($_POST['signup_btn'])){
   $nome = trim($_POST['nome']);
   $cognome = trim($_POST['cognome']);
   $email = trim($_POST['email']);
   $password = trim($_POST['password']);

   $isValid = true;

   // Check fields are empty or not
   if($nome == '' || $cognome == '' || $email == '' || $password == ''){
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
       $isValid = false;
       echo "L'email inserita è già registrata.";
     }

   }

   // Insert records
   if($isValid){
     $insertSQL = "INSERT INTO utenti(nome,cognome,email,password ) values(?,?,?,?)";
     $stmt = $conn->prepare($insertSQL);
     $stmt->bind_param("ssss",$nome,$cognome,$email,$password);
     $stmt->execute();
     $stmt->close();

     echo "Account creato con successo.";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno - Registrazione</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <div class="title">Crea il tuo account</div>
        <div class="container">
            <!-- Login mask -->
            <div class="login_card">
            <form method='post' action=''>

                <!-- name input -->
                <div class="form-group">
                <label for="nome">Inserisci il nome</label>
                <input type="text" class="form-control input_field_style" name="nome" id="nome" placeholder="Mario" required="required" maxlength="80">
                </div>
                <!-- surname input -->
                <div class="form-group">
                <label for="cognome">Inserisci il cognome</label>
                <input type="text" class="form-control input_field_style" name="cognome" id="cognome" placeholder="Rossi" required="required" maxlength="80">
                </div>
                <!-- email input -->
                <div class="form-group">
                <label for="email">Inserisci l'email</label>
                <input type="email" class="form-control input_field_style" name="email" id="email" placeholder="name@example.com" required="required" maxlength="80">
                </div>
                <!-- password input -->
                <div class="eye">
                  <div class="form-group">
                  <label for="password">Inserisci la password</label>
                  <input type="password" class="form-control input_field_style" name="password" id="password" placeholder="Scrivila qui" required="required" maxlength="80">
                  <i class="fa-solid fa-eye" id="togglePassword"></i>
                  </div>
                </div>
                
                <button type="submit" name="signup_btn" class="blue_btn access_btn">Registrati</button>
            </form>
                <div class="invite">Hai già un account? <a href="index.php">Accedi</a> </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="assets\js\script.js"></script>
</body>
</html>