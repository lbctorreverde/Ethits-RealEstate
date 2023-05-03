document.getElementById('ifResidence').onchange = function () {
    document.getElementById('floors').disabled = !this.checked;
    document.getElementById('floors').value = '0';
    document.getElementById('garage').disabled = !this.checked;
    document.getElementById('garage').value = '0';
    document.getElementById('bedroom').disabled = !this.checked;
    document.getElementById('bedroom').value = '0';
    document.getElementById('bathroom').disabled = !this.checked;
    document.getElementById('bathroom').value = '0';
    document.getElementById('propertytype').disabled = !this.checked;
    document.getElementById('propertytype').value = 'default';
}



function calculate() {
    var sqm = parseInt(document.getElementById('sqm').value);
    var years = parseInt(document.getElementById('years').value);
    var garage = parseInt(document.getElementById('garage').value);
    var bedroom = parseInt(document.getElementById('bedroom').value);
    var bathroom = parseInt(document.getElementById('bathroom').value);

    var floors = parseInt(document.getElementById('floors').value);
    var mun = document.getElementById('mun').value;
    var propertytype = document.getElementById('propertytype').value;

    var garval = 13000;
    var bathval = 9000;
    var bedrval = 12500;

    var perfloor = 0.04;

    var depreciation = 0.012;

    var propertytypetotal = 0;

    var solve = 0;

    if (Number.isNaN(sqm) || sqm == null || sqm == '' || sqm == '0' ||
        Number.isNaN(years) || years == null || years == '' || years == '0' ||
        Number.isNaN(garage) || garage == null ||
        Number.isNaN(bedroom) || bedroom == null ||
        Number.isNaN(bathroom) || bathroom == null ||
        mun === 'Select Municipality') {
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

            solve = present + increaseYear;
        } else if (mun === 'Bagac') {
            var perc = 0.066;
            var present = sqm * 11382.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;

            solve = present + increaseYear;
        } else if (mun === 'Balanga') {
            var perc = 0.11;
            var present = sqm * 12293.16;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;

            solve = present + increaseYear;
        } else if (mun === 'Dinalupihan') {
            var perc = 0.083;
            var present = sqm * 11893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;

            solve = present + increaseYear;
        } else if (mun === 'Hermosa') {
            var perc = 0.078;
            var present = sqm * 10663.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;

            solve = present + increaseYear;
        } else if (mun === 'Limay') {
            var perc = 0.089;
            var present = sqm * 11493.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;

            solve = present + increaseYear;
        } else if (mun === 'Mariveles') {
            var perc = 0.087;
            var present = sqm * 11685.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;

            solve = present + increaseYear;
        } else if (mun === 'Morong') {
            var perc = 0.068;
            var present = sqm * 11893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;

            solve = present + increaseYear;
        } else if (mun === 'Orani') {
            var perc = 0.076;
            var present = sqm * 10893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;

            solve = present + increaseYear;
        } else if (mun === 'Pilar') {
            var perc = 0.074;
            var present = sqm * 10893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;

            solve = present + increaseYear;
        } else if (mun === 'Samal') {
            var perc = 0.071;
            var present = sqm * 10893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;

            solve = present + increaseYear;
        } else if (mun === 'Orion') {
            var perc = 0.072;
            var present = sqm * 10893.17;
            var percIncrease = perc * present;
            var increaseYear = years * percIncrease;

            solve = present + increaseYear;
        }

        console.log(solve);


        if (propertytype === 'Bungalow') {
            propertytypetotal = solve * 0.05;
        } else if (propertytype === 'Single-attached') {
            propertytypetotal = solve * 0.058;
        } else if (propertytype === 'Duplex') {
            propertytypetotal = solve * 0.07;
        }

        var totalMisc = ((garval * garage) + (bathval * bathroom) + (bedrval * bedroom)) * years;
        var perunitfloor = ((perfloor * solve) * floors);
        var totaldepreciation = (solve * depreciation) * years;
        solve = solve + propertytypetotal + totalMisc + perunitfloor;


        var res = document.getElementById('result').textContent = "₱ " + solve.toLocaleString("en-US") + "\nis the value of your property";

    }

}

function duplex(e) {
    var propertytype = document.getElementById('propertytype').value;
    if (propertytype === 'Bungalow') {
        document.getElementById('floors').value = 1;
    }
    document.getElementById('floors').value = 1;
    document.getElementById('units').value = 1;

}

