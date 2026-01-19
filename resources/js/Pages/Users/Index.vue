<template>

    <Head title="Index" />
    <AdminLayout title="Listado de usuarios">
        <!-- <hr> -->
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Usuarios registrados
                                <Link :href="route('admin.users.create')" class="btn btn-primary rounded-pill"
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
                                            <th>Rol del usuario</th>
                                            <th>Nombre del usuario</th>
                                            <th>Email</th>
                                            <th style="text-align: center;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(user, index) in users.data" :key="user.id">
                                            <td class="text-bold-500" style="text-align: center;">{{ index +
                                                startIndexPag }}</td>
                                            <td>{{ user.name }}</td>
                                            <td>{{ user.name }}</td>
                                            <td>{{ user.email }}</td>
                                            <td class="text-center">
                                                <Link :href="route('admin.users.show', user.id)" type="submit"
                                                    class="btn btn-info rounded-pill me-1">
                                                    <i class="bi bi-eye-fill"></i> Ver
                                                </Link>
                                                <Link :href="route('admin.users.edit', user.id)" type="submit"
                                                    class="btn btn-success rounded-pill me-1">
                                                    <i class="bi bi-pencil-fill"></i> Editar
                                                </Link>
                                                <button type="submit" class="btn btn-danger rounded-pill me-1"
                                                    @click="deleteUser(user.id)">
                                                    <i class="bi bi-trash-fill"></i> Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <TablePagination :elements=users />
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
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue'

const props = defineProps({
    users: Object,
});

var startIndexPag = ref((props.users.current_page - 1) * props.users.per_page + 1);

const deleteUser = (id) => {
    if (confirm('¿Estás seguro de eliminar este rol?')) {
        router.delete(route('admin.users.destroy', id), {
            preserveScroll: true, // Evita que la página salte arriba al borrar
            onSuccess: () => {
                // Opcional: mostrar notificación de éxito
                startIndexPag.value = ((props.users.current_page - 1) * props.users.per_page + 1)
            }
        });
    }
}
</script>