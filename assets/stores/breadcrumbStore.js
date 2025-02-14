// stores/breadcrumbStore.js
import { defineStore } from 'pinia';

export const useBreadcrumbStore = defineStore('breadcrumb', {
    state: () => ({
        breadcrumb: 'statistiques', // État pour stocker le texte du breadcrumb
    }),
    actions: {
        setBreadcrumb(newBreadcrumb) {
            this.breadcrumb = newBreadcrumb; // Action pour mettre à jour le breadcrumb
        },
    },
});