import ApexCharts from 'apexcharts/dist/apexcharts.min.js';


var options = {
    series: [
    {
      name: "Prévision Production Moules",
      data: [1380, 1100, 990, 880, 740],
    },
  ],
    chart: {
    type: 'bar',
    height: 350,
  },
  plotOptions: {
    bar: {
      borderRadius: 0,
      horizontal: true,
      barHeight: '80%',
      isFunnel: true,
    },
  },
  dataLabels: {
    enabled: true,
    formatter: function (val, opt) {
      return opt.w.globals.labels[opt.dataPointIndex] + ':  ' + val
    },
    dropShadow: {
      enabled: true,
    },
  },
  title: {
    text: 'Prévision Production Moules (Cordes)',
    align: 'middle',
  },
  xaxis: {
    categories: [
      'Gross NM',
      'M Super',
      'M Extra',
      'M Royal',
      'Captage NM',
    ],
  },
  legend: {
    show: false,
  },
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
  var options = {
      series: [
      {
        name: "Prévision Production Moules (Kg) à (date)",
        data: [(880 * 25), (1300 * 20), (1100* 15),(1380 * 10),  (740 * 5)],// kg * nbr cordes
      },
    ],
      chart: {
      type: 'bar',
      height: 350,
    },
    plotOptions: {
      bar: {
        borderRadius: 0,
        horizontal: true,
        barHeight: '80%',
        isFunnel: true,
      },
    },
    dataLabels: {
      enabled: true,
      formatter: function (val, opt) {
        return opt.w.globals.labels[opt.dataPointIndex] + ':  ' + val
      },
      dropShadow: {
        enabled: true,
      },
    },
    title: {
      text: 'Prévision Production Moules (Kg) à (date)',
      align: 'middle',
    },
    xaxis: {
      categories: [
         'M Royal', 
         'M Extra', 
         'M Super',
         'Gross NM',
        'Captage NM',
      ],
    },
    legend: {
      show: false,
    },
    };
  
    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();


    var options = {
        series: [
        {
          name: "",
          data: [(600 * 1), ( 500 * 1), (500 * 1), (1000 * 1), (1500 * 1), (1000 * 1), (750 * 1), (500 * 1), (250 * 1), (100 * 1)],//nbr de huitre par corde * nbr de cordes
        },
      ],
        chart: {
        type: 'bar',
        height: 350,
      },
      plotOptions: {
        bar: {
          borderRadius: 0,
          horizontal: true,
          distributed: true,
          barHeight: '80%',
          isFunnel: true,
        },
      },
      colors: [
        '#F44F5E',
        '#E55A89',
        '#D863B1',
        '#CA6CD8',
        '#B57BED',
        '#B57BED',
        '#B57BED',
        '#8D95EB',
        '#62ACEA',
        '#4BC3E6',
      ],
      dataLabels: {
        enabled: true,
        formatter: function (val, opt) {
          return opt.w.globals.labels[opt.dataPointIndex] + ':  ' + val
        },
        dropShadow: {
          enabled: true,
        },
      },
      title: {
        text: 'Prévision Production Huitres (Cordes) à (date)',
        align: 'middle',
      },
      xaxis: {
        categories: ['Poches NH', 'Gross NH', 'Huîtres H5', 'Huître H4', 'Huître H3', 'Huître H2', 'Huître H1', 'Huître H0', 'Huître H00', 'Huître H00+'],
      },
      legend: {
        show: false,
      },
      };

      var chart = new ApexCharts(document.querySelector("#chart3"), options);
      chart.render();




      var options = {
        series: [
        {
          name: "",
          data: [((600 * 500)/12), (( 500 * 90)/12), ((500 * 90)/12), ((1000 * 90)/12), ((1500 * 90)/12), ((1000 * 90)/12), ((750 * 90)/12), ((500 * 90)/12), ((250 * 90)/12), ((100 * 90)/12)],//nbr de huitre par corde * nbr unitaire
        },
      ],
        chart: {
        type: 'bar',
        height: 350,
      },
      plotOptions: {
        bar: {
          borderRadius: 0,
          horizontal: true,
          distributed: true,
          barHeight: '80%',
          isFunnel: true,
        },
      },
      colors: [
        '#F44F5E',
        '#E55A89',
        '#D863B1',
        '#CA6CD8',
        '#B57BED',
        '#B57BED',
        '#B57BED',
        '#8D95EB',
        '#62ACEA',
        '#4BC3E6',
      ],
      dataLabels: {
        enabled: true,
        formatter: function (val, opt) {
          return opt.w.globals.labels[opt.dataPointIndex] + ':  ' + val
        },
        dropShadow: {
          enabled: true,
        },
      },
      title: {
        text: 'Prévision Production Huitres (dz) à (date)',
        align: 'middle',
      },
      xaxis: {
        categories: ['Poches NH', 'Gross NH', 'Huîtres H5', 'Huître H4', 'Huître H3', 'Huître H2', 'Huître H1', 'Huître H0', 'Huître H00', 'Huître H00+'],
      },
      legend: {
        show: false,
      },
      };

      var chart = new ApexCharts(document.querySelector("#chart4"), options);
      chart.render();

