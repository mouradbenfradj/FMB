// parcStore.js
import { defineStore } from "pinia";
import { API_BASE_URL } from "../config/constants";

export const useParcsStore = defineStore('parcs', {
    state: () => ({ parcID: 0, parc: { id: 0, abrevParc: 'Tous les parcs' }, parcs: [], chosenParc: 'Tous les parcs' }),
    getters: {
        getAllParcs: (state) => state.parcs,
        getNombreDeParcs: (state) => {
            if (state.parcID == 0)
                return state.parcs.length - 1;
            else
                return 1;
        }
    },
    actions: {
        async fetchAllParcs() {
            try {
                const res = await fetch(API_BASE_URL + '/api/parcs');
                if (!res.ok) throw new Error('Erreur lors de la récupération des parcs');
                const data = await res.json();
                this.parcs = [this.parc, ...data['hydra:member']];
            } catch (error) {
                console.error('Erreur:', error);
            }
        },
        setParcID(id) {
            this.parcID = id;
        }
    }
});