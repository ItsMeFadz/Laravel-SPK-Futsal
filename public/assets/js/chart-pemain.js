// chart pemain js

var graphData = {
  type: "radar",
  data: {
    labels: [
      "K01", // ini diambil dari kriteria id dan kodenya
      // "K02",
      // "K03",
      // "K04",
      // "K05",
      // "K06",
      // "K09",
      // "K08",
      // "K02",
      // "K03",
      // "K09",
      // "K05",
      // "K06",
      // "K09",
      // "K10",
      // "K02",
      // "K03",
      // "K09",
      // "K05",
      // "K06",
      // "K09",
      // "K09",
    ],

    datasets: [
      {
        // ini untuk latihan terbaru dilihat dari tanggal terbaru
        label: "Latihan 3",
        fill: true,
        lineTension: 0,
        backgroundColor: "rgba(75,192,192,0.3)",
        borderColor: "rgba(75,192,192,1)",
        borderCapStyle: "butt",
        borderDash: [],
        borderDashOffset: 0.0,
        borderJoinStyle: "miter",
        pointBorderColor: "rgba(75,192,192,1)",
        pointBackgroundColor: "rgba(75,192,192,0.5)",
        pointBorderWidth: 2,
        pointHoverRadius: 8,
        pointHoverBackgroundColor: "rgba(75,192,192,1)",
        pointHoverBorderColor: "rgba(220,220,220,1)",
        pointHoverBorderWidth: 2,
        pointRadius: 4,
        pointHitRadius: 10,
        data: [3, 5, 3, 2, 3, 6, 5,3, 5, 3, 2, 3, 8, 5,3, 5, 3, 2, 3, 7, 5,5],
        spanGaps: false
      },
      {
        // ini untuk latihan lama mau ada banyak latihan pun tidak apa2
       label: "Latihan 1",
        fill: false,
        lineTension: 0,
        //backgroundColor: "rgba(75,192,192,0.3)",
        borderColor: "rgba(255,192,192,1)",
        borderCapStyle: "butt",
        borderDash: [5,10],
        borderDashOffset: 0.0,
        borderJoinStyle: "miter",
        pointBorderColor: "rgba(255,192,192,1)",
        pointBackgroundColor: "rgba(255,192,192,1)",
        pointBorderWidth: 1,
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(255,192,192,1)",
        pointHoverBorderColor: "rgba(220,220,220,1)",
        pointHoverBorderWidth: 2,
        pointRadius: 2,
        pointHitRadius: 20,
        data: [4, 4, 4, 3, 2, 4, 4,4, 4, 4, 3, 2, 4, 4,4, 4, 4, 3, 2, 4, 4,5],
        spanGaps: false 
      }
    ]
  },
    options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        r: {
            min: 0,
            max: 10,
            ticks: {
                stepSize: 1,
                backdropColor: 'transparent'
            }
        }
    }
}

}


// var context = document.getElementById("radarCanvas").getContext("2d");

// var radarChart = new Chart(context, graphData); // Works fine

// canvas2svg 'mock' context
// var svgContext = C2S(500,500);

// new chart on 'mock' context fails:
// var mySvg = new Chart(svgContext, graphData);
// Failed to create chart: can't acquire context from the given item

let radarChart;

function initChart(labels = [], latest = [], old = [], latestName = "Latihan Terbaru",
    oldName = "Latihan Lama") {

    console.log("labels:", labels);
    console.log("latest:", latest);
    console.log("old:", old);
    const canvas = document.getElementById("radarCanvas");
    if (!canvas) return;

    const ctx = canvas.getContext("2d");

    if (radarChart) radarChart.destroy();

    radarChart = new Chart(ctx, {
        type: "radar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: latestName,
                    data: latest,
                    fill: true,
                    backgroundColor: "rgba(75,192,192,0.3)",
                    borderColor: "rgba(75,192,192,1)"
                },
                {
                    label: oldName,
                    data: old,
                    fill: false,
                    borderDash: [5, 5],
                    borderColor: "rgba(255,99,132,1)"
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    min: 0,
                    max: 10,
                    ticks: {
                        stepSize: 1,
                        backdropColor: 'transparent'
                    }
                }
            }
        }
    });

}

// console.log(svgContext.getSerializedSvg(true));
