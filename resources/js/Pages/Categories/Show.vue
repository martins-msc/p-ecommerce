<template>

    <Head title="Index" />
    <AdminLayout :title="`Categoria: ${category.data.name}`">
        <!-- <hr> -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-md-5 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Datos registrados</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="name">Nombre</label>
                                        <p><i class="bi bi-tag-fill"></i> {{ category.data.name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="slug">Slug</label>
                                        <p><i class="bi bi-link-45deg"></i> {{ category.data.slug }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="description">Descripcion </label>
                                        <p><i class="bi bi-text-paragraph"></i> {{ category.data.description }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="name">Fecha y hora de registro</label>
                                        <p class="form-group position-relative has-icon-left">
                                            <i class="bi bi-clock-fill"></i> {{ category.data.created_at }}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class="col-12 d-flex justify-content-end">
                                    <Link :href="route('admin.categories.index')" class="btn btn-secondary me-1 mb-1">
                                        Volver</Link>
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
    category: Object
})

</script>