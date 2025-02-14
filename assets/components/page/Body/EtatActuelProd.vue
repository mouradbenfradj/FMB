<script setup>
import filiereStore from '../../../stores/filiereStore';
const fStore = filiereStore();
fStore.filieres
fStore.filieres.sort((a, b) => {
    if (a.aireDeTravaille && !b.aireDeTravaille) {
        return -1;
    } else if (!a.aireDeTravaille && b.aireDeTravaille) {
        return 1;
    } else {
        return 0;
    }
});
</script>

<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="header-title">Triggers</h4>
                <p class="sub-header">
                </p>
                <div class="mb-2">
                    <div class="row">
                        <div class="col-12 text-sm-center form-inline">
                            <div class="form-group mr-2">
                                <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                    <option value="">Tri par Réf. Filière</option>
                                    <option value="active">Tri par Capacité Filière</option>
                                    <option value="active">Tri par Remplissage Filière</option>
                                    <option value="active">Tri par Flottabilité Filière</option>
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                    <option value="">Croissant</option>
                                    <option value="active">Decroissant</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <div class="row">
                        <div class="col-12 text-sm-center form-inline">
                            <button type="button" data-page-size="10">10</button>
                            <button type="button" data-page-size="20">20</button>
                            <button type="button" data-page-size="50">50</button>
                            <button type="button" data-page-size="100">100</button>
                            <button type="button" data-page-size="200">200</button>
                        </div>
                    </div>
                </div>

                <p></p>
                <table id="demo-foo-row-toggler"
                    class="table table-bordered toggle-circle mb-0 default breakpoint footable-loaded footable">
                    <thead>
                        <tr>
                            <th data-toggle="true" class="footable-visible footable-first-column footable-sortable">
                                Réf. Filière
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th class="footable-visible footable-sortable">
                                Remplissage Filière (%)
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th class="footable-visible footable-sortable">Flottabilité Filière (%)<span
                                    class="footable-sort-indicator"></span></th>
                            <th class="footable-visible footable-sortable">
                                Capacité Filière (u)
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th class="footable-visible footable-sortable">
                                Places Remplies (u)
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th data-hide="phone" class="footable-visible footable-last-column footable-sortable">
                                Places Vides (u)
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th data-hide="all" class="footable-sortable" style="display: none;">
                                Taille Filière (m)
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th data-hide="all" class="footable-sortable" style="display: none;">
                                Nombre de place totale
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th data-hide="all" class="footable-sortable" style="display: none;">
                                Nombre de place vide
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th data-hide="all" class="footable-sortable" style="display: none;">
                                Nombre de place remplis
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th data-hide="all" class="footable-sortable" style="display: none;">
                                Nombre de place corde
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th data-hide="all" class="footable-sortable" style="display: none;">
                                Nombre de place corde huitre
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th data-hide="all" class="footable-sortable" style="display: none;">
                                Nombre de place corde moule
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th data-hide="all" class="footable-sortable" style="display: none;">
                                Nombre de place corde lanterne
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th data-hide="all" class="footable-sortable" style="display: none;">
                                Date Min MAE
                                <span class="footable-sort-indicator"></span>
                            </th>
                            <th data-hide="all" class="footable-sortable" style="display: none;">
                                Segments
                                <span class="footable-sort-indicator"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="footable-even" style="" v-for="(filiere, index) in fStore.filieres" :key="index">
                            <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>{{
                                filiere.nomFiliere }}
                            </td>
                            <td class="footable-visible">
                                <div class="progress mb-0">
                                    <div class="progress-bar bg-danger" role="danger" style="width: 99%"
                                        aria-valuenow="99" aria-valuemin="0" aria-valuemax="100">99% V</div>
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                        style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100">1
                                        % R</div>
                                </div>
                            </td>
                            <td class="footable-visible">
                                <div class="progress mb-0">
                                    <div class="progress-bar bg-danger" role="danger" style="width: 99%"
                                        aria-valuenow="99" aria-valuemin="0" aria-valuemax="100">99% V</div>
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                        style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100">1
                                        % R</div>
                                </div>
                            </td>
                            <td class="footable-visible">0</td>
                            <td class="footable-visible">0</td>
                            <td class="footable-visible footable-last-column">0</td>
                            <td style="display: none;">500</td>
                            <td style="display: none;">0</td>
                            <td style="display: none;">0</td>
                            <td style="display: none;">0</td>
                            <td style="display: none;">0</td>
                            <td style="display: none;">0</td>
                            <td style="display: none;">0</td>
                            <td style="display: none;">0</td>
                            <td style="display: none;">0</td>
                            <td style="display: none;">
                                <div class="custom-dd dd nestable_list_1" id="nestable_list_1">
                                    <ol class="dd-list">
                                        <li class="dd-item">
                                            <div class="dd-handle">
                                                Segment A <table class="table table-striped mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td> <span>Donnée supplémentaire pour la ligne 1</span>
                                                            </td>
                                                            <td> <span>1</span>
                                                            </td>
                                                            <td> <span>2</span>
                                                            </td>
                                                            <td> <span>3</span>
                                                            </td>
                                                            <td> <span>4</span>
                                                            </td>
                                                            <td> <span>5</span>
                                                            </td>
                                                            <td> <span>6</span>
                                                            </td>
                                                            <td> <span>7</span>
                                                            </td>
                                                            <td> <span>8</span>
                                                            </td>
                                                            <td> <span>9</span>
                                                            </td>
                                                            <td> <span>10</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <span>Donnée supplémentaire pour la ligne 2</span>
                                                            </td>
                                                            <td> <span>1</span>
                                                            </td>
                                                            <td> <span>2</span>
                                                            </td>
                                                            <td> <span>3</span>
                                                            </td>
                                                            <td> <span>4</span>
                                                            </td>
                                                            <td> <span>5</span>
                                                            </td>
                                                            <td> <span>6</span>
                                                            </td>
                                                            <td> <span>7</span>
                                                            </td>
                                                            <td> <span>8</span>
                                                            </td>
                                                            <td> <span>9</span>
                                                            </td>
                                                            <td> <span>10</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <span>Donnée supplémentaire pour la ligne 3</span>
                                                            </td>
                                                            <td> <span>1</span>
                                                            </td>
                                                            <td> <span>2</span>
                                                            </td>
                                                            <td> <span>3</span>
                                                            </td>
                                                            <td> <span>4</span>
                                                            </td>
                                                            <td> <span>5</span>
                                                            </td>
                                                            <td> <span>6</span>
                                                            </td>
                                                            <td> <span>7</span>
                                                            </td>
                                                            <td> <span>8</span>
                                                            </td>
                                                            <td> <span>9</span>
                                                            </td>
                                                            <td> <span>10</span>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>

                                    </ol>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="active">
                            <td colspan="6" class="footable-visible">
                                <div class="text-right">
                                    <ul
                                        class="pagination pagination-split justify-content-end footable-pagination m-t-10">
                                        <li class="footable-page-arrow disabled"><a data-page="first"
                                                href="#first">«</a></li>
                                        <li class="footable-page-arrow disabled"><a data-page="prev" href="#prev">‹</a>
                                        </li>
                                        <li class="footable-page active"><a data-page="0" href="#">1</a></li>
                                        <li class="footable-page"><a data-page="1" href="#">2</a></li>
                                        <li class="footable-page"><a data-page="2" href="#">3</a></li>
                                        <li class="footable-page"><a data-page="3" href="#">4</a></li>
                                        <li class="footable-page"><a data-page="4" href="#">5</a></li>
                                        <li class="footable-page"><a data-page="5" href="#">6</a></li>
                                        <li class="footable-page"><a data-page="6" href="#">7</a></li>
                                        <li class="footable-page-arrow"><a data-page="next" href="#next">›</a></li>
                                        <li class="footable-page-arrow"><a data-page="last" href="#last">»</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tfoot>

                </table>
            </div>
            <!-- end card-box -->
        </div>
        <!-- end col -->
    </div>
</template>
<style scoped></style>