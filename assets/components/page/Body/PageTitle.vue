<script setup>
import { computed } from 'vue'; // Importez computed
import { useParcsStore } from '../../../stores/parcStore';
import { useBreadcrumbStore } from '../../../stores/breadcrumbStore';

const store = useParcsStore();
const breadcrumbStore = useBreadcrumbStore();

// Utilisez computed pour rendre breadcrumb réactif
const breadcrumb = computed(() => breadcrumbStore.breadcrumb);
</script>
<template>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ASC</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ breadcrumb }}</a></li>
                        <li class="breadcrumb-item active">{{ store.chosenParc }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ store.chosenParc }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
</template>


<style scoped></style>