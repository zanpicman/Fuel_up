<?php 
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Prijava</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="style-login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
</head>
<body>
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
            $query = "SELECT * FROM uporabnik WHERE uporabniskoIme='$username'";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                if (password_verify($password, $row["geslo"])) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $row["id"];
                    header("Location: index.php");
                    exit();
                } else {
                    $errors[] = "Napačno uporabniško ime ali geslo";
                }
                
            } else {
                $errors[] = "Napačno uporabniško ime ali geslo";
            }
        }
    }

    ?>
  
        <form method="post" action="login.php">
        <fieldset class="input"id="input1">
            <legend>Prijava</legend>
            <label for="username">Uporabniško ime:</label>
            <input type="text" id="username" name="username" value="<?php echo $username; ?>">
            <br>
            <label for="password">Geslo:</label>
            <input type="password" id="password" name="password">
            <br>
            <input type="submit" value="Prijava">
            <br>
            <p>Če še nimate računa se registrirajte <a href="registration.php" style="color: green" >tukaj</a></p>  
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