import { defineStore } from "pinia";
import { API_BASE_URL } from "../config/constants";
export default defineStore('filieres', {
    state: () => ({ filieres: [], nombreDeFilieres: 0, allFilieres: [] }),
    getters: {
        getAllFilieres: (state) => state.allFilieres,
        getNombreDeFilieres: (state) => state.nombreDeFilieres,
    },
    actions: {
        async fetchAllFilieres() {
            try {
                const res = await fetch(`${API_BASE_URL}/api/filieres`);
                if (!res.ok) throw new Error('Erreur lors de la récupération des filieres');
                const data = await res.json();
                this.allFilieres = data['hydra:member'];
                this.filieres = data['hydra:member'];
                this.nombreDeFilieres = this.filieres.length;
            } catch (error) {
                console.error('Erreur:', error);
            }
        },
        fetchAllFilieresInParc(id) {
            this.filieres = this.allFilieres.filter(filiere => {
                return filiere.parc === `/api/parcs/${id}`;
            });
            this.nombreDeFilieres = this.filieres.length;
        },
        calculeNombreFiliere(parcId) {
            if (parcId) {
                this.fetchAllFilieresInParc(parcId);
            } else {
                this.nombreDeFilieres = this.allFilieres.length;
            }
        }
    }
});