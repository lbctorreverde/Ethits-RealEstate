window.onload = () => {

    //Init variables
    let sqmValues = []
    let priceValues = []
    let predVariables = []
    let tarVariables = []
    let castPredictions = 0;

    let sqmVal = 0;
    let lotVal = 0;
    let resultVal = 0;

    Papa.parse('./data/properties.csv', {
        download: true,
        header: false,
        complete: function (results) {
            const data = results.data.slice(1)

            sqmValues = data.map(row => row[1]) //sqm column
            lotValues = data.map(row => row[2]) // lot_size column
            priceValues = data.map(row => row[0]) //price column

            /* 
            This will create a 2D array containing the sqmValues
            and priceValues as elements for each index
            */
            for (let i = 0; i < sqmValues.length; i++) {
                predVariables.push([sqmValues[i], lotValues[i]])
                tarVariables.push([priceValues[i]])
            }

            const predictorVariables = predVariables
            const targetVariable = tarVariables

        }
    })

    document.getElementById("calcBtn").addEventListener("click", printit)
    document.getElementById("resetBtn").addEventListener("click", resetVal)

    function printit() {

        let sqmtxt = document.getElementById("sqmtxt").value;
        let lottxt = document.getElementById("lottxt").value;


        const model = tf.sequential();
        model.add(tf.layers.dense({
            inputShape: [2],
            units: 1
        }));
        model.compile({
            loss: 'meanSquaredError',
            optimizer: 'sgd'
        });
        let predictions = tf.tensor2d([
            [parseInt(sqmtxt), parseInt(lottxt)]
        ]);
        predictions = predictions.dot(tf.tensor2d([[20000], [5000]])).add(tf.scalar(-100000));
        predictions.print();

        castPredictions = predictions.arraySync()[0][0];

        const formattedResult = castPredictions.toLocaleString("en-US")

        document.getElementById("resulta").innerHTML = "₱" + formattedResult

    }

    function resetVal() {
        document.getElementById("resulta").innerHTML = ""
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