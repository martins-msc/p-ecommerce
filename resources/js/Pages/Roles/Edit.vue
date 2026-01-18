<template>

    <Head title="Index" />
    <AdminLayout :title="`Modificar rol: ${role.name}`">
        <!-- <hr> -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Llene los campos del formulario</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form @submit.prevent="updateRole" class="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="name">Nombre del rol (*)</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" name="name"
                                                    :class="{ 'is-invalid': form.errors.name }"
                                                    placeholder="Nombre de la empresa" v-model="form.name">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person-badge-fill"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.name" class="text-sm text-danger">{{
                                                form.errors.name }}</p>
                                        </div>
                                    </div>
                                    <br>    
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success me-1 mb-1">Actualizar</button>
                                        <Link :href="route('admin.roles.index')" class="btn btn-secondary me-1 mb-1">Cancelar</Link>
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

const props = defineProps({
    'role': Object
});
const form = useForm({
    name: props.role.name
});

const updateRole = () => {
    form.put(route('admin.roles.update', props.role.id), {
        preserveScroll: true,
        onError: () => {
            // }
        },
    });
};

</script>