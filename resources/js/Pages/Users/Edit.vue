<template>

    <Head title="Index" />
    <AdminLayout :title="`Modificacion de datos del usuario: ${user.data.name}`">
        <!-- <hr> -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-md-10 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Llene los campos del formulario</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form @submit.prevent="updateUser" class="form">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <label for="role">Roles (*)</label>
                                            <div class="form-group position-relative has-icon-left">

                                                <select class="form-select form-control" id="role"
                                                    :class="{ 'is-invalid': form.errors.role }"
                                                    v-model="form.role">
                                                    <option v-for="item in roles" :key="item.id"
                                                        :value="item.id">
                                                        {{ item.name }}
                                                    </option>
                                                </select>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-shield-fill-check"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.role" class="text-sm text-danger">{{
                                                form.errors.role }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="name">Nombre (*)</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" name="name"
                                                    :class="{ 'is-invalid': form.errors.name }"
                                                    placeholder="Nombre completo" v-model="form.name">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person-badge-fill"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.name" class="text-sm text-danger">{{
                                                form.errors.name }}</p>
                                        </div>
                                        <div class="col-6">
                                            <label for="email">Correo electronico (*)</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" name="email"
                                                    :class="{ 'is-invalid': form.errors.email }"
                                                    placeholder="ejemplo@gmail.com" v-model="form.email">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-envelope-fill"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.email" class="text-sm text-danger">{{
                                                form.errors.email }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="password">Contraseña (*)</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control" name="password"
                                                    :class="{ 'is-invalid': form.errors.password }"
                                                    placeholder="Contraseña" v-model="form.password">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-lock-fill"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.password" class="text-sm text-danger">{{
                                                form.errors.password }}</p>
                                        </div>
                                        <div class="col-6">
                                            <label for="password_confirmation">Confirmar contraseña (*)</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    :class="{ 'is-invalid': form.errors.password_confirmation }"
                                                    placeholder="Confirmar contraseña"
                                                    v-model="form.password_confirmation">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-shield-lock-fill"></i>
                                                </div>
                                            </div>
                                            <p v-if="form.errors.password_confirmation" class="text-sm text-danger">{{
                                                form.errors.password_confirmation }}</p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success me-1 mb-1">Actualizar</button>
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
import { onMounted } from 'vue';

const props = defineProps({
    user: Object,
    roles: Object
})
const form = useForm({
    name: props.user.data.name,
    email: props.user.data.email,
    role: props.user.data.roles[0].id,
    password: '',
    password_confirmation: ''
});

const updateUser = () => {
    form.put(route('admin.users.update', props.user.data.id), {
        preserveScroll: true,
        onError: () => {
            // }
        },
    });
};

</script>