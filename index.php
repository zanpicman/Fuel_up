<?php include("session.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dodajPolnenje'])) {
    $stevec = $_POST['stevec1'];
    $vrsta = $_POST['vrsta'];
    $kolicina = $_POST['kolicina'];
    $cenaL = $_POST['cenaL'] * $_POST['kolicina'];

    $connection = mysqli_connect("localhost", "root", "", "uporabniki");
    $userid = $_SESSION["id"];
    $query = "INSERT INTO poraba (uporabnikId, stevec, tipGoriva, kolicina, cenaLiter) VALUES (?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, "isssd", $userid, $stevec, $vrsta, $kolicina, $cenaL);
    mysqli_stmt_execute($statement);

    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dodajStrosek'])) {
    $tipStroska = $_POST['tip'];
    $skupniStrosek = $_POST['strosek'];
    $datum = $_POST['datum'];
    $stevec = $_POST['stevec2'];

    $connection = mysqli_connect("localhost", "root", "", "uporabniki");
    $userid = $_SESSION["id"];
    $query = "INSERT INTO ostaliStroski (uporabnikId, tipStroska, cena, datumStroska, stevec) VALUES (?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, "isdsd", $userid, $tipStroska, $skupniStrosek, $datum, $stevec);
    mysqli_stmt_execute($statement);

    header("Location: index.php");
    exit();
}

$connection = mysqli_connect("localhost", "root", "", "uporabniki");
$userid = $_SESSION["id"];
$query = "SELECT id, stevec, tipGoriva, kolicina, cenaLiter FROM poraba WHERE uporabnikId = ? ORDER BY stevec ASC";
$statement = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($statement, "i", $userid);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$polnenja = array();
while ($row = mysqli_fetch_assoc($result)) {
    $polnenja[] = $row;
}

$query = "SELECT id, cena, tipStroska, datumStroska, stevec FROM ostaliStroski WHERE uporabnikId = ? ORDER BY stevec ASC";
$statement = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($statement, "i", $userid);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$stroski = array();
while ($row = mysqli_fetch_assoc($result)) {
    $stroski[] = $row;
}

mysqli_close($connection);


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
<body onload="podatki()">
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
            <input id="stevec1" name="stevec1" type="number" step="0.0001" required> 
            <label for="vrsta">Vrsta Goriva:</label>
            <select name="vrsta" id="vrsta" required>
                <option value="Dizel">Dizel</option>
                <option value="Bencin(95)">Bencin(95)</option>
                <option value="Bencin(98)">Bencin(98)</option>        
            </select>
            <label for="kolicina">Količina goriva (l):</label>
            <input id="kolicina" name="kolicina"  type="number" step="0.0001" required>
            <label for="cenaL">Cena/liter (€):</label>
            <input id="cenaL" name="cenaL" type="number" step="0.0001" required>
            <button type="submit" id="dodajPolnenje" name="dodajPolnenje">Dodaj polnenje</button>
        </fieldset>
    </form>
        <form action="index.php" method="post">
        <fieldset class="input" id="input2">
            <legend>Strošek</legend>
            <label for="tip">Tip stroška: </label>
            <select name="tip" id="tip" name="tip">
                <option value="servis">Servis</option>
                <option value="vzdrževanje">Vzdrževanje</option>
                <option value="registracija">Registracija</option> 
                <option value="kazen">Kazen</option>
                <option value="predelava">Predelava</option>
                <option value="zavarovanje">Zavarovanje</option>
            </select>
        
            <label for="strosek">Skupni strosek (€):</label>
            <input id="strosek" type="number" step="0.0001" name="strosek" required>
            <label for="datum">Datum stroška:</label>
            <input id="datum" type="date" name="datum" required>

            <label for="stevec2">Kilometrski števec (km):</label>
            <input type="number" step="0.0001" id="stevec2" name="stevec2" required>
            <button type="submit" id="dodajStrosek" name="dodajStrosek">Dodaj strošek</button>
        </fieldset>
        </form>
        <fieldset class="info" id="info">
            <legend>Podatki</legend>
            <label>Povrečna poraba goriva l/100km:</label>
            <label class="podatki" id="poraba" name>0</label>
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
            <?php foreach ($polnenja as $polnenje): ?>

            <tr>
                <td><?php echo sprintf("%.2f", $polnenje['stevec']); ?></td>
                <td><?php echo $polnenje['tipGoriva']; ?></td>
                <td><?php echo sprintf("%.2f", $polnenje['kolicina']); ?></td>
                <td><?php echo sprintf("%.2f", $polnenje['cenaLiter']); ?></td>
                <td>
                    <form action="delete.php" method="post"  onsubmit="return confirm('Ali ste prepričani, da bi radi odstranili ta vnos?'); ">
                        <input type="hidden" name="polnenjeId" value="<?php echo $polnenje['id']; ?>">
                        <button type="submit" name="deletePolnenje">X</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
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
            <?php foreach ($stroski as $strosek): ?>

                <tr>
                        <td><?php echo sprintf("%.2f", $strosek['stevec']); ?></td>
                        <td><?php echo $strosek['tipStroska']; ?></td>
                        <td><?php echo sprintf("%.2f", $strosek['cena']); ?></td>
                        <td><?php echo $strosek['datumStroska']; ?></td>
                        <td>
                    <form action="delete.php" method="post" onsubmit="return confirm('Ali ste prepričani, da bi radi odstranili ta vnos?'); ">
                        <input type="hidden" name="strosekId" value="<?php echo $strosek['id']; ?>">
                        <button type="submit" name="deleteStrosek">X</button>
                    </form>
                </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </fieldset>

    </div>
</div>
    <script src="script.js"></script>
</body>
</html>