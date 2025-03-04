import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Layout
*/
import $ from 'jquery';
global.$ = global.jQuery = $;

import 'bootstrap';
/* import 'footable';
 */
//import jsgrid from 'jsgrid';

//import './libs/jquery.counterup/jquery.counterup';
/* 
import 'nestable2';

 */
import './js/app.js';

var delay = $(this).attr('data-delay') ? $(this).attr('data-delay') : 100;
var time = $(this).attr('data-time') ? $(this).attr('data-time') : 1200;
$('[data-plugin="counterup"]').each(function (idx, obj) {
    $(this).counterUp({
        delay: delay,
        time: time
    });
});
import Waves from 'node-waves';
// Waves Effect
Waves.init();
import feather from 'feather-icons';
// Feather Icons
feather.replace()