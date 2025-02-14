<script setup>
import ParcList from './ParcList.vue';
import MegaMenu from './MegaMenu.vue';
</script>
<template>
    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li>
            <!-- Mobile menu toggle (Horizontal Layout)-->
            <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
            <!-- End mobile menu toggle-->
        </li>
        <ParcList />
        <MegaMenu />
    </ul>
</template>

<style scoped></style>