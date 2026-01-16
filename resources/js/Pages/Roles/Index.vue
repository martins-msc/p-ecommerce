<template>

    <Head title="Index" />
    <AdminLayout title="Listado de roles">
        <!-- <hr> -->
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Roles registrados
                                <Link :href="route('admin.roles.create')" class="btn btn-primary rounded-pill"
                                    style="float: right"><i class="bi bi-plus-lg"></i> Crear nuevo</Link>
                            </h4>
                        </div>
                        <div class="card-content">
                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Nro</th>
                                            <th>NOMBRE DEL ROL</th>
                                            <th style="text-align: center;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(role, index) in roles.data" :key="role.id">
                                            <td class="text-bold-500" style="text-align: center;">{{ index +
                                                startIndexPag }}</td>
                                            <td>{{ role.name }}</td>
                                            <td class="text-center">
                                                <button type="submit" class="btn btn-info rounded-pill me-1">
                                                    <i class="bi bi-eye-fill"></i> Ver</button>
                                                <button type="submit" class="btn btn-success rounded-pill me-1">
                                                    <i class="bi bi-pencil-fill"></i> Editar</button>
                                                <Link :href="route('admin.roles.index')"
                                                    class="btn btn-danger rounded-pill me-1">
                                                    <i class="bi bi-trash-fill"></i> Eliminar
                                                </Link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <TablePagination :elements=roles />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TablePagination from '@/Components/TablePagination.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue'

const props = defineProps({
    roles: Object,
});

const startIndexPag = ref((props.roles.current_page - 1) * props.roles.per_page + 1);
</script>