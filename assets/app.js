/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application

/* Vendor js */
import $ from "jquery";
import "bootstrap";
import "simplebar";
import waypoint from "waypoints/lib/jquery.waypoints.js";
import 'node-waves';
//import "./js/vendor.min.js";

/* Plugins js*/
import "flatpickr";
// import "./libs/apexcharts/apexcharts.min.js";

import ApexCharts from 'apexcharts';

/* Dashboar 1 init js*/
var colors = ["#f1556c"]; (dataColors = $("#total-revenue").data("colors")) && (colors = dataColors.split(",")); var options = { series: [68], chart: { height: 220, type: "radialBar" }, plotOptions: { radialBar: { hollow: { size: "65%" } } }, colors: colors, labels: ["Revenue"] }; (chart = new ApexCharts(document.querySelector("#total-revenue"), options)).render(); var dataColors; colors = ["#1abc9c", "#4a81d4"]; (dataColors = $("#sales-analytics").data("colors")) && (colors = dataColors.split(",")); var chart; options = { series: [{ name: "Revenue", type: "column", data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160] }, { name: "Sales", type: "line", data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16] }], chart: { height: 378, type: "line" }, stroke: { width: [2, 3] }, plotOptions: { bar: { columnWidth: "50%" } }, colors: colors, dataLabels: { enabled: !0, enabledOnSeries: [1] }, labels: ["01 Jan 2001", "02 Jan 2001", "03 Jan 2001", "04 Jan 2001", "05 Jan 2001", "06 Jan 2001", "07 Jan 2001", "08 Jan 2001", "09 Jan 2001", "10 Jan 2001", "11 Jan 2001", "12 Jan 2001"], xaxis: { type: "datetime" }, legend: { offsetY: 7 }, grid: { padding: { bottom: 20 } }, fill: { type: "gradient", gradient: { shade: "light", type: "horizontal", shadeIntensity: .25, gradientToColors: void 0, inverseColors: !0, opacityFrom: .75, opacityTo: .75, stops: [0, 0, 0] } }, yaxis: [{ title: { text: "Net Revenue" } }, { opposite: !0, title: { text: "Number of Sales" } }] }; (chart = new ApexCharts(document.querySelector("#sales-analytics"), options)).render(), $("#dash-daterange").flatpickr({ altInput: !0, mode: "range", altFormat: "F j, y", defaultDate: "today" });

/* App js*/
import feather from 'feather-icons';
import "./js/app.min.js";
feather.replace();

// Waves Effect
Waves.init();

// Feather Icons
feather.replace()/*
import $ from "jquery";

import "flatpickr"; */

/*
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application

/* Vendor js 
//import $ from "./js/vendor.min.js";
import $ from "jquery"
import 'popper.js';
import 'jquery.counterup';
import 'jquery.easing';
import feather from 'feather-icons';

/* Plugins js
import "flatpickr";
import ApexCharts from 'apexcharts';

import "selectize/dist/js/standalone/selectize.js";

/* Dashboar 1 init js
var colors=["#f1556c"];(dataColors=$("#total-revenue").data("colors"))&&(colors=dataColors.split(","));var options={series:[68],chart:{height:220,type:"radialBar"},plotOptions:{radialBar:{hollow:{size:"65%"}}},colors:colors,labels:["Revenue"]};(chart=new ApexCharts(document.querySelector("#total-revenue"),options)).render();var dataColors;colors=["#1abc9c","#4a81d4"];(dataColors=$("#sales-analytics").data("colors"))&&(colors=dataColors.split(","));var chart;options={series:[{name:"Revenue",type:"column",data:[440,505,414,671,227,413,201,352,752,320,257,160]},{name:"Sales",type:"line",data:[23,42,35,27,43,22,17,31,22,22,12,16]}],chart:{height:378,type:"line"},stroke:{width:[2,3]},plotOptions:{bar:{columnWidth:"50%"}},colors:colors,dataLabels:{enabled:!0,enabledOnSeries:[1]},labels:["01 Jan 2001","02 Jan 2001","03 Jan 2001","04 Jan 2001","05 Jan 2001","06 Jan 2001","07 Jan 2001","08 Jan 2001","09 Jan 2001","10 Jan 2001","11 Jan 2001","12 Jan 2001"],xaxis:{type:"datetime"},legend:{offsetY:7},grid:{padding:{bottom:20}},fill:{type:"gradient",gradient:{shade:"light",type:"horizontal",shadeIntensity:.25,gradientToColors:void 0,inverseColors:!0,opacityFrom:.75,opacityTo:.75,stops:[0,0,0]}},yaxis:[{title:{text:"Net Revenue"}},{opposite:!0,title:{text:"Number of Sales"}}]};(chart=new ApexCharts(document.querySelector("#sales-analytics"),options)).render(),$("#dash-daterange").flatpickr({altInput:!0,mode:"range",altFormat:"F j, y",defaultDate:"today"});
/* App js
import "./js/app.min.js";
feather.replace()

/*
import $ from "jquery";

import "flatpickr"; */
