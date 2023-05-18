/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
//import './bootstrap';
import 'bootstrap'
import './assets/js/detect.js'
import './assets/js/fastclick.js'
import './assets/js/jquery.slimscroll.js'
import './assets/js/jquery.blockUI.js'
import 'node-waves'
//import './assets/js/waves.js'
import 'wowjs'
import './assets/js/jquery.nicescroll.js'
import './assets/js/jquery.scrollTo.min.js'

import './assets/js/jquery.core.js'
import './assets/js/jquery.app.js'

import './js/baseTwig/base.js'
import './js/clignotement.js'
import 'bootstrap-sweetalert/lib/sweet-alert'
import './pages/jquery.sweet-alert.init.js'

import './plugins/waypoints/lib/jquery.waypoints.js'
import './plugins/counterup/jquery.counterup.min.js'
import './pages/jquery.widgets.js'
import './plugins/jquery-sparkline/jquery.sparkline.min.js'


    $('body').show();
    NProgress.start();
    setTimeout(function () {
        NProgress.done();
        $('.fade').removeClass('out');
    }, 1000);
    $("#b-0").click(function () {
        NProgress.start();
    });
    $("#b-40").click(function () {
        NProgress.set(0.4);
    });
    $("#b-inc").click(function () {
        NProgress.inc();
    });
    $("#b-100").click(function () {
        NProgress.done();
    });
