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
        </section>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const editorRef = ref(null);
const instanciaEditor = ref(null); // Aquí guardaremos el editor una vez creado

const props = defineProps({
    product: Object
})
const form = useForm({
    category_id: '',
    name: '',
    code: '',
    short_description: '',
    long_description: '',
    purchase_price: '',
    sale_price: '',
    stock: ''
});

onMounted(() => {
    // Usamos el objeto global que ya está disponible gracias a que lo importaste en app.js
    if (window.ClassicEditor) {
        window.ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                instanciaEditor.value = editor;
                // OPCIÓN A: Sincronizar en tiempo real
                editor.model.document.on('change:data', () => {
                    form.long_description = editor.getData(); // Captura el HTML (<p>...</p>)
                });
            })
            .catch(error => console.error(error));
    }
})
const storeProduct = () => {
    form.post(route('admin.products.store'), {
        preserveScroll: true,
        onError: () => {
            // }
        },
    });
};

</script>