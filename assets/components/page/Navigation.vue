<script setup>
import { useParcsStore } from '../../stores/parcStore';
const store = useParcsStore();
</script>

<template>
    <div class="topnav shadow-lg">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <router-link to="/statistiques" class="nav-link dropdown-toggle arrow-none" id="statistique"
                                role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-anchor mr-1"></i>Statistiques <!-- <div class="arrow-down"></div> -->
                            </router-link>
                        </li>
                        <li class="nav-item dropdown" v-if="store.parcID !== 0">
                            <router-link to="/etat-actuel-prod" class="nav-link dropdown-toggle arrow-none"
                                id="etat_actuel_prod" role="button" data-toggle="dropdown" aria-haspopup="false"
                                aria-expanded="false">
                                <i class="fe-map mr-1"></i>Etat Actuel Prod <!-- <div class="arrow-down"></div> -->
                            </router-link>
                            <!-- <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                <a href="layouts-vertical.html" class="dropdown-item">Vertical</a>
                                <a href="layouts-detached.html" class="dropdown-item">Detached</a>
                                <a href="layouts-two-column.html" class="dropdown-item">Two Column Menu</a>
                                <a href="layouts-two-tone-icons.html" class="dropdown-item">Two Tones Icons</a>
                                <a href="layouts-preloader.html" class="dropdown-item">Preloader</a>
                            </div> -->
                        </li>
                        <li class="nav-item dropdown" v-if="store.parcID !== 0">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="prod_a_faire" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fe-cpu mr-1"></i>Prod à faire <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="prod_a_faire">
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-shopping-cart mr-1"></i>Préparation <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                        <a href="ecommerce-dashboard.html" class="dropdown-item">Corde</a>
                                        <a href="ecommerce-products.html" class="dropdown-item">Lanterne</a>
                                        <a href="ecommerce-product-detail.html" class="dropdown-item">Poche</a>
                                    </div>
                                </div>
                                <a href="apps-calendar.html" class="dropdown-item"><i class="fe-calendar mr-1"></i>
                                    Assemblage</a>


                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="mae" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-mail mr-1"></i> Mise a eau <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="mae">
                                        <a href="email-inbox.html" class="dropdown-item">Cordes</a>
                                        <a href="email-read.html" class="dropdown-item">Lanternes</a>
                                        <a href="email-compose.html" class="dropdown-item">Assemblages</a>
                                        <a href="email-templates.html" class="dropdown-item">Poches</a>
                                    </div>
                                </div>
                                <a href="apps-chat.html" class="dropdown-item"><i class="fe-message-square mr-1"></i>
                                    Passage Chaussettes</a>

                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="retrait"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-briefcase mr-1"></i> Retrait <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="retrait">
                                        <a href="project-detail.html" class="dropdown-item">AW Lanternes</a>
                                        <a href="project-create.html" class="dropdown-item">AW Poches</a>
                                        <a href="project-list.html" class="dropdown-item">Transfert</a>

                                    </div>
                                </div>

                                <a href="apps-social-feed.html" class="dropdown-item"><i class="fe-rss mr-1"></i>
                                    Traitement Comercial</a>



                                <!-- <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-crm"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-users mr-1"></i> CRM <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-crm">
                                        <a href="crm-dashboard.html" class="dropdown-item">Dashboard</a>
                                        <a href="crm-contacts.html" class="dropdown-item">Contacts</a>
                                        <a href="crm-opportunities.html" class="dropdown-item">Opportunities</a>
                                        <a href="crm-leads.html" class="dropdown-item">Leads</a>
                                        <a href="crm-customers.html" class="dropdown-item">Customers</a>
                                    </div>
                                </div>

                                <a href="apps-companies.html" class="dropdown-item"><i class="fe-activity mr-1"></i>
                                    Companies</a>


                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-task"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-clipboard mr-1"></i> Tasks <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-task">
                                        <a href="task-list.html" class="dropdown-item">List</a>
                                        <a href="task-details.html" class="dropdown-item">Details</a>
                                        <a href="task-kanban-board.html" class="dropdown-item">Kanban Board</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-contact"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-book mr-1"></i> Contacts <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                        <a href="contacts-list.html" class="dropdown-item">Members List</a>
                                        <a href="contacts-profile.html" class="dropdown-item">Profile</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-tickets"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-aperture mr-1"></i> Tickets <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-tickets">
                                        <a href="tickets-list.html" class="dropdown-item">List</a>
                                        <a href="tickets-detail.html" class="dropdown-item">Detail</a>
                                    </div>
                                </div>
                                <a href="apps-file-manager.html" class="dropdown-item"><i
                                        class="fe-folder-plus mr-1"></i> File Manager</a> -->
                            </div>
                        </li>

                        <li class="nav-item dropdown" v-if="store.parcID !== 0">
                            <router-link to="/alertes-de-travail" class="nav-link dropdown-toggle arrow-none"
                                id="alertes_de_travailles" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fe-alert-triangle mr-1"></i> Alertes de travail
                                <!-- <div class="arrow-down"></div> -->
                            </router-link>

                            <!-- <div class="dropdown-menu mega-dropdown-menu dropdown-mega-menu-xl"
                                aria-labelledby="alertes_de_travailles">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div>
                                            <a href="ui-buttons.html" class="dropdown-item">Buttons</a>
                                            <a href="ui-cards.html" class="dropdown-item">Cards</a>
                                            <a href="ui-avatars.html" class="dropdown-item">Avatars</a>
                                            <a href="ui-portlets.html" class="dropdown-item">Portlets</a>
                                            <a href="ui-tabs-accordions.html" class="dropdown-item">Tabs &
                                                Accordions</a>
                                            <a href="ui-modals.html" class="dropdown-item">Modals</a>
                                            <a href="ui-progress.html" class="dropdown-item">Progress</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <a href="ui-notifications.html" class="dropdown-item">Notifications</a>
                                            <a href="ui-spinners.html" class="dropdown-item">Spinners</a>
                                            <a href="ui-images.html" class="dropdown-item">Images</a>
                                            <a href="ui-carousel.html" class="dropdown-item">Carousel</a>
                                            <a href="ui-list-group.html" class="dropdown-item">List Group</a>
                                            <a href="ui-video.html" class="dropdown-item">Embed Video</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <a href="ui-dropdowns.html" class="dropdown-item">Dropdowns</a>
                                            <a href="ui-ribbons.html" class="dropdown-item">Ribbons</a>
                                            <a href="ui-tooltips-popovers.html" class="dropdown-item">Tooltips &
                                                Popovers</a>
                                            <a href="ui-general.html" class="dropdown-item">General UI</a>
                                            <a href="ui-typography.html" class="dropdown-item">Typography</a>
                                            <a href="ui-grid.html" class="dropdown-item">Grid</a>
                                        </div>
                                    </div>
                                </div>

                            </div> -->
                        </li>

                        <li class="nav-item dropdown" v-if="store.parcID !== 0">
                            <router-link to="/prod-par-cycle" class="nav-link dropdown-toggle arrow-none"
                                id="prod_par_cycle" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fe-clock mr-1"></i> Prod par cycle <!-- <div class="arrow-down"></div> -->
                            </router-link>
                            <!-- <div class="dropdown-menu" aria-labelledby="prod_par_cycle">
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-extendedui"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-pocket mr-1"></i> Extended UI <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-extendedui">
                                        <a href="extended-nestable.html" class="dropdown-item">Nestable List</a>
                                        <a href="extended-range-slider.html" class="dropdown-item">Range Slider</a>
                                        <a href="extended-dragula.html" class="dropdown-item">Dragula</a>
                                        <a href="extended-animation.html" class="dropdown-item">Animation</a>
                                        <a href="extended-sweet-alert.html" class="dropdown-item">Sweet Alert</a>
                                        <a href="extended-tour.html" class="dropdown-item">Tour Page</a>
                                        <a href="extended-scrollspy.html" class="dropdown-item">Scrollspy</a>
                                        <a href="extended-loading-buttons.html" class="dropdown-item">Loading
                                            Buttons</a>
                                    </div>
                                </div>
                                <a href="widgets.html" class="dropdown-item"><i class="fe-gift mr-1"></i> Widgets</a>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-bookmark mr-1"></i> Forms <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-form">
                                        <a href="forms-elements.html" class="dropdown-item">General Elements</a>
                                        <a href="forms-advanced.html" class="dropdown-item">Advanced</a>
                                        <a href="forms-validation.html" class="dropdown-item">Validation</a>
                                        <a href="forms-pickers.html" class="dropdown-item">Pickers</a>
                                        <a href="forms-wizard.html" class="dropdown-item">Wizard</a>
                                        <a href="forms-masks.html" class="dropdown-item">Masks</a>
                                        <a href="forms-summernote.html" class="dropdown-item">Summernote</a>
                                        <a href="forms-quilljs.html" class="dropdown-item">Quilljs Editor</a>
                                        <a href="forms-file-uploads.html" class="dropdown-item">File Uploads</a>
                                        <a href="forms-x-editable.html" class="dropdown-item">X Editable</a>
                                        <a href="forms-image-crop.html" class="dropdown-item">Image Crop</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-bar-chart-2 mr-1"></i> Charts <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                        <a href="charts-apex.html" class="dropdown-item">Apex Charts</a>
                                        <a href="charts-flot.html" class="dropdown-item">Flot Charts</a>
                                        <a href="charts-morris.html" class="dropdown-item">Morris Charts</a>
                                        <a href="charts-chartjs.html" class="dropdown-item">Chartjs Charts</a>
                                        <a href="charts-peity.html" class="dropdown-item">Peity Charts</a>
                                        <a href="charts-chartist.html" class="dropdown-item">Chartist Charts</a>
                                        <a href="charts-c3.html" class="dropdown-item">C3 Charts</a>
                                        <a href="charts-sparklines.html" class="dropdown-item">Sparklines Charts</a>
                                        <a href="charts-knob.html" class="dropdown-item">Jquery Knob Charts</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-grid mr-1"></i> Tables <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-table">
                                        <a href="tables-basic.html" class="dropdown-item">Basic Tables</a>
                                        <a href="tables-datatables.html" class="dropdown-item">Data Tables</a>
                                        <a href="tables-editable.html" class="dropdown-item">Editable Tables</a>
                                        <a href="tables-responsive.html" class="dropdown-item">Responsive Tables</a>
                                        <a href="tables-footables.html" class="dropdown-item">FooTable</a>
                                        <a href="tables-bootstrap.html" class="dropdown-item">Bootstrap Tables</a>
                                        <a href="tables-tablesaw.html" class="dropdown-item">Tablesaw Tables</a>
                                        <a href="tables-jsgrid.html" class="dropdown-item">JsGrid Tables</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-cpu mr-1"></i> Icons <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                        <a href="icons-two-tone.html" class="dropdown-item">Two Tone Icons</a>
                                        <a href="icons-feather.html" class="dropdown-item">Feather Icons</a>
                                        <a href="icons-mdi.html" class="dropdown-item">Material Design Icons</a>
                                        <a href="icons-dripicons.html" class="dropdown-item">Dripicons</a>
                                        <a href="icons-font-awesome.html" class="dropdown-item">Font Awesome 5</a>
                                        <a href="icons-themify.html" class="dropdown-item">Themify</a>
                                        <a href="icons-simple-line.html" class="dropdown-item">Simple Line</a>
                                        <a href="icons-weather.html" class="dropdown-item">Weather</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fe-map mr-1"></i> Maps <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-map">
                                        <a href="maps-google.html" class="dropdown-item">Google Maps</a>
                                        <a href="maps-vector.html" class="dropdown-item">Vector Maps</a>
                                        <a href="maps-mapael.html" class="dropdown-item">Mapael Maps</a>
                                    </div>
                                </div>
                            </div> -->
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="outils_de_gestion" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fe-package mr-1"></i> Outils de gestion <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="outils_de_gestion">
                                <a href="apps-file-manager.html" class="dropdown-item"><i
                                        class="fe-folder-plus mr-1"></i> Historique des opérations</a>
                                <a href="apps-file-manager.html" class="dropdown-item"><i
                                        class="fe-folder-plus mr-1"></i> Détail tâches effectuées</a>
                                <a href="apps-file-manager.html" class="dropdown-item"><i
                                        class="fe-folder-plus mr-1"></i> Prévisions des sorties</a>
                            </div>
                        </li>

                    </ul> <!-- end navbar-->
                </div> <!-- end .collapsed-->
            </nav>
        </div> <!-- end container-fluid -->
    </div> <!-- end topnav-->



</template>


<style scoped></style>