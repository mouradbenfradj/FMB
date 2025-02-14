<script setup>
import Logo from './Header/Logo.vue';
import Menu from './Header/Menu.vue';
import Search from './Header/Search.vue';
</script>
<template>
    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <Search />
            <Logo />
            <Menu />
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end Topbar -->
</template>

<style scoped></style>