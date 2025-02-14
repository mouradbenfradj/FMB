<script setup>
import { onMounted } from 'vue';
import { useParcsStore } from '../../../stores/parcStore';
import filiereStore from '../../../stores/filiereStore';
const store = useParcsStore();
const fStore = filiereStore();
onMounted(async () => {
    try {
        await store.fetchAllParcs();
    } catch (error) {
        console.error('Erreur lors du chargement des parcs:', error);
    }
});
const chooseParc = (id) => {
    const selectedParc = store.parcs.find((parc) => parc.id === id);
    store.setParcID(selectedParc.id);
    store.chosenParc = selectedParc.abrevParc;
    fStore.fetchAllFilieresInParc(id);
};
</script>
<template>
    <li class="dropdown d-none d-xl-block">
        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            {{ store.chosenParc }}
            <i class="mdi mdi-chevron-down"></i>
        </a>
        <div class="dropdown-menu">
            <a v-for="parc in store.getAllParcs" :key="parc.id" href="javascript:void(0);" class="dropdown-item"
                @click="chooseParc(parc.id)">
                <i class="fe-briefcase mr-1"></i>
                <span>{{ parc.abrevParc }}</span>
            </a>
            <!-- <a href="javascript:void(0);" class="dropdown-item">
                <i class="fe-user mr-1"></i>
                <span>Create Users</span>
            </a>

            <a href="javascript:void(0);" class="dropdown-item">
                <i class="fe-bar-chart-line- mr-1"></i>
                <span>Revenue Report</span>
            </a>

            <a href="javascript:void(0);" class="dropdown-item">
                <i class="fe-settings mr-1"></i>
                <span>Settings</span>
            </a>

            <div class="dropdown-divider"></div>
            <a href="javascript:void(0);" class="dropdown-item">
                <i class="fe-headphones mr-1"></i>
                <span>Help & Support</span>
            </a> -->
        </div>
    </li>
</template>

<style scoped></style>