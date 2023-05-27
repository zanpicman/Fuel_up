<!DOCTYPE html>
<html>
<head>
    <title>Registracija</title>
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
            if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
                $errors[] = "Samo črke in številke so dovoljene";
            }
            if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM uporabnik WHERE uporabniskoIme='$username'")) > 0){
                $errors[] = "Uporabniško ime je že zasedeno";
            }
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
            $query = "INSERT INTO uporabnik (uporabniskoIme, geslo) VALUES ('$username', '$password')";
            mysqli_query($connection, $query);
            echo "<script>alert('Registracija uspešna!'); window.location.href = 'login.php';</script>";

            exit();
        }
    }

    ?>

    <h2>Registration Form</h2>
    <form method="post" action="registration.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" value="Register">
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