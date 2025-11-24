/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import './bootstrap';

import $ from 'jquery';
global.$ = global.jQuery = $;
window.$ = window.jQuery = $;

// Charger Footable depuis le fichier local du thème UBold (fonctionne avec jQuery)
import './js/vendor/footable.all.min.js';

import 'bootstrap';
import 'simplebar';
import 'node-waves';
import feather from 'feather-icons';
import './js/app.js';
feather.replace();