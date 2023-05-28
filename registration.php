<?php 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="style-login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link rel="stylesheet" type="text/css" href="style-login.css">
</head>
<body class="login">
    <?php
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

   
    <form method="post" action="registration.php">
    <fieldset>
        <legend>Registracija</legend>
        <label for="username">uporabniško ime:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>">
        <br>
        <label for="password">Geslo:</label>
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" value="Registracija">
        <br>
        <a href="login.php">Prijava</a>
    
    </fieldset>
</form>
    <?php
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