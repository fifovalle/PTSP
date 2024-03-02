document.addEventListener("DOMContentLoaded", function () {
  let options = {
    chart: {
      type: "bar",
      height: 130,
      toolbar: {
        show: true,
      },
    },
    plotOptions: {
      bar: {
        horizontal: true,
        barHeight: "80%",
        distributed: true,
        borderRadius: 7,
      },
    },
    series: [
      {
        name: "Series A",
        data: [30],
      },
    ],
    xaxis: {
      categories: ["Informasi"],
    },
    colors: ["#6666ff"],
    responsive: [
      {
        breakpoint: 480,
        options: {
          legend: {
            position: "bottom",
            offsetX: -10,
            offsetY: 0,
          },
        },
      },
    ],
  };

  let chart1 = new ApexCharts(document.querySelector("#chart1"), options);
  chart1.render();

  let chart2 = new ApexCharts(document.querySelector("#chart2"), options);
  chart2.render();

  let chart3 = new ApexCharts(document.querySelector("#chart3"), options);
  chart3.render();
});
