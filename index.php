<?php include("session.php"); 

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $stevec = $_POST['stevec1'];
    $vrsta = $_POST['vrsta'];
    $kolicina = $_POST['kolicina'];
    $cenaL = $_POST['cenaL'];

    $connection = mysqli_connect("localhost", "root", "", "uporabniki");
    $userid = $_SESSION["id"];
    $query = "INSERT INTO poraba (uporabnikId, stevec, tipGoriva, kolicina, cenaLiter) VALUES ('$userid', '$stevec', '$vrsta', '$kolicina', '$cenaL')";

    mysqli_query($connection, $query);

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Naloga 1</title>
</head>
<body>
    <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.html">About Me</a></li>
          <li><a href="viri.html">Viri</a></li>
          <li><a href="logout.php">Odjava</a></li>
        </ul>
      </nav>
    
<div class="container">
    <div class="left-side">
        <form action="index.php" method="post">
            <fieldset class="input" id="input1">
                <legend>Polnenje</legend>
                <label for="stevec1">Kilometrski števec (km):</label>
                <input id="stevec1" name="stevec1"type="number"> 
                <label for="vrsta">Vrsta Goriva:</label>
                <select name="vrsta" id="vrsta">
                    <option>Dizel</option>
                    <option>Bencin(95)</option>
                    <option>Bencin(98)</option>        
                </select>
                <label for="kolicina">Količina goriva (l):</label>
                <input id="kolicina" name="kolicina" type="number">
                <label for="cenaL">Cena/liter (€):</label>
                <input id="cenaL" name="cenaL" type="number">
                <button type="submit" id="dodajPolnenje">Dodaj polnenje</button>
            </fieldset>
        </form>
            
        <fieldset class="input" id="input2">
            <legend>Strošek</legend>
            <label for="tip">Tip stroška: </label>
            <select name="tip" id="tip">
                <option value="servis">Servis</option>
                <option value="vzdrževanje">Vzdrževanje</option>
                <option value="registracija">Registracija</option> 
                <option value="kazen">Kazen</option>
                <option value="predelava">Predelava</option>
                <option value="zavarovanje">Zavarovanje</option>
            </select>
        
            <label for="strosek">Skupni strosek (€):</label>
            <input id="strosek" type="number">
            <label for="datum">Datum stroška:</label>
            <input id="datum" type="date">

            <label for="stevec2">Kilometrski števec (km):</label>
            <input type="number" id="stevec2">
            <button id="dodajStrosek">Dodaj strošek</button>
        </fieldset>
        <fieldset class="info" id="info">
            <legend>Podatki</legend>
            <label>Povrečna poraba goriva l/100km:</label>
            <label class="podatki" id="poraba">0</label>
            <label>Zadnja poraba goriva l/100km:</label>
            <label class="podatki" id="zadnja">0</label>
            <label>Zadnja cena goriva na liter v evrih:</label>
            <label class="podatki" id="cena">0</label>
            <label>Povprečni zakup goriva v evrih:</label>
            <label class="podatki" id="zakup">0</label>
        </fieldset>
      
</div>
    <div class="right-side">
     <fieldset class="vnosi">
        <legend>Polnjenja</legend>
        <table id="polnjenja">
            <tr>
                <th>Števec (km)</th>
                <th>Vrsta</th>
                <th>Kolicina (l)</th>
                <th>Vsota (€)</th>
            
            </tr>
        </table>
      </fieldset>
        <fieldset class="vnosi">
            <legend>Ostali stroški</legend>
            <table id="stroski">
            
            <tr>
                <th>Števec (km)</th>
                <th>Tip stroška</th>
                <th>Vsota (€)</th>
                <th>Datum</th>
            </tr>
            </table>
        </fieldset>

    </div>
</div>
    <script src="script.js"></script>
</body>
</html>