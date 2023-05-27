<?php 
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Prijava</title>
</head>
<body>
    <?php
    // Connect to database
    $connection = mysqli_connect("localhost", "root", "", "uporabniki");

    $username = $password = "";
    $errors = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $errors[] = "Potrebno je vnesti uporabniško ime";
        } else {
            $username = $_POST["username"];
            $username = trim($username);
            $username = stripslashes($username);
            $username = htmlspecialchars($username);
        }   

        if (empty($_POST["password"])) {
            $errors[] = "Potrebno je vnesti geslo";
        } else {
            $password = $_POST["password"];
            $password = trim($password);
            $password = stripslashes($password);
            $password = htmlspecialchars($password);
        }

        if (empty($errors)) {
            $query = "SELECT * FROM uporabnik WHERE uporabniskoIme='$username' AND geslo='$password'";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $_SESSION["loggedin"] = true;
                header("Location: index.php");
                exit();
            } else {
                $errors[] = "Napačno uporabniško ime ali geslo";
            }
        }
    }

    ?>

    <h2>Prijava</h2>
    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" value="Login">
        <br>
        <a href="registration.php">Registracija</a>
    </form>

    <?php
    // Display errors, if any
    if (!empty($errors)) {
        echo "<h3>Napake:</h3>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>