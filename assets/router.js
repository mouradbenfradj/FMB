// router.js
import { createRouter, createWebHistory } from 'vue-router';
import { useBreadcrumbStore } from './stores/breadcrumbStore'; // Importez le store Pinia


// Importez vos composants pour les routes
import EtatActuelProd from './components/page/Body/EtatActuelProd.vue';
import ProdParCycle from './components/page/Body/ProdParCycle.vue';
import Statistique from './components/page/Body/Statistique.vue';
import AlertesDeTravail from './components/page/Body/AlertesDeTravail.vue';
import ProdAFaire from './components/page/Body/ProdAFaire.vue';
import OutilsDeGestion from './components/page/Body/OutilsDeGestion.vue';
import Content from './components/page/Body/Content.vue';

const routes = [
    {
        path: '/statistiques', component: Statistique, meta: { breadcrumb: 'Statistiques' } // Ajoutez le texte du breadcrumb
    },
    {
        path: '/vue', component: Statistique, meta: { breadcrumb: 'Vue' } // Ajoutez le texte du breadcrumb
    },
    {
        path: '/etat-actuel-prod', component: EtatActuelProd, meta: { breadcrumb: 'État actuel de production' } // Ajoutez le texte du breadcrumb
    },
    /*
    { 
    path: '/prod-a-faire', component: ProdAFaire 
    },*/
    {
        path: '/alertes-de-travail', component: AlertesDeTravail, meta: { breadcrumb: 'Alertes de travail' } // Ajoutez le texte du breadcrumb
    },
    {
        path: '/prod-par-cycle', component: ProdParCycle, meta: { breadcrumb: 'Production par cycle' } // Ajoutez le texte du breadcrumb
    },
    /*
    { path: '/outils-de-gestion', component: OutilsDeGestion }, 
     */
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const breadcrumbStore = useBreadcrumbStore(); // Accédez au store Pinia
    if (to.meta.breadcrumb) {
        breadcrumbStore.setBreadcrumb(to.meta.breadcrumb); // Mettez à jour le breadcrumb dans le store
    }
    next();
});

export default router;