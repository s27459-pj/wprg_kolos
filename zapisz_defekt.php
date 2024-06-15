<?php

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo "Tylko metoda GET jest obsługiwana!";
    exit();
}

session_start();

$current_date = date('Y-m-d');
if (isset($_COOKIE['s27459']) && $_COOKIE['s27459'] === $current_date) {
    echo "Dziś zgłoszono już defekt! Można zgłosić tylko jeden defekt na dzień!";
    exit();
}
setcookie("s27459", $current_date, time() + 3600);

// save to db
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$description = $_SESSION['description'];

$hostname = "127.0.0.1";
$username = "root";
$password = "pass";
$database = "defekty";

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    exit("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
}

$sql = $conn->prepare("insert into zgloszenia (imie, nazwisko, adres_email, defekt) values (?, ?, ?, ?)");
$sql->bind_param("ssss", $first_name, $last_name, $email, $description);
$sql->execute();

if ($sql->affected_rows > 0) {
    echo "Defekt został zapisany!";
} else {
    echo "Nie udało się zapisać defektu!";
}
