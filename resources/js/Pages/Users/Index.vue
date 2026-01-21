<template>

    <Head title="Index" />
    <AdminLayout title="Listado de usuarios">
        <!-- <hr> -->
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Usuarios registrados
                                <Link :href="route('admin.users.create')" class="btn btn-primary rounded-pill"
                                    style="float: right"><i class="bi bi-plus-lg"></i> Crear nuevo</Link>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-lg-6 mb-1">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Buscar..."
                                                aria-label="Recipient's username" aria-describedby="basic-addon2"
                                                v-model="search">
                                            <button type="submit" class="btn btn-primary disabled" style="float: right">
                                                <i class="bi bi-search"></i> Buscar
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <!-- 'col-auto' hace que la columna solo ocupe el ancho del botón -->
                                        <button v-if="search" class="btn btn-success" type="button"
                                            @click="clearSearch">
                                            <i class="bi bi-x-lg"></i> Limpiar
                                        </button>
                                    </div>
                                </div>
                                <!-- table hover -->
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0 table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Nro</th>
                                                <th>Rol del usuario</th>
                                                <th>Nombre del usuario</th>
                                                <th>Email</th>
                                                <th>Estado</th>
                                                <th style="text-align: center;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(user, index) in users.data" :key="user.id">
                                                <td class="text-bold-500" style="text-align: center;">{{ index +
                                                    startIndexPag }}</td>
                                                <td>{{ user.roles[0].name }}</td>
                                                <td>{{ user.name }}</td>
                                                <td>{{ user.email }}</td>
                                                <td>
                                                    <span v-if="user.state" class="badge bg-success">Activo</span>
                                                    <span v-else class="badge bg-danger">Inactivo</span>
                                                </td>
                                                <td class="text-center">
                                                    <div v-if="user.state">
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
                                                    </div>
                                                    <div v-else>
                                                        <button type="submit" class="btn btn-warning rounded-pill me-1"
                                                            @click="restoreUser(user.id)">
                                                            <i class="bi bi-arrow-clockwise"></i> Editar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <TablePagination :elements=users.meta />
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
import { ref, watch, computed } from 'vue'
import debounce from 'lodash/debounce';
import { confirmAction } from '@/Composables/SweetAlertDelete';

const props = defineProps({
    users: Object,
    filters: Object
});

const startIndexPag = computed(() => {
    return startIndex();
});
const search = ref(props.filters.search || '');

watch(search, debounce((value) => {
    router.get(
        route('admin.users.index'),
        { search: value },
        { preserveState: true, replace: true }
    );
    startIndex();
}, 300)); // Esperra 300ms despues de que el usuario deja de escribir

const clearSearch = () => {
    search.value = ''; // Al limpiar esto, el Watcher se activa solo
    startIndex();
};
const startIndex = () => {
    return startIndexPag.value = ((props.users.meta.current_page - 1) * props.users.meta.per_page + 1);
}
const deleteUser = (id) => {
    // usamos el composable
    confirmAction(
        "Desea eliminar este registro",
        "Eliminar",
        () => {
            // Esta es la función 'onConfirm' que pasamos como parámetro
            router.delete(route('admin.users.destroy', id));
            startIndex();
        }
    )
    // if (confirm('¿Estás seguro de eliminar este usuario?')) {
    //     router.delete(route('admin.users.destroy', id), {
    //         preserveScroll: true, // Evita que la página salte arriba al borrar
    //         onSuccess: () => {
    //             // Opcional: mostrar notificación de éxito
    //             
    //         }
    //     });
    // }
}
const restoreUser = (id) => {
    confirmAction(
        'Desea restaurar este registro',
        'Restaurar',
        () => {
            router.post(route('admin.users.restore', id));
            startIndex();
        }
    )
}
</script>