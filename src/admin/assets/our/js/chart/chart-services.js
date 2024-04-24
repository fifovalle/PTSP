document.addEventListener("DOMContentLoaded", function () {
  var options = {
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
    xaxis: {
      categories: ["Informasi"],
    },
    colors: ["#b2b200"],
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

  var dataChart1 = {
    series: [
      {
        name: "Series A",
        data: [30],
      },
    ],
  };

  var dataChart2 = {
    series: [
      {
        name: "Series B",
        data: [45],
      },
    ],
  };

  var dataChart3 = {
    series: [
      {
        name: "Series C",
        data: [25],
      },
    ],
  };

  var chartServices1 = new ApexCharts(
    document.querySelector("#chartServices1"),
    Object.assign({}, options, dataChart1),
  );
  chartServices1.render();

  var chartServices2 = new ApexCharts(
    document.querySelector("#chartServices2"),
    Object.assign({}, options, dataChart2),
  );
  chartServices2.render();

  var chartServices3 = new ApexCharts(
    document.querySelector("#chartServices3"),
    Object.assign({}, options, dataChart3),
  );
  chartServices3.render();
});
