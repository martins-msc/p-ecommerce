<template>

    <Head title="Index" />
    <AdminLayout title="Ajuste de sistema">
        <!-- <hr> -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Configuraciones del sistema</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form @submit.prevent="storeSetting" class="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <label for="name">Nombre (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="name"
                                                            :class="{ 'is-invalid': form.errors.name }"
                                                            placeholder="Nombre de la empresa" v-model="form.name">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-building"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.name" class="text-sm text-danger">{{
                                                        form.errors.name }}</p>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <label for="description">Descripcion (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control"
                                                            :class="{ 'is-invalid': form.errors.description }"
                                                            name="description"
                                                            placeholder="Breve descripcion de la actividad o sector"
                                                            v-model="form.description">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-tag"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.description" class="text-sm text-danger">{{
                                                        form.errors.description }}</p>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <label for="branch">Sucursal (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="branch"
                                                            :class="{ 'is-invalid':form.errors.branch }"
                                                            placeholder="Ej: Casa Matriz" v-model="form.branch">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-shop"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.branch" class="text-sm text-danger">{{
                                                        form.errors.branch }}</p>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <label for="address">Direccion (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <textarea class="form-control"
                                                            :class="{ 'is-invalid':form.errors.address }"
                                                            placeholder="Calle, Numero, Ciudad y Pais"
                                                            id="floatingTextarea" rows="1"
                                                            v-model="form.address"></textarea>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-geo-alt"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.address" class="text-sm text-danger">{{
                                                        form.errors.address }}</p>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="phone">Telefonos (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="phone"
                                                            :class="{ 'is-invalid':form.errors.phone }"
                                                            placeholder="Ej: 65498745, 98765412" v-model="form.phone">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-telephone"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.phone" class="text-sm text-danger">{{
                                                        form.errors.phone }}</p>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="email">Email (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="email"
                                                            :class="{ 'is-invalid':form.errors.email }"
                                                            placeholder="Ej: Info@miempresa.com" v-model="form.email">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-envelope"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.email" class="text-sm text-danger">{{
                                                        form.errors.email }}</p>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="currency">Divisa (*)</label>
                                                    <div class="form-group position-relative has-icon-left">

                                                        <select class="form-select form-control" id="curency"
                                                            :class="{ 'is-invalid':form.errors.currency }"
                                                            v-model="form.currency">
                                                            <option value="" disabled selected>-- Selecciona una divisa
                                                                --</option>
                                                            <option v-for="item in currency" :key="item.symbol"
                                                                :value="item.code">
                                                                {{ item.name }} ({{ item.symbol }})
                                                            </option>
                                                        </select>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-currency-dollar"></i>
                                                        </div>
                                                    </div>
                                                    <p v-if="form.errors.currency" class="text-sm text-danger">{{
                                                        form.errors.currency }}</p>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="website">Pagina web (Opcional)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="website"
                                                            placeholder="Ej: https://www.miempresa.com"
                                                            v-model="form.website">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-globe"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="logo">Logo (*)</label>
                                                    <div class="form-group position-relative">
                                                        <input type="file" class="form-control" name="logo"
                                                            :class="{ 'is-invalid':form.errors.logo }"
                                                            @change="handleFileLogo">
                                                    </div>
                                                    <p v-if="form.errors.logo" class="text-sm text-danger">{{
                                                        form.errors.logo }}</p>
                                                </div>
                                                <div class="avatar avatar-xl me-3" v-show="previewLogo">
                                                    <img :src="previewLogo" alt="" id="previewLogo">
                                                </div>
                                                <div class="col-12">
                                                    <label for="image_login">Imagen de Login (*)</label>
                                                    <div class="form-group position-relative">
                                                        <input type="file" class="form-control" name="image_login"
                                                            :class="{ 'is-invalid':form.errors.image_login }"
                                                            @change="handleFileLogin">
                                                    </div>
                                                    <p v-if="form.errors.image_login" class="text-sm text-danger">{{
                                                        form.errors.image_login }}</p>
                                                </div>
                                                <div class="avatar avatar-xl me-3" v-show="previewImageLogin">
                                                    <img :src="previewImageLogin" alt="" id="previewLogin">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
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
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    currency: Object,
    setting: Object
});

const previewLogo = ref(props.setting?.logo ? `/storage/${props.setting.logo}` : '');
const previewImageLogin = ref(props.setting?.image_login ? `/storage/${props.setting.image_login}` : '');

const form = useForm({
    name: props.setting?.system_name ? props.setting.system_name : '', // the firt ? avoid errors of null or undefined
    description: props.setting?.description ? props.setting.description : '',
    branch: props.setting?.branch_store ? props.setting.branch_store : '',
    address: props.setting?.address ? props.setting.address : '',
    phone: props.setting?.phone_number ? props.setting.phone_number : '',
    email: props.setting?.email ? props.setting.email : '',
    currency: props.setting?.currency ? props.setting.currency : '',
    website: props.setting?.web_site ? props.setting.web_site : '',

    logo: null,
    image_login:  null
});

const storeSetting = () => {
    form.post(route('admin.setting.store'), {
        preserveScroll: true,
        // onSuccess: () => form.reset(),
        onError: () => {
            // if (form.errors.password) {
            //     form.reset('password', 'password_confirmation');
            //     passwordInput.value.focus();
            // }
            // if (form.errors.current_password) {
            //     form.reset('current_password');
            //     currentPasswordInput.value.focus();
            // }
        },
    });
};

// Laravel almacena los archivos en storage/app/public, pero el navegador solo puede acceder a la carpeta public/. 
// Debes crear un "puente" entre ambas. 
// Solución: Ejecuta el comando php artisan storage:link en tu terminal. 

// Gets the image logo
const handleFileLogo = (event) => {
    const files = event.target.files;
    if (files && files.length > 0) {
        // show a preview from image
        form.logo = files[0]; // Takin first file
        previewLogo.value = URL.createObjectURL(files[0]);
    } else {
        form.logo = null;
    }
};
// Gets the image login
const handleFileLogin = (event) => {
    const files = event.target.files;
    if (files && files.length > 0) {
        form.image_login = files[0];
        previewImageLogin.value = URL.createObjectURL(files[0]);
    } else {
        form.image_login = null;
    }
};
</script>