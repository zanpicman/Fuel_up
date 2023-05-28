<?php
include("session.php");

$connection = mysqli_connect("localhost", "root", "", "uporabniki");
$userid = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deletePolnenje'])) {
    $polnenjeId = $_POST['polnenjeId'];
    $query = "DELETE FROM poraba WHERE id = '$polnenjeId' AND uporabnikId = '$userid'";
    mysqli_query($connection, $query);
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteStrosek'])) {
    $strosekId = $_POST['strosekId'];
    $query = "DELETE FROM ostaliStroski WHERE id = '$strosekId' AND uporabnikId = '$userid'";
    mysqli_query($connection, $query);
    header("Location: index.php");
    exit();
}

mysqli_close($connection);
?>