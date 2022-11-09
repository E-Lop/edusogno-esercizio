<?php

require_once __DIR__ . '/database_connection.php';

// Leggere tutti gli utenti
/* $sql = "SELECT * FROM `utenti`;";
$result = $conn->query($sql);

$utenti = []; */

// Controllo che la query abbia prodotto dei risultati
/* if($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $utenti[] = $row;
    }
} else { */
    // Si può fare qualcosa se non ci sono risultati dal db
    // echo 'Nessun risultato';
// }

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
            <img src="assets\img\logo.jpg" alt="Edusogno logo">
        </div>
    </header>

    <!-- Main section -->
    <main>
        <div class="title">Hai già un account?</div>
        <div class="container">
            <!-- Login mask -->
            <div class="login_card">
                <form action="">
                    <label for="email">Inserisci l'e-mail</label><br>
                    <input class="input_field_style" type="text" name="email" id="email" placeholder="name@example.com"><br>
                    <label for="password">Inserisci la password</label><br>
                    <input class="input_field_style" type="password" name="password" id="password" placeholder="Scrivila qui"><br>
                    <input class="blue_btn" type="button" value="ACCEDI" id="login_btn">
                </form>
                <div class="register_invite">Non hai ancora un profilo? <span>Registrati</span></div>
            </div>
        </div>
    </main>
</body>
</html>