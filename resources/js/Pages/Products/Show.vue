<template>

    <Head title="Index" />
    <AdminLayout :title="`Datos del producto: ${product.data.name}`">
        <!-- <hr> -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Llene los campos del formulario
                                <div style="float: right;">
                                    <Link :href="route('admin.products.index')" class="btn btn-secondary me-1 mb-1">
                                        Volver</Link>
                                </div>
                            </h4>

                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="category_id">Categoria:</label>
                                        <p><i class="bi bi-tags-fill"></i> {{ product.data.category['name'] }}</p>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label for="name">Nombre del producto</label>
                                        <p><i class="bi bi-box-fill"></i> {{ product.data.name }}</p>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label for="code">Codigo (*)</label>
                                        <p><i class="bi bi-upc-scan"></i> {{ product.data.code }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="short_description">Descripcion corta</label>
                                                <p><i class="bi bi-text-left"></i> {{ product.data.short_description }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="purchase_price">Precio de compra</label>
                                                <p><i class="bi bi-currency-dollar"></i> {{ product.data.purchase_price
                                                    }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="sale_price">Precio de venta</label>
                                                <p><i class="bi bi-currency-dollar"></i> {{ product.data.sale_price }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="stock">Stock</label>
                                                <p><i class="bi bi-boxes"></i> {{ product.data.stock }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="long_description">Descripcion Larga</label>
                                                <div class="ck-content" v-html="product.data.long_description"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Imagenes del producto</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3" v-for="item in product.data.images" :key="item.id">
                                        <div id="carouselExampleSlidesOnly" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img :src="`/storage/${item.image}`" class="d-block w-100"
                                                        alt="...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    product: Object
})

</script>