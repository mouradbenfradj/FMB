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
    const $table = $('.demo-foo-row-toggler');

    if ($table.length === 0) {
        console.log('Table non trouvée sur cette page');
        return;
    }

    // Use data from template
    const data = window.filieresData;
    console.log('Data loaded:', data.length, 'filieres');

    const tbody = document.getElementById('table-body');
    const progressBar = document.getElementById('table-loading-progress');
    const progressBarInner = progressBar.querySelector('.progress-bar');
    progressBarInner.style.width = '0%';
    progressBarInner.setAttribute('aria-valuenow', 0);
    progressBarInner.textContent = 'Chargement du tableau...';

    const total = data.length;
    let current = 0;

    for (let i = 0; i < data.length; i++) {
        setTimeout(() => {
            current = i + 1;
            const percentage = Math.round((current / total) * 100);
            progressBarInner.style.width = `${percentage}%`;
            progressBarInner.setAttribute('aria-valuenow', percentage);
            progressBarInner.textContent = `${current}/${total}`;

            const row = document.createElement('tr');
            row.innerHTML = generateRowHTML(data[i]);
            tbody.appendChild(row);

            if (current === total) {
                console.log('3. Table remplie avec', $table.find('tbody tr').length, 'lignes');

                // Afficher le tableau et masquer la barre de progression
                $table.show();
                $('#table-loading-progress').hide();

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
            }
        }, i * 100); // 100ms delay per row
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

// Fonctions pour générer le HTML des lignes
function generateRowHTML(filiere) {
    const etat = filiere;
    const rouge = Math.round(etat.remplissage);
    const vert = etat.flottabiliter > 0 ? Math.round(((etat.flottabiliter - etat.poidCordes) / etat.flottabiliter * 100)) : 0;
    const classRouge = vert < 0 ? "bg-warning" : "bg-danger";
    const classVert = vert < 0 ? "bg-info" : "bg-success";
    const segmentsHTML = generateSegmentsHTML(etat.segments);

    return `
        <td>${etat.nomFiliere}</td>
        <td>
            <div class="progress mb-0">
                <div class="progress-bar bg-danger" style="width: ${rouge}%" aria-valuenow="${rouge}" aria-valuemin="0" aria-valuemax="100">${rouge} % R</div>
                <div class="progress-bar progress-bar-striped bg-success" style="width: ${100 - rouge}%" aria-valuenow="${100 - rouge}" aria-valuemin="0" aria-valuemax="100">${100 - rouge} % V</div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="grid-container">
                        Places totales ${etat.totalEmplacement}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="grid-container">
                        Places Remplies ${etat.emplacementRemplit}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="grid-container">
                        Places Vides ${etat.emplacementVide}
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="progress mb-0">
                <div class="progress-bar progress-bar-striped ${classRouge}" style="width: ${Math.round(100 - vert)}%" aria-valuenow="${Math.round(100 - vert)}" aria-valuemin="0" aria-valuemax="100">${Math.round(100 - vert)} % R</div>
                <div class="progress-bar progress-bar-striped ${classVert}" style="width: ${Math.round(vert)}%" aria-valuenow="${Math.round(vert)}" aria-valuemin="0" aria-valuemax="100">${Math.round(vert)} % V</div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="grid-container">
                        F ${etat.volumesTotale} (L)
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="grid-container">
                        F ${etat.flottabiliter} (kgf)
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="grid-container">
                        Production ${etat.poidCordes} (kgf)
                    </div>
                </div>
            </div>
        </td>
        <td>${etat.taille} m</td>
        <td>${etat.totalEmplacement}</td>
        <td>${etat.emplacementVide}</td>
        <td>${etat.emplacementRemplit}</td>
        <td>${etat.totalCorde}</td>
        <td>${etat.totalCordeHuitre}</td>
        <td>${etat.totalCordeMoule}</td>
        <td>${etat.totalCordeLanterne}</td>
        <td>${etat.totalCordePoche}</td>
        <td>${etat.flottabiliter}</td>
        <td>${etat.dateDeMAE || ''}</td>
        <td>
            <div class="custom-dd-empty dd nestable_list_3">
                ${segmentsHTML}
            </div>
        </td>
    `;
}

function generateSegmentsHTML(segments) {
    let html = '';
    segments.forEach(segment => {
        const rouge = segment.totalEmplacement > 0 ? Math.round((segment.totalCorde / segment.totalEmplacement) * 100) : 0;
        const vert = segment.flottabiliter > 0 ? Math.round(((segment.flottabiliter - segment.poidCordes) / segment.flottabiliter * 100)) : 0;
        const classRouge = vert < 0 ? "bg-warning" : "bg-danger";
        const classVert = vert < 0 ? "bg-info" : "bg-success";

        html += `
            <div data-controller="reveal" data-reveal-hidden-class="d-none">
                <button data-action="reveal#toggle" type="button" class="btn">Segment ${segment.nomSegment}</button>
                <table data-reveal-target="item" class="d-none mt-4 demo-foo-row-toggler table table-bordered toggle-circle mb-0" width="100%">
                    <tbody>
                        <tr>
                            <th>Nom Segment<span class="footable-sort-indicator"></span></th>
                            <td>Segment ${segment.nomSegment}</td>
                        </tr>
                        <tr>
                            <th>Remplissage Segment (%)<span class="footable-sort-indicator"></span></th>
                            <td>
                                <div class="progress mb-0">
                                    <div class="progress-bar bg-danger" style="width: ${rouge}%" aria-valuenow="${rouge}" aria-valuemin="0" aria-valuemax="100">${rouge} % R</div>
                                    <div class="progress-bar progress-bar-striped bg-success" style="width: ${100 - rouge}%" aria-valuenow="${100 - rouge}" aria-valuemin="0" aria-valuemax="100">${100 - rouge} % V</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="grid-container">
                                            Places totales ${segment.totalEmplacement}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="grid-container">
                                            Places Remplies ${segment.totalCorde}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="grid-container">
                                            Places Vides ${segment.totalEmplacement - segment.totalCorde}
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Flottabilité Segment (%)<span class="footable-sort-indicator"></span></th>
                            <td>
                                <div class="progress mb-0">
                                    <div class="progress-bar progress-bar-striped ${classRouge}" style="width: ${Math.round(100 - vert)}%" aria-valuenow="${Math.round(100 - vert)}" aria-valuemin="0" aria-valuemax="100">${Math.round(100 - vert)} % R</div>
                                    <div class="progress-bar progress-bar-striped ${classVert}" style="width: ${Math.round(vert)}%" aria-valuenow="${Math.round(vert)}" aria-valuemin="0" aria-valuemax="100">${Math.round(vert)} % V</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="grid-container">
                                            F ${segment.volumesTotale} (L)
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="grid-container">
                                            F ${segment.flottabiliter} (kgf)
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="grid-container">
                                            Production ${segment.poidCordes} (kgf)
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Taille Segment (m)<span class="footable-sort-indicator"></span></th>
                            <td>${segment.taille}</td>
                        </tr>
                        <tr>
                            <th>Total Emplacements (u)<span class="footable-sort-indicator"></span></th>
                            <td>${segment.totalEmplacement}</td>
                        </tr>
                        <tr>
                            <th>Emplacements Vides (u)<span class="footable-sort-indicator"></span></th>
                            <td>${segment.emplacementVide}</td>
                        </tr>
                        <tr>
                            <th>Emplacements Remplis (u)<span class="footable-sort-indicator"></span></th>
                            <td>${segment.emplacementRemplit}</td>
                        </tr>
                        <tr>
                            <th>Total Cordes (u)<span class="footable-sort-indicator"></span></th>
                            <td>${segment.totalCorde}</td>
                        </tr>
                        <tr>
                            <th>Total Cordes Huitre (u)<span class="footable-sort-indicator"></span></th>
                            <td>${segment.totalCordeHuitre}</td>
                        </tr>
                        <tr>
                            <th>Total Cordes Moule (u)<span class="footable-sort-indicator"></span></th>
                            <td>${segment.totalCordeMoule}</td>
                        </tr>
                        <tr>
                            <th>Total Lanternes (u)<span class="footable-sort-indicator"></span></th>
                            <td>${segment.totalCordeLanterne}</td>
                        </tr>
                        <tr>
                            <th>Total Poches (u)<span class="footable-sort-indicator"></span></th>
                            <td>${segment.totalCordePoche}</td>
                        </tr>
                        <tr>
                            <th>Total Passages chaussettes (u)<span class="footable-sort-indicator"></span></th>
                            <td>${segment.passageChaussette}</td>
                        </tr>
                        <tr>
                            <th>Dérniere Date De MAE<span class="footable-sort-indicator"></span></th>
                            <td>${segment.dateDeMAE || 'N/A'}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `;
    });
    return html;
}

// Exposer la fonction pour un usage manuel
window.initFootableTable = initFootableTable;
