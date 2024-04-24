document.addEventListener("DOMContentLoaded", function () {
  let options = {
    chart: {
      type: "bar",
      foreColor: "#fff",
    },
    series: [
      {
        name: "Transaksi",
        data: [20, 10, 10, 10, 51, 40, 40],
      },
    ],
    xaxis: {
      categories: [
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu",
        "Minggu",
      ],
    },
    plotOptions: {
      bar: {
        colors: {
          ranges: [
            { from: 0, to: 10, color: "#17543e" },
            { from: 11, to: 20, color: "#1d694d" },
            { from: 21, to: 30, color: "#237e5d" },
            { from: 31, to: 40, color: "#29936c" },
            { from: 41, to: 50, color: "#2fa87c" },
            { from: 51, to: 60, color: "#35bd8b" },
            { from: 61, to: 70, color: "#3bd39b" },
          ],
        },
      },
    },
  };

  let chart = new ApexCharts(
    document.querySelector("#transactionChart"),
    options,
  );

  chart.render();
});
