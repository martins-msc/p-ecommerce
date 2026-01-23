<template>

    <Head title="Index" />
    <AdminLayout title="Creacion de un nuevo producto">
        <!-- <hr> -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Llene los campos del formulario</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form @submit.prevent="storeProduct" class="form">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <label for="category_id">Categorias (*)</label>
                                            <div class="form-group position-relative has-icon-left">

                                                <select class="form-select form-control" id="category_id"
                                                    :class="{ 'is-invalid': form.errors.category_id }"
                                                    v-model="form.category_id">
                                                    <option value="" disabled selected>-- Selecciona una categoria --
                                                    </option>
                                                    <option v-for="item in categories" :key="item.id" :value="item.id">
                                                        {{ item.name }}
                                                    </option>
                                                </select>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-tags-fill"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.category_id" class="text-sm text-danger">{{
                                                form.errors.category_id }}</p>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="name">Nombre del producto (*)</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" name="name"
                                                    :class="{ 'is-invalid': form.errors.name }"
                                                    placeholder="Nombre del producto" v-model="form.name">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-box-fill"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.name" class="text-sm text-danger">{{
                                                form.errors.name }}</p>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="code">Codigo (*)</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" name="code"
                                                    :class="{ 'is-invalid': form.errors.code }" maxlength="255"
                                                    placeholder="Codigo unico del producto" v-model="form.code">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-upc-scan"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.code" class="text-sm text-danger">{{
                                                form.errors.code }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="short_description">Descripcion corta (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="short_description"
                                                            :class="{ 'is-invalid': form.errors.short_description }"
                                                            placeholder="Descripcion corta del producto (max: 255 caracteres)"
                                                            v-model="form.short_description">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-text-left"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.short_description" class="text-sm text-danger">
                                                        {{
                                                            form.errors.short_description }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="purchase_price">Precio de compra (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="number" class="form-control" name="purchase_price"
                                                            :class="{ 'is-invalid': form.errors.purchase_price }"
                                                            placeholder="0.00" v-model="form.purchase_price" step="0.01"
                                                            min="0">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-currency-dollar"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.purchase_price" class="text-sm text-danger">{{
                                                        form.errors.purchase_price }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="sale_price">Precio de venta (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="number" class="form-control" name="sale_price"
                                                            :class="{ 'is-invalid': form.errors.sale_price }"
                                                            placeholder="0.00" v-model="form.sale_price" step="0.01"
                                                            min="0">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-currency-dollar"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.sale_price" class="text-sm text-danger">{{
                                                        form.errors.sale_price }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="stock">Stock (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="number" class="form-control" name="stock"
                                                            :class="{ 'is-invalid': form.errors.stock }" placeholder="0"
                                                            v-model="form.stock" step="0.01" min="0">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-boxes"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.stock" class="text-sm text-danger">
                                                        {{ form.errors.stock }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="long_description">Descripcion Larga (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <div id="editor" ref="editorRef">
                                                            <p>This is some sample content.</p>
                                                        </div>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-text-paragraph"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.long_description" class="text-sm text-danger">
                                                        {{
                                                            form.errors.long_description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Registrar</button>
                                        <Link :href="route('admin.products.index')" class="btn btn-secondary me-1 mb-1">
                                            Cancelar</Link>
                                    </div>
                                </form>
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
    categories: Object
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