<template>

    <Head title="Index" />
    <AdminLayout title="Creacion de una nueva categoria">
        <!-- <hr> -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-md-5 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Llene los campos del formulario</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form @submit.prevent="storeCategory" class="form">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="name">Nombre (*)</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" name="name"
                                                    :class="{ 'is-invalid': form.errors.name }"
                                                    placeholder="Nombre de la categoria" v-model="form.name">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-tag-fill"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.name" class="text-sm text-danger">{{
                                                form.errors.name }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="slug">Slug (*)</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" name="slug" readonly
                                                    :class="{ 'is-invalid': form.errors.slug }"
                                                    placeholder="slug-de-la-categoria" v-model="form.slug">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-link-45deg"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.slug" class="text-sm text-danger">{{
                                                form.errors.slug }}</p>
                                            <p class="text-sm">URL amigable (ej: electronica, ropa-deportiva)</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="description">Descripcion </label>
                                            <div class="form-group position-relative has-icon-left">
                                                <textarea class="form-control"
                                                    :class="{ 'is-invalid': form.errors.description }"
                                                    placeholder="Descripcion de la categoria (opcional)"
                                                    id="floatingTextarea" rows="4"
                                                    v-model="form.description"></textarea>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-text-paragraph"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.description" class="text-sm text-danger">{{
                                                form.errors.description }}</p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Registrar</button>
                                        <Link :href="route('admin.users.index')" class="btn btn-secondary me-1 mb-1">
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
import { watch } from 'vue';

const form = useForm({
    name: '',
    slug: '',
    description: '',
});

watch(() => form.name, ((newName) => {
    form.slug = newName
        .toLowerCase()
        .trim()
        // 1. Reemplazar vocales con acentos y la ñ
        .replace(/[áàäâ]/g, 'a')
        .replace(/[éèëê]/g, 'e')
        .replace(/[íìïî]/g, 'i')
        .replace(/[óòöô]/g, 'o')
        .replace(/[úùüû]/g, 'u')
        .replace(/[ñ]/g, 'n')
        // 2. Quitar cualquier cosa que NO sea letra, número o espacio
        .replace(/[^a-z0-9\s-]/g, '')
        // 3. Convertir espacios en guiones
        .replace(/[\s_]+/g, '-')
        // 4. Limpiar guiones duplicados o en los extremos
        .replace(/-+/g, '-')     // Convierte --- en -
        .replace(/^-+|-+$/g, ''); // Quita guiones al inicio o final
}))
const storeCategory = () => {
    form.post(route('admin.categories.store'), {
        preserveScroll: true,
        onError: () => {
            // }
        },
    });
};

</script>