<template>

    <Head title="Index" />
    <AdminLayout title="Listado de productos">
        <!-- <hr> -->
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Productos registrados
                                <Link :href="route('admin.products.create')" class="btn btn-primary rounded-pill"
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
                                    <table class="table table-hover mb-0 table-striped ">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Nro</th>
                                                <th>Categoria</th>
                                                <th>Nombre</th>
                                                <th>Codigo</th>
                                                <th>Descripcion corta</th>
                                                <th>Precio de compra</th>
                                                <th>Precio de venta</th>
                                                <th>Stock</th>
                                                <th style="text-align: center;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(product, index) in products.data" :key="product.id">
                                                <td class="text-bold-500" style="text-align: center;">{{ index +
                                                    startIndexPag }}</td>
                                                <td>{{ product.category['name'] }}</td>
                                                <td>{{ product.name }}</td>
                                                <td>{{ product.code }}</td>
                                                <td>{{ product.short_description }}</td>
                                                <td>{{ product.purchase_price }}</td>
                                                <td>{{ product.sale_price }}</td>
                                                <td>{{ product.stock }}</td>
                                                <td class="text-center text-nowrap">
                                                    <Link :href="route('admin.products.show', product.id)"
                                                        class="btn btn-info rounded-pill btn-sm me-1">
                                                        <i class="bi bi-eye-fill"></i> Ver
                                                    </Link>
                                                    <Link :href="route('admin.products.edit', product.id)"
                                                        class="btn btn-success rounded-pill btn-sm me-1">
                                                        <i class="bi bi-pencil-fill"></i> Editar
                                                    </Link>
                                                    <button type="button" class="btn btn-danger rounded-pill btn-sm"
                                                        @click="deleteproduct(product.id)">
                                                        <i class="bi bi-trash-fill"></i> Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <TablePagination :elements=products.meta />
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
    products: Object,
    filters: Object
});

const startIndexPag = computed(() => {
    const meta = props.products.meta;
    return ((meta.current_page - 1) * meta.per_page + 1);
});
const search = ref(props.filters.search || '');

watch(search, debounce((value) => {
    router.get(
        route('admin.products.index'),
        { search: value },
        { preserveState: true, replace: true }
    );
}, 300));

const clearSearch = () => {
    search.value = '';
};
const deleteproduct = (id) => {
    // usamos el composable
    confirmAction(
        "Desea eliminar este registro",
        "Eliminar",
        () => {
            router.delete(route('admin.products.destroy', id));
        }
    )
}
</script>