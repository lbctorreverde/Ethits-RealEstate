window.onload = () => {

    //Init variables
    let sqmValues = []
    let priceValues = []
    let carspaceValues = []
    let bedroomValues = []
    let bathroomValues = []
    let floorValues = []
    let predVariables = []
    let tarVariables = []
    let castPredictions = 0;

    //Test variables (you can remove)
    let sqmVal = 0;
    let lotVal = 0;
    let resultVal = 0;

    Papa.parse('./data/properties.csv', {
        download: true,
        header: false,
        complete: function (results) {
            const data = results.data.slice(1)

            sqmValues = data.map(row => parseInt(row[1])) //sqm column
            lotValues = data.map(row => parseInt(row[2])) // lot_size column
            carspaceValues = data.map(row => parseInt([3])) // car_spaces column
            bedroomValues = data.map(row => parseInt(row[4])) // bedrooms column
            bathroomValues = data.map(row => parseInt([5])) // bathrooms column
            floorValues = data.map(row => parseInt([6])) // floors column

            priceValues = data.map(row => parseInt([0])) //price column

            /* 
            This will create a 2D array containing the sqmValues
            and priceValues as elements for each index
            */
            for (let i = 0; i < sqmValues.length; i++) {
                predVariables.push([sqmValues[i], lotValues[i], carspaceValues[i], bedroomValues[i], bathroomValues[i], floorValues[i]])
                tarVariables.push([priceValues[i]])
            }

            const predictorVariables = predVariables
            const targetVariable = tarVariables


        }
    })

    document.getElementById("calcBtn").addEventListener("click", printit)
    document.getElementById("resetBtn").addEventListener("click", resetVal)

    function printit() {

        //Each text field
        let sqmtxt = document.getElementById("sqmtxt").value;
        let lottxt = document.getElementById("lottxt").value;
        let floorstxt = document.getElementById("floorstxt").value;
        let car_spacetxt = document.getElementById("car_spacetxt").value;
        let bedroomtxt = document.getElementById("bedroomtxt").value;
        let bathroomtxt = document.getElementById("bathroomtxt").value;

        if (
            Number.isNaN(sqmtxt) || sqmtxt == null || sqmtxt == '' || sqmtxt == '0' ||
            Number.isNaN(lottxt) || lottxt == null || lottxt == '' || lottxt == '0' ||
            Number.isNaN(floorstxt) || floorstxt == null || floorstxt == '' || floorstxt == '0' ||
            Number.isNaN(car_spacetxt) || car_spacetxt == null || car_spacetxt == '' || car_spacetxt == '0' ||
            Number.isNaN(bedroomtxt) || bedroomtxt == null || bedroomtxt == '' || bedroomtxt == '0' ||
            Number.isNaN(bathroomtxt) || bathroomtxt == null || bathroomtxt == '' || bathroomtxt == '0'
        ) {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
        } else {
            //Training and Testing Sets
            let xTrain = tf.tensor2d(predVariables, [predVariables.length, 6]);
            let yTrain = tf.tensor2d(tarVariables, [tarVariables.length, 1]);
            let xTest = tf.tensor2d([], [0, 6]);
            let yTest = tf.tensor2d([], [0, 1]);


            //Define Model
            const model = tf.sequential();
            model.add(tf.layers.dense({
                inputShape: [6],
                units: 1
            }));
            model.compile({
                loss: 'meanSquaredError',
                optimizer: 'sgd'
            });


            let predictions = tf.tensor2d([
                [parseInt(sqmtxt), parseInt(lottxt), parseInt(floorstxt), parseInt(car_spacetxt), parseInt(bedroomtxt), parseInt(bathroomtxt)]
            ]);

            function weighter(min, max) {
                let d = max - min;
                let r = Math.random();
                r = Math.floor(r * d);
                r = r + min;
                return r;
            }



            predictions = predictions.dot(tf.tensor2d([[20000], [10000], [weighter(2189, 2934)], [weighter(3825, 4731)], [weighter(3552, 3896)], [weighter(4432, 5324)]])).add(tf.scalar(-100000));
            predictions.print();

            castPredictions = predictions.arraySync()[0][0];

            const formattedResult = castPredictions.toLocaleString("en-US")

            document.getElementById('loader').hidden = false

            setTimeout(() => {
                document.getElementById('loader').hidden = true
            }), 3000

            setTimeout(() => {
                document.getElementById("resulta").innerHTML = "₱" + formattedResult
            }), 10000
            //document.getElementById("resulta").innerHTML = "₱" + formattedResult
        }



    }

    function resetVal() {
        document.getElementById("resulta").innerHTML = "­"
    }

}




// BASE CODE
//
//
// const predictorVariables = [
//     [1000, 2],
//     [2000, 3],
//     [1500, 2],
//     [3000, 4],
//     [1200, 2],
//     [3200, 5],
//     [2100, 3],
//     [1700, 2],
//     [2500, 4],
//     [2200, 3],
//     [3000, 5],
//     [1500, 1],
//     [2000, 3],
//     [2400, 4],
//     [1900, 3],
//     [2800, 5]
// ];

// const targetVariable = [
//     200000,
//     400000,
//     250000,
//     500000,
//     175000,
//     550000,
//     200000,
//     150000,
//     300000,
//     220000,
//     400000,
//     120000,
//     180000,
//     280000,
//     210000,
//     380000
// ];

// const model = tf.sequential();

// model.add(tf.layers.dense({
//     inputShape: [2],
//     units: 1
// }));

// model.compile({
//     loss: 'meanSquaredError',
//     optimizer: 'sgd'
// });


// let predictions = tf.tensor2d([
//     [5000, 3]


// ]);

// predictions = predictions.dot(tf.tensor2d([[100], [50]])).add(tf.scalar(-100000));

// predictions.print();