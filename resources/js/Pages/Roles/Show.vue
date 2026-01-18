<template>

    <Head title="Index" />
    <AdminLayout :title="`Datos del rol: ${rol.name}`">
        <!-- <hr> -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Datos registrados</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="name">Nombre del rol</label>
                                        <p class="form-group position-relative has-icon-left">
                                            <i class="bi bi-person-badge-fill"></i> {{ rol.name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="name">Fecha y hora de registro</label>
                                        <p class="form-group position-relative has-icon-left">
                                            <i class="bi bi-clock-fill"></i> {{ rol.created_at }}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class="col-12 d-flex justify-content-end">
                                    <Link :href="route('admin.roles.index')" class="btn btn-secondary me-1 mb-1">
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
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    rol: Object
});

const form = useForm({
    name: props.setting?.system_name ? props.setting.system_name : ''
});

const storeRole = () => {
    form.post(route('admin.roles.store'), {
        preserveScroll: true,
        onError: () => {
            // }
        },
    });
};

</script>