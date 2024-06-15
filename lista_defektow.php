<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista defektów</title>
</head>

<body>
    <h1>Lista defektów</h1>
    <table>
        <tr>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Email</th>
            <th>Opis</th>
        </tr>
        <?php
        $hostname = "127.0.0.1";
        $username = "root";
        $password = "pass";
        $database = "defekty";

        $conn = mysqli_connect($hostname, $username, $password, $database);
        if (!$conn) {
            exit("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
        }

        $sql = $conn->prepare("select imie, nazwisko, adres_email, defekt from zgloszenia");
        $sql->execute();
        $sql->bind_result($first_name, $last_name, $email, $description);

        while ($sql->fetch()) {
            echo "<tr>";
            echo "<td>$first_name</td>";
            echo "<td>$last_name</td>";
            echo "<td>$email</td>";
            echo "<td>$description</td>";
            echo "</tr>";
        }
        ?>

</body>

</html>
