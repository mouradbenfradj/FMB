// foo-tables.init.js - Version corrigée pour Webpack

// Fonction d'initialisation principale
function initFootableTable() {
    console.log('=== INITIALISATION FOOTABLE ===');

    // Récupérer jQuery depuis window (garanti d'être global)
    const $ = window.jQuery || window.$;

    if (!$) {
        console.error('❌ jQuery non disponible dans window');
        return;
    }

    console.log('1. jQuery version:', $.fn.jquery);
    console.log('2. $.fn.footable présent?', typeof $.fn.footable);

    // Si Footable n'est pas disponible, réessayer plus tard
    if (typeof $.fn.footable === 'undefined') {
        console.warn('⚠️ Footable non disponible, nouvel essai dans 500ms');
        setTimeout(initFootableTable, 500);
        return;
    }

    // Cibler la table
    const $table = $('#demo-foo-row-toggler');

    if ($table.length === 0) {
        console.log('Table non trouvée sur cette page');
        return;
    }

    console.log('3. Table trouvée avec', $table.find('tbody tr').length, 'lignes');

    // Éviter la double initialisation
    if ($table.data('footable')) {
        console.log('Table déjà initialisée, destruction...');
        $table.trigger('footable_destroy');
        $table.removeData('footable');
    }

    // Initialiser Footable
    try {
        console.log('4. Initialisation Footable en cours...');

        $table.footable({
            paginate: true,
            pageSize: 20,
            sort: true,
            showToggle: true,
            toggleSelector: ' > thead > tr > th:first-child',
            empty: 'Aucune donnée disponible',
            debug: true, // Activer le debug de Footable
            on: {
                'ready.ft.table': function (e, ft) {
                    console.log('✅ Footable prêt!');
                    console.log('Info pagination:', ft.paging.info());

                    // Mettre à jour l'affichage
                    updatePaginationDisplay(ft);
                },
                'after.ft.paging': function (e, ft) {
                    updatePaginationDisplay(ft);
                },
                'after.ft.sort': function (e, ft) {
                    console.log('Tri appliqué');
                }
            }
        });

        console.log('✅ Footable initialisé avec succès');

    } catch (error) {
        console.error('❌ Erreur lors de l\'initialisation Footable:', error);
        return;
    }

    // Fonction pour mettre à jour l'affichage de la pagination
    function updatePaginationDisplay(ft) {
        const info = ft.paging.info();
        console.log(`Page ${info.currentPage} sur ${info.totalPages} - ${info.totalRows} lignes`);

        // Mettre à jour un éventuel élément d'affichage
        const $display = $('#pagination-info');
        if ($display.length === 0) {
            // Créer l'élément s'il n'existe pas
            $('<div id="pagination-info" class="text-muted small mt-2"></div>')
                .insertAfter($table.closest('.table-responsive').length ?
                    $table.closest('.table-responsive') : $table.parent());
        }

        $('#pagination-info').html(
            `Affichage des lignes ${info.range.start + 1} à ${info.range.end} sur ${info.totalRows}`
        );
    }

    // Gestion des boutons de taille de page
    $('.page-size-btn').off('click.footable').on('click.footable', function (e) {
        e.preventDefault();
        const size = parseInt($(this).data('page-size'));
        console.log('Changement taille page:', size);

        // Mettre à jour le bouton actif
        $('.page-size-btn').removeClass('active');
        $(this).addClass('active');

        // Changer la taille de page
        $table.data('page-size', size);
        $table.trigger('footable_initialized');
    });

    // Gestion du tri personnalisé
    $('#sort-column-select, #sort-direction-select').off('change.footable').on('change.footable', function () {
        const columnIndex = parseInt($('#sort-column-select').val());
        const direction = $('#sort-direction-select').val();

        console.log('Tri demandé - Colonne:', columnIndex, 'Direction:', direction);

        const $th = $table.find('thead th').eq(columnIndex);

        if ($th.length === 0) {
            console.warn('Colonne non trouvée:', columnIndex);
            return;
        }

        // Nettoyer les classes de tri
        $table.find('thead th').removeClass('footable-sorted footable-sorted-desc');

        // Appliquer la classe de direction
        if (direction === 'DESC') {
            $th.addClass('footable-sorted-desc');
        } else {
            $th.addClass('footable-sorted');
        }

        // Déclencher le tri
        $th.trigger('click.footable');
    });

    // Bouton pour réinitialiser
    $('<button class="btn btn-sm btn-outline-secondary ml-2" id="reset-footable">Réinitialiser</button>')
        .insertAfter('.page-size-btn:last')
        .on('click', function () {
            console.log('Réinitialisation Footable');
            $table.trigger('footable_destroy');
            setTimeout(initFootableTable, 100);
        });

    console.log('=== INITIALISATION TERMINÉE ===');
}

// Attendre que le DOM soit prêt
function initialize() {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            // Petit délai pour garantir que tout est chargé
            setTimeout(initFootableTable, 300);
        });
    } else {
        setTimeout(initFootableTable, 300);
    }
}

// Initialiser
initialize();

// Pour Swup (si utilisé)
if (typeof document.addEventListener === 'function') {
    document.addEventListener('swup:pageView', function () {
        console.log('Swup détecté, réinitialisation Footable...');
        setTimeout(initFootableTable, 500);
    });
}

// Exposer la fonction pour un usage manuel
window.initFootableTable = initFootableTable;