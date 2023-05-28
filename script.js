"use strict";

function podatki() {
    var table = document.getElementById("polnjenja");
    if (table.rows.length>1) { 
    const firstRow = table.rows[1];
    const zacetna = firstRow.cells[0];
    const lastRow = table.rows[table.rows.length-1];
    var lastCell = lastRow.cells[0];
    var km = lastCell.innerText-zacetna.innerText
    var skupnoBencin = 0;
    var bencin = table.rows[2];
for (let index = 2; index < table.rows.length; index++) {
    var aaa = table.rows[index].cells[2]
    skupnoBencin = skupnoBencin + Number(aaa.innerText);
}
   var avg = document.getElementById("poraba");
   avg.textContent= (skupnoBencin/km*100).toFixed(2);
   var predZadnja = table.rows[table.rows.length-2]
   var xpred = predZadnja.cells[0]
    km = lastCell.innerText - xpred.innerText
   var zadna = document.getElementById("zadnja");
    var row = table.rows[table.rows.length-1]
    lastCell = row.cells[2].innerText
   zadna.textContent = (lastCell/km*100).toFixed(2);

    var cena = document.getElementById("cena");
    cena.textContent = (table.rows[table.rows.length-1].cells[3].innerText / table.rows[table.rows.length-1].cells[2].innerText).toFixed(2);
    console.log(table.rows[table.rows.length-1].cells[3].innerText);
    console.log(table.rows[table.rows.length-1].cells[2].innerText);

    var zakup =document.getElementById("zakup");
    var numElem= table.rows.length;
    var average = 0;

for (let index = 1; index < table.rows.length; index++) {

    var bbbb = table.rows[index].cells[3];

    average = average + Number(bbbb.innerText);  
}

    zakup.textContent = (average/(numElem-1)).toFixed(2);
}
}
