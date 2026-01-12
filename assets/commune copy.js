/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import './styles/app.css';

// 1. Importer jQuery
import $ from 'jquery';

// 2. CRUCIAL : Exposer jQuery comme variable GLOBALE
// Footable a besoin de trouver jQuery dans window
window.$ = window.jQuery = $;
global.$ = global.jQuery = $;

console.log('=== CHARGEMENT APP ===');
console.log('jQuery version:', $.fn.jquery);

// 3. Importer Footable - IMPORTANT : utiliser l'import SANS assignation
// Cela permet à Footable de s'auto-attacher à la jQuery globale
import 'footable';

// Vérifier immédiatement
console.log('Footable importé, $.fn.footable?', typeof $.fn.footable);

// 4. Si Footable ne s'est pas attaché, forcer l'attachement
if (typeof $.fn.footable === 'undefined') {
    console.log('Footable non attaché, vérification de window.Footable...');

    // Attendre un peu que Footable se charge
    setTimeout(() => {
        console.log('window.Footable après timeout:', window.Footable);
        console.log('$.fn.footable après timeout:', typeof $.fn.footable);

        // Si toujours pas attaché, essayer manuellement
        if (typeof $.fn.footable === 'undefined' && window.Footable) {
            console.log('Tentative d\'attachement manuel...');

            if (typeof window.Footable === 'function') {
                window.Footable($, window, document);
            } else if (window.Footable.plugin) {
                window.Footable.plugin($, window, document);
            }

            console.log('Après attachement manuel, $.fn.footable:', typeof $.fn.footable);
        }
    }, 100);
}

// 5. Importer la version compilée qui s'attache mieux
import 'footable/dist/footable.all.js';

// 6. Autres imports
import 'bootstrap';
import 'simplebar';
import 'node-waves';
import feather from 'feather-icons';

// 7. Vos fichiers
import './js/app.js';

// IMPORTANT : Importer l'initialisation Footable APRÈS tout
import './js/pages/foo-tables.init.js';

// 8. Initialiser feather
feather.replace();

// Vérification finale
setTimeout(() => {
    console.log('=== VERIFICATION FINALE ===');
    console.log('jQuery version:', $.fn.jquery);
    console.log('$.fn.footable:', typeof $.fn.footable);
    console.log('window.Footable:', window.Footable);
}, 500);