<template>

    <Head title="Index" />
    <AdminLayout :title="`Datos del usuario ${user.data.name}`">
        <!-- <hr> -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-md-10 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Datos registrados</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <label for="role">Rol:</label>
                                        <p><i class="bi bi-shield-fill-check"></i> {{ user.data.roles }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="name">Nombre:</label>
                                        <p><i class="bi bi-person-badge-fill"></i> {{ user.data.name }}</p>
                                    </div>
                                    <div class="col-6">
                                        <label for="email">Correo electronico: </label>
                                        <p><i class="bi bi-envelope-fill"></i> {{ user.data.email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="name">Fecha y hora de registro</label>
                                        <p class="form-group position-relative has-icon-left">
                                            <i class="bi bi-clock-fill"></i> {{ user.data.created_at }}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class="col-12 d-flex justify-content-end">
                                    <Link :href="route('admin.users.index')" class="btn btn-secondary me-1 mb-1">
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
    user: Object
})

</script>