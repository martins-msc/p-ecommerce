<script setup>
// import AdminLayout from '@/Layouts/AdminLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    totalRoles: Number,
    totalUsers: Number,
    totalCategories: Number,
    totalProducts: Number,
})
</script>

<template>

    <Head title="Dashboard" />

    <AdminLayout :title="`Bienvenido: ${$page.props.auth.user.name}`">
        <div class="page-content">
            <section class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-4">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <Link :href="route('admin.roles.index')">
                                                <div class="stats-icon purple">
                                                    <i class="" style="margin-top: auto;">
                                                        <i class="bi bi-shield-fill-check"></i>
                                                    </i>
                                                </div>
                                            </Link>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Roles registrados</h6>
                                            <h6 class="font-extrabold mb-0">{{ totalRoles }} roles</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <Link :href="route('admin.users.index')">
                                                <div class="stats-icon blue">
                                                    <i class="" style="margin-top: auto;">
                                                        <i class="bi bi-person-plus-fill"></i>
                                                    </i>
                                                </div>
                                            </Link>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Usuarios registrados</h6>
                                            <h6 class="font-extrabold mb-0">{{ totalUsers }} usuarios</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <Link :href="route('admin.categories.index')">
                                                <div class="stats-icon green">
                                                    <i class="" style="margin-top: auto;">
                                                        <i class="bi bi-tags-fill"></i>
                                                    </i>
                                                </div>
                                            </Link>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Categorias registrados</h6>
                                            <h6 class="font-extrabold mb-0">{{ totalCategories }} registrados</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <Link :href="route('admin.products.index')">
                                                <div class="stats-icon red">
                                                    <i class="" style="margin-top: auto;">
                                                        <i class="bi bi-box-seam-fill"></i>
                                                    </i>
                                                </div>
                                            </Link>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Productos registrados</h6>
                                            <h6 class="font-extrabold mb-0">{{ totalProducts }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Profile Visit</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart-profile-visit"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </AdminLayout>
</template>
