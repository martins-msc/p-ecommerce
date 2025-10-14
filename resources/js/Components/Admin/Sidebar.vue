<script setup>
import logo from '../../../template/assets/images/logo/logo.png';
import { onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

onMounted(() => {
    const sidebarItems = document.querySelectorAll('.sidebar-item.has-sub');
    sidebarItems.forEach(item => {
        const link = item.querySelector('.sidebar-link');
        const submenu = item.querySelector('.submenu');

        // Inicializamos oculto
        submenu.style.display = 'none';

        link.addEventListener('click', (e) => {
            e.preventDefault();
            if (submenu.style.display === 'none') {
                submenu.style.display = 'block';
            } else {
                submenu.style.display = 'none';
            }
        });
    });
});
</script>
<template>
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <Link :href="route('dashboard')"><img :src="logo" alt="Logo" srcset=""></Link>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item active ">
                        <Link :href="route('dashboard')" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </Link>
                    </li>

                    <li class="sidebar-title">Ajustes</li>
                    <li class="sidebar-item  ">
                        <Link :href="route('admin.setting.index')" class='sidebar-link'>
                            <i class="bi bi-gear-fill"></i>
                            <span>Configuracion</span>
                        </Link>
                    </li>

                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-circle"></i>
                            <span>{{ $page.props.auth.user.name }}</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <Link :href="route('profile.edit')">Perfil</Link>
                            </li>
                            <li class="submenu-item ">
                                <a href="component-badge.html">Seguridad</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-title">Raise Support</li>

                    <li class="sidebar-item  ">
                        <Link :href="route('logout')" method="post" class='sidebar-link  bg-transparent border-0'
                            >
                            <i class="bi bi-box-arrow-left"></i>
                            <span>CERRAR SESION</span>
                        </Link>
                    </li>

                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
</template>