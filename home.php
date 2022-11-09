<?php
session_start();
require_once __DIR__ . '/database_connection.php';


$user = $_SESSION['uname'];
// get user data
$sql2 = "SELECT * FROM `utenti` WHERE `email` = '$user' ";
$result2 = $conn->query($sql2);
$userdata = $result2->fetch_assoc();

// select all events user is attending
$sql = "SELECT * FROM `eventi` WHERE `attendees` LIKE '%$user%' ";
$result = $conn->query($sql);

$events = [];

// Controllo che la query abbia prodotto dei risultati
if($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
} else {
    // Si può fare qualcosa se non ci sono risultati dal db
    echo 'Nessun risultato';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina personale</title>
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
        <div class="welcome">Ciao <?php echo $userdata['nome'] ?> ecco i tuoi eventi</div>
        <div class="container-wide">
            <!-- events mask -->
            <?php foreach ($events as $event) { ?>
                <div class="single_event">
                    <div class="event_title"><?php echo $event['nome_evento'] ?> </div>
                    <div class="event_date"><?php echo $event['data_evento'] ?></div>
                    <div class="blue_btn join_btn">join</div>
                </div>
            
            <?php } ?>
            
            <!-- events mask -->
            
        </div>
    </main>
</body>
</html>