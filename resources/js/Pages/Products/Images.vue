<template>

    <Head title="Index" />
    <AdminLayout :title="`Datos del imagen: ${product.data.name}`">
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
                            <h4 class="card-title">Imagenes del producto
                                <!-- Button trigger for basic modal -->
                                <button type="button" class="btn btn-primary block" data-bs-toggle="modal"
                                    data-bs-target="#default" style="float: right;">
                                    <i class="bi bi-plus-lg"></i> Cargar imagen
                                </button>
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <!--Basic Modal -->
                                <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title white" id="myModalLabel1">Cargar imagenes del
                                                    producto</h5>
                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form @submit.prevent="storeImage" class="form">
                                                <div class="modal-body">
                                                    <input type="file" class="image-preview-filepond">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Cerrar</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary ml-1">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Guardar imagen</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3" v-for="item in product.data.images" :key="item.id">
                                        <div class="carousel slide position-relative" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img :src="`/storage/${item.image}`" class="d-block w-100 rounded"
                                                        alt="...">
                                                </div>
                                            </div>
                                            <button type="button"
                                                class="btn btn-danger rounded-pill btn-sm position-absolute top-0 end-0 m-2 shadow"
                                                @click="deleteImage(item.id)">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
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
import { Head, useForm, Link, router } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { confirmAction } from '@/Composables/SweetAlertDelete';

const pond = ref(null);

const props = defineProps({
    product: Object
})
const form = useForm({
    image: ''
});

onMounted(() => {
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
    );

    pond.value = FilePond.create(document.querySelector('.image-preview-filepond'), {
        allowImagePreview: true,
        allowImageFilter: false,
        allowImageExifOrientation: false,
        allowImageCrop: false,
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
            // Do custom type detection here and return with promise
            resolve(type);
        }),
        onaddfile: (error, fileItem) => {
            if (!error) {
                // fileItem.file es el archivo real (Blob/File) que Laravel necesita
                form.image = fileItem.file;
            }
        },
        onremovefile: (error, fileItem) => {
            form.image = null; // Limpiar si el usuario borra la imagen
        }
    });
})
const storeImage = () => {
    console.log('kljlk');
    form.post(route('admin.products.storeImage', props.product.data.id), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            // Cierra el modal manualmente usando la API de Bootstrap
            const modalElement = document.getElementById('default');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();

            form.reset();
            if (pond.value) {
                pond.value.removeFiles(); // Esto borra las imágenes de la interfaz
            }
        },
        onError: () => {
            // }
        },
    });
};
// const deleteImage = (id) => {
//     if (confirm('¿Estás seguro de eliminar esta imagen?')) {
//         // Inertia envía el DELETE y el token CSRF automáticamente
//         router.delete(route('images.destroy', id), {
//             onSuccess: () => alert('Imagen eliminada'),
//         });
//     }
// };
const deleteImage = (id) => {
    confirmAction(
        "Desea eliminar esta imagen?",
        "Eliminar",
        () => {
            router.delete(route('admin.products.deleteImage', id));
        }
    )
}
</script>