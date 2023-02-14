function reset() {
    var sqm = parseInt(document.getElementById('sqm').value);
    var years = parseInt(document.getElementById('years').value);
    var garage = parseInt(document.getElementById('garage').value);
    var bedroom = parseInt(document.getElementById('bedroom').value);
    var bathroom = parseInt(document.getElementById('bathroom').value);
    var mun = document.getElementById('mun').value;

    
}

function calculate() {
    var sqm = parseInt(document.getElementById('sqm').value);
    var years = parseInt(document.getElementById('years').value);
    var garage = parseInt(document.getElementById('garage').value);
    var bedroom = parseInt(document.getElementById('bedroom').value);
    var bathroom = parseInt(document.getElementById('bathroom').value);
    var mun = document.getElementById('mun').value;

    var garval = 13000;
    var bathval = 9000;
    var bedrval = 12500;


    if (Number.isNaN(sqm) || sqm == null || sqm == '' || sqm == '0' ||
        Number.isNaN(years) || years == null || years == '' || years == '0' ||
        Number.isNaN(garage) || garage == null ||
        Number.isNaN(bedroom) || bedroom == null ||
        Number.isNaN(bathroom) || bathroom == null ||
        mun==='Select Municipality') {
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
    } else {
        // 10 % of 2, 178, 734 = 217, 863.4
        // 5 years x 217, 863.4 = 1, 089, 317
        // 1, 089, 317(yung 10 % increase for 5 years) x 2, 178, 634 = 3, 267, 951

        if (mun === 'Abucay') {
            var perc = 0.072;
            var present = sqm * 10893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        } else if (mun === 'Bagac') {
            var perc = 0.066;
            var present = sqm * 11382.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        } else if (mun === 'Balanga') {
            var perc = 0.11;
            var present = sqm * 12293.16;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        } else if (mun === 'Dinalupihan') {
            var perc = 0.083;
            var present = sqm * 11893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        } else if (mun === 'Hermosa') {
            var perc = 0.078;
            var present = sqm * 10663.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        } else if (mun === 'Limay') {
            var perc = 0.089;
            var present = sqm * 11493.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        } else if (mun === 'Mariveles') {
            var perc = 0.087;
            var present = sqm * 11685.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        } else if (mun === 'Morong') {
            var perc = 0.068;
            var present = sqm * 11893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        } else if (mun === 'Orani') {
            var perc = 0.076;
            var present = sqm * 10893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        } else if (mun === 'Pilar') {
            var perc = 0.074;
            var present = sqm * 10893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        } else if (mun === 'Samal') {
            var perc = 0.071;
            var present = sqm * 10893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        } else if (mun === 'Orion') {
            var perc = 0.072;
            var present = sqm * 10893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;
            var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
            var solve = present + increaseYear + totalMisc;
        }

        var res = document.getElementById('result').textContent = "₱ " + solve.toLocaleString("en-US");

    }

}
