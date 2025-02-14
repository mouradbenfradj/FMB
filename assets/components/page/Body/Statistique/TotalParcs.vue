<script setup>
import { useParcsStore } from '../../../../stores/parcStore';
const store = useParcsStore();
</script>

<template>
    <div class="col-md-3 col-xl-2">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                        <i class="fe-home font-22 avatar-title text-primary"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-left">
                        <h3 class="mt-1">
                            <span data-plugin="counterup"> {{ store.getNombreDeParcs }}</span>
                        </h3>
                    </div>
                </div>
            </div>
            <p class="text-muted mb-1 text-truncate">Total Parcs</p>
            <!-- end row-->
        </div>
        <!-- end widget-rounded-circle-->
    </div>
    <!-- end col-->
</template>