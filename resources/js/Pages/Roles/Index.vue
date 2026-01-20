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
                        <div class="card-body">
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
                                                    <Link :href="route('admin.roles.show', role.id)" type="submit"
                                                        class="btn btn-info rounded-pill me-1">
                                                        <i class="bi bi-eye-fill"></i> Ver
                                                    </Link>
                                                    <Link :href="route('admin.roles.edit', role.id)" type="submit"
                                                        class="btn btn-success rounded-pill me-1">
                                                        <i class="bi bi-pencil-fill"></i> Editar
                                                    </Link>
                                                    <button type="submit" class="btn btn-danger rounded-pill me-1"
                                                        @click="deleteRole(role.id)">
                                                        <i class="bi bi-trash-fill"></i> Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <TablePagination :elements=roles />
                    </div>
                </div>
            </div>
        </section>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TablePagination from '@/Components/TablePagination.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue'

const props = defineProps({
    roles: Object,
});

var startIndexPag = ref((props.roles.current_page - 1) * props.roles.per_page + 1);

const deleteRole = (id) => {
    if (confirm('¿Estás seguro de eliminar este rol?')) {
        router.delete(route('admin.roles.destroy', id), {
            preserveScroll: true, // Evita que la página salte arriba al borrar
            onSuccess: () => {
                // Opcional: mostrar notificación de éxito
                startIndexPag.value = ((props.roles.current_page - 1) * props.roles.per_page + 1)
            }
        });
    }
}
</script>