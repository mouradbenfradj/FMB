// assets/app.js

/**
 * ============================================
 * FICHIER PRINCIPAL WEBPACK ENCORE
 * Intégration complète Ubold + Stimulus + Symfony UX
 * ============================================
 */

// ============================================
// 1. POLYFILLS ET CORE JS
// ============================================

// Polyfills pour la compatibilité navigateurs
import 'core-js/stable';
import 'regenerator-runtime/runtime';

// ============================================
// 2. JQUERY ET BOOTSTRAP CONFIGURATION
// ============================================

// Import jQuery et configuration globale
import $ from 'jquery';
window.$ = window.jQuery = $;

// Import Bootstrap JS
import 'bootstrap';

// Import Popper.js (requis par Bootstrap)
import Popper from 'popper.js';
window.Popper = Popper;

// ============================================
// 3. STYLES PRINCIPAUX
// ============================================

// Import des styles Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';

// Import des styles personnalisés
import './styles/app.css';

// ============================================
// 4. STIMULUS - APPLICATION PRINCIPALE
// ============================================

// Import du bootstrap Stimulus
import './bootstrap';

// Import des composants Stimulus
import '@stimulus-components/dropdown';
import '@stimulus-components/reveal';
import '@stimulus-components/animated-number';

// ============================================
// 5. SYMFONY UX COMPONENTS
// ============================================

// Import des composants Symfony UX
import '@symfony/ux-turbo';
import '@symfony/ux-live-component';

// ============================================
// 6. PLUGINS Ubold ESSENTIELS
// ============================================

// Import des icônes Feather
import 'feather-icons/dist/feather.min.js';

// Import de Waves (effets de clic)
import 'node-waves/dist/waves.min.js';

// Import de SimpleBar (scrollbar personnalisée)
import 'simplebar/dist/simplebar.min.js';

// Import de Waypoints et CounterUp
import 'waypoints/lib/jquery.waypoints.min.js';
import 'jquery.counterup/jquery.counterup.min.js';

// Import de Select2
import 'select2/dist/js/select2.min.js';
import 'select2/dist/css/select2.min.css';

// Import de Toastr (notifications)
import 'toastr/build/toastr.min.css';
import toastr from 'toastr';
window.toastr = toastr;

// Import de Nestable2
import 'nestable2/dist/jquery.nestable.min.js';

// ============================================
// 7. CHART LIBRARIES
// ============================================

// Import de Chart.js
import Chart from 'chart.js/auto';
window.Chart = Chart;

// Import d'ApexCharts
import ApexCharts from 'apexcharts';
window.ApexCharts = ApexCharts;

// ============================================
// 8. DATA TABLES
// ============================================

// Import de DataTables
//import 'datatables.net/js/jquery.dataTables.min.js';
import 'datatables.net-bs4/js/dataTables.bootstrap4.min.js';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';

// Import de Footable
import 'footable/css/footable.core.min.css';
import 'footable/dist/footable.all.min.js';

// ============================================
// 9. FULLCALENDAR
// ============================================

// Import de FullCalendar
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';

window.FullCalendar = {
    Calendar,
    plugins: {
        dayGridPlugin,
        timeGridPlugin,
        listPlugin,
        interactionPlugin
    }
};

// ============================================
// 10. MOMENT.JS (pour les dates)
// ============================================

import moment from 'moment';
window.moment = moment;
moment.locale('fr');

// ============================================
// 11. SWUP (pour les transitions de page)
// ============================================

// Note: Swup est optionnel, on vérifie si on est dans un environnement compatible
let swupInstance = null;

if (process.env.NODE_ENV === 'development') {
    // En développement, on peut charger Swup
    import('swup').then(Swup => {
        import('@swup/forms-plugin').then(SwupFormsPlugin => {
            swupInstance = new Swup.default({
                plugins: [new SwupFormsPlugin.default()]
            });
        });
    }).catch(() => {
        console.log('Swup non chargé (optionnel)');
    });
}

// ============================================
// 12. CONFIGURATION GLOBALE
// ============================================

// Configuration globale pour les plugins
window.UboldConfig = {
    // Configuration pour les tooltips Bootstrap
    tooltip: {
        selector: '[data-toggle="tooltip"]',
        options: {
            container: 'body',
            trigger: 'hover',
            animation: true
        }
    },

    // Configuration pour les popovers
    popover: {
        selector: '[data-toggle="popover"]',
        options: {
            container: 'body',
            trigger: 'hover',
            animation: true
        }
    },

    // Configuration pour Select2
    select2: {
        theme: 'bootstrap4',
        width: '100%',
        placeholder: 'Sélectionner...'
    },

    // Configuration pour Toastr
    toastr: {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 5000,
        extendedTimeOut: 1000
    },

    // Configuration pour DataTables
    datatable: {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json'
        },
        pageLength: 25,
        responsive: true
    }
};

// ============================================
// 13. DÉFINITION DES FONCTIONS UTILITAIRES
// ============================================

/**
 * Initialise tous les plugins Ubold
 */
function initUboldPlugins() {
    // Initialiser les tooltips
    if ($.fn.tooltip) {
        $(window.UboldConfig.tooltip.selector).tooltip(
            window.UboldConfig.tooltip.options
        );
    }

    // Initialiser les popovers
    if ($.fn.popover) {
        $(window.UboldConfig.popover.selector).popover(
            window.UboldConfig.popover.options
        );
    }

    // Initialiser Select2
    if ($.fn.select2) {
        $('.select2').select2(window.UboldConfig.select2);
    }

    // Initialiser Waves
    if (window.Waves) {
        Waves.init();
        Waves.attach('.btn:not(.btn-shadow):not(.waves-float)', ['waves-light']);
    }

    // Initialiser Feather Icons
    if (window.feather) {
        feather.replace();
    }

    // Initialiser les compteurs
    if ($.fn.counterUp) {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    }

    // Initialiser SimpleBar
    if (window.SimpleBar) {
        document.querySelectorAll('[data-simplebar]').forEach(el => {
            new SimpleBar(el);
        });
    }

    console.log('Plugins Ubold initialisés');
}

// Exposer la fonction globalement
window.initUboldPlugins = initUboldPlugins;

/**
 * Affiche une notification
 * @param {string} type - success, error, warning, info
 * @param {string} message - Message à afficher
 * @param {string} title - Titre de la notification
 */
function showNotification(type, message, title = '') {
    if (window.toastr) {
        toastr[type](message, title, window.UboldConfig.toastr);
    } else {
        console[type === 'error' ? 'error' : 'log'](`${type}: ${message}`);
    }
}

// Exposer la fonction globalement
window.showNotification = showNotification;

/**
 * Confirmation avec SweetAlert2 (à installer si besoin)
 * @param {string} message - Message de confirmation
 * @param {string} title - Titre
 * @returns {Promise}
 */
async function showConfirmation(message, title = 'Confirmation') {
    return new Promise((resolve) => {
        if (window.confirm(`${title}: ${message}`)) {
            resolve({ isConfirmed: true });
        } else {
            resolve({ isConfirmed: false });
        }
    });
}

// Exposer la fonction globalement
window.showConfirmation = showConfirmation;

/**
 * Active le menu courant
 */
function activateCurrentMenu() {
    const currentPath = window.location.pathname;

    $('.side-nav a').each(function () {
        const $link = $(this);
        const linkHref = $link.attr('href');

        if (linkHref && currentPath.includes(linkHref.replace(/^\//, ''))) {
            $link.addClass('active');

            const $parent = $link.closest('.has-submenu');
            if ($parent.length) {
                $parent.addClass('active');
                $parent.find('.submenu').addClass('show');
            }
        }
    });
}

// Exposer la fonction globalement
window.activateCurrentMenu = activateCurrentMenu;

/**
 * Formate une date
 * @param {Date|string} date - Date à formater
 * @param {string} format - Format de sortie (par défaut: DD/MM/YYYY HH:mm)
 * @returns {string} Date formatée
 */
function formatDate(date, format = 'DD/MM/YYYY HH:mm') {
    return moment(date).format(format);
}

// Exposer la fonction globalement
window.formatDate = formatDate;

/**
 * Formate un nombre
 * @param {number} number - Nombre à formater
 * @param {number} decimals - Nombre de décimales (par défaut: 2)
 * @returns {string} Nombre formaté
 */
function formatNumber(number, decimals = 2) {
    return new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: decimals,
        maximumFractionDigits: decimals
    }).format(number);
}

// Exposer la fonction globalement
window.formatNumber = formatNumber;

// ============================================
// 14. INITIALISATION AU CHARGEMENT
// ============================================

$(document).ready(function () {
    console.log('Document ready - initialisation des plugins');

    // Initialiser les plugins Ubold
    initUboldPlugins();

    // Initialiser les DataTables
    if ($.fn.DataTable) {
        $('.datatable').DataTable(window.UboldConfig.datatable);
    }

    // Initialiser FullCalendar si présent
    if (window.FullCalendar && window.FullCalendar.Calendar) {
        $('.calendar').each(function () {
            const calendarEl = this;
            const calendar = new window.FullCalendar.Calendar(calendarEl, {
                plugins: [
                    window.FullCalendar.plugins.dayGridPlugin,
                    window.FullCalendar.plugins.timeGridPlugin,
                    window.FullCalendar.plugins.listPlugin,
                    window.FullCalendar.plugins.interactionPlugin
                ],
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                locale: 'fr',
                events: calendarEl.dataset.events ? JSON.parse(calendarEl.dataset.events) : [],
                editable: true,
                selectable: true
            });
            calendar.render();
        });
    }

    // Activer le menu courant
    activateCurrentMenu();
});

// ============================================
// 15. GESTION DES FORMULAIRES AJAX
// ============================================

// Configuration pour les formulaires avec validation
$(document).on('submit', 'form[data-ajax]', function (e) {
    e.preventDefault();
    const $form = $(this);

    $.ajax({
        url: $form.attr('action'),
        method: $form.attr('method'),
        data: $form.serialize(),
        success: function (response) {
            showNotification('success', response.message || 'Action réussie');

            // Réinitialiser les plugins après succès
            setTimeout(initUboldPlugins, 100);

            // Redirection si spécifiée
            if (response.redirect) {
                setTimeout(() => {
                    window.location.href = response.redirect;
                }, 1500);
            }
        },
        error: function (xhr) {
            showNotification('error', xhr.responseJSON?.message || 'Une erreur est survenue');
        }
    });
});

// ============================================
// 16. GESTION DES ÉVÉNEMENTS
// ============================================

// Réinitialiser les plugins après les mises à jour AJAX de Turbo
document.addEventListener('turbo:render', function () {
    setTimeout(initUboldPlugins, 50);
});

// Réinitialiser les plugins après les mises à jour Live Component
document.addEventListener('live:render', function () {
    setTimeout(initUboldPlugins, 50);
});

// ============================================
// 17. EXPORTS POUR LES MODULES
// ============================================

// Si vous voulez utiliser ces fonctions dans d'autres modules ES6,
// vous pouvez les exporter. Sinon, elles sont déjà disponibles globalement.
export {
    initUboldPlugins,
    showNotification,
    showConfirmation,
    formatDate,
    formatNumber,
    activateCurrentMenu
};

// ============================================
// 18. LOG DE DÉMARRAGE
// ============================================

if (process.env.NODE_ENV === 'development') {
    console.log(`
    ╔══════════════════════════════════════╗
    ║    Symfony + Ubold + Webpack Encore  ║
    ║           Version 1.0.0              ║
    ║      Environnement: ${process.env.NODE_ENV}     ║
    ╚══════════════════════════════════════╝
    `);
}

// ============================================
// 19. GESTION DES ERREURS
// ============================================

window.addEventListener('error', function (event) {
    console.error('Erreur JavaScript:', event.error);
});

window.addEventListener('unhandledrejection', function (event) {
    console.error('Promesse rejetée:', event.reason);
});