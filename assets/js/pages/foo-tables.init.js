// Footable est maintenant chargé dans commune.js
// On s'appuie sur la jQuery globale fournie par commune.js
const $ = window.jQuery || window.$;

function initFootableTable() {
    console.log('=== FOOTABLE DEBUG START ===');
    console.log('1. jQuery présent?', !!$);
    console.log('2. jQuery version:', $ ? $.fn.jquery : 'N/A');
    console.log('3. $.fn.footable présent?', $ && typeof $.fn.footable === 'function');

    if (!$ || !$.fn) {
        console.error('❌ Footable init: jQuery global introuvable');
        return;
    }

    if (typeof $.fn.footable !== 'function') {
        console.error('❌ Footable init: $.fn.footable est introuvable');
        console.log('Plugins jQuery disponibles:', Object.keys($.fn).filter(k => !k.startsWith('_')).slice(0, 20));
        return;
    }

    const $table = $('#demo-foo-row-toggler');
    console.log('4. Table trouvée?', $table.length > 0);

    if ($table.length === 0) {
        console.warn('⚠️ Pas de table #demo-foo-row-toggler sur cette page');
        return;
    }

    console.log('5. Nombre de lignes tbody:', $table.find('tbody tr').length);
    console.log('6. Nombre de colonnes thead:', $table.find('thead th').length);

    // Éviter une réinitialisation multiple (Swup)
    if ($table.hasClass('footable-loaded')) {
        console.log('7. Destruction de l\'ancienne instance Footable');
        // Footable v2 : utiliser trigger pour détruire
        $table.trigger('footable_destroy');
        $table.removeData('footable');
    }

    console.log('8. Initialisation Footable...');
    try {
        $table.footable({
            paginate: true,
            pageSize: 20,
            sort: true
        });
        console.log('✅ Footable initialisé avec succès');
        console.log('9. Instance Footable:', $table.data('footable'));
    } catch (error) {
        console.error('❌ Erreur lors de l\'initialisation Footable:', error);
    }

    // Boutons de pagination (changement du nombre de lignes)
    // Utiliser la même méthode que l'exemple UBold
    $('.page-size-btn').off('click.footablePageSize').on('click.footablePageSize', function (e) {
        e.preventDefault();
        const size = $(this).data('page-size');
        console.log('Changement de taille de page:', size);

        // Retirer la classe active de tous les boutons
        $('.page-size-btn').removeClass('active');
        // Ajouter la classe active au bouton cliqué
        $(this).addClass('active');

        // Méthode exacte de l'exemple UBold
        $table.data('page-size', size);
        $table.trigger('footable_initialized');
    });

    // Select de tri par colonne
    const $sortColumn = $('#sort-column-select');
    const $sortDirection = $('#sort-direction-select');

    function applySorting() {
        const columnIndex = parseInt($sortColumn.val());
        const direction = $sortDirection.val(); // 'ASC' ou 'DESC'

        console.log('Tri appliqué - Colonne:', columnIndex, 'Direction:', direction);

        const $th = $table.find('thead th').eq(columnIndex);

        // Retirer les classes de tri existantes
        $table.find('thead th').removeClass('footable-sorted footable-sorted-desc');

        // Ajouter la classe de tri appropriée
        if (direction === 'DESC') {
            $th.addClass('footable-sorted-desc');
        } else {
            $th.addClass('footable-sorted');
        }

        // Déclencher le tri Footable
        $th.trigger('click.footable');
    }

    if ($sortColumn.length && $sortDirection.length) {
        console.log('10. Contrôles de tri trouvés, liaison...');

        $sortColumn.off('change.footableSort').on('change.footableSort', function () {
            applySorting();
        });

        $sortDirection.off('change.footableSort').on('change.footableSort', function () {
            applySorting();
        });
    }

    // Adaptation de la logique "demo-show-entries" UBold pour cette table
    const $showEntries = $('#demo-show-entries');
    if ($showEntries.length) {
        console.log('10. Select show-entries trouvé, liaison...');
        // Namespacer l'event pour éviter les doublons lors des ré-inits Swup
        $showEntries.off('change.footableDemo').on('change.footableDemo', function (e) {
            e.preventDefault();
            const size = $(this).val();
            console.log('Changement de taille de page:', size);
            $table.data('page-size', size);
            $table.trigger('footable_initialized');
        });
    }

    console.log('=== FOOTABLE DEBUG END ===');
}

// Chargement initial (premier load)
$(window).on('load', initFootableTable);

// Re-initialisation après navigation Swup
document.addEventListener('swup:pageView', initFootableTable);