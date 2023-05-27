<?php include("session.php"); ?>


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
        <fieldset class="input" id="input1">
            <legend>Polnenje</legend>
            <label for="stevec1">Kilometrski števec (km):</label>
            <input id="stevec1" type="number"> 
            <label for="vrsta">Vrsta Goriva:</label>
            <select name="vrsta" id="vrsta">
                <option>Dizel</option>
                <option>Bencin(95)</option>
                <option>Bencin(98)</option>        
            </select>
            <label for="kolicina">Količina goriva (l):</label>
            <input id="kolicina" type="number">
            <label for="cenaL">Cena/liter (€):</label>
            <input id="cenaL" type="number">
            <button id="dodajPolnenje">Dodaj polnenje</button>
        </fieldset>
            
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