<script setup>
import { onMounted } from 'vue';

defineProps({
    title: String
});

onMounted(() => {
    const burgerBtn = document.querySelector('.burger-btn');
    const sidebarHideBtn = document.querySelector('.sidebar-hide');
    const sidebar = document.getElementById('sidebar');

    // Verifica que existan los elementos
    if (burgerBtn && sidebar) {
        burgerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    if (sidebarHideBtn && sidebar) {
        sidebarHideBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }
});
</script>
<template>
    <div id="main" >
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>{{ title }}</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">Rol del usuario</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $page.props.auth.user.roles[0] }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Main Content admin user -->
        <slot />

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                            href="http://ahmadsaugi.com">A. Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>
</template>