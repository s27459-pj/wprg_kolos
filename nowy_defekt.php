<?php

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo "Tylko metoda GET jest obsługiwana!";
    exit();
}

$first_name = $_GET['first_name'];
$last_name = $_GET['last_name'];
$email = $_GET['email'];
$description = $_GET['description'];

if (empty($first_name) || empty($last_name) || empty($email) || empty($description)) {
    echo "Wszystkie pola są wymagane!";
    exit();
}

if (strlen($description) > 255) {
    echo "Opis jest za długi (max 255 znaków)";
    exit();
}

session_start();
$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['description'] = $description;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zgłoszenie</title>
</head>

<body>
    <h1>Zgłoszenie</h1>
    <p>Imię: <?php echo $first_name; ?></p>
    <p>Nazwisko: <?php echo $last_name; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Opis: <?php echo $description; ?></p>
    <a href="zapisz_defekt.php">Zapisz zgłoszenie</a>
    <a href="index.php">Powrót</a>
</body>

</html>
