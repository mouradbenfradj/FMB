<script setup>
import PageTitle from './Body/PageTitle.vue';
import Footer from './Footer.vue';
</script>
<template>
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <PageTitle />
                <router-view />
            </div> <!-- container -->
        </div> <!-- content -->
        <Footer />
    </div>
</template>
<style scoped></style>