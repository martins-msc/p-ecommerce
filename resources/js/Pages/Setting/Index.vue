<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    currency: Object
});
</script>
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
                                <form class="form">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <label for="name">Nombre (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="name"
                                                            placeholder="Nombre de la empresa">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-building"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <label for="description">Descripcion (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="description"
                                                            placeholder="Breve descripcion de la actividad o sector">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-tag"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <label for="branch">Sucursal (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="branch"
                                                            placeholder="Ej: Casa Matriz">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-shop"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <label for="address">Direccion (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <textarea class="form-control"
                                                            placeholder="Leave a comment here" id="floatingTextarea"
                                                            rows="1"></textarea>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-geo-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="phone">Telefonos (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="phone"
                                                            placeholder="Ej: 65498745, 98765412">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-telephone"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="email">Email (*)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="email"
                                                            placeholder="Ej: Info@miempresa.com">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-envelope"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="currency">Divisa (*)</label>
                                                    <div class="form-group position-relative has-icon-left">

                                                        <select class="form-select form-control" id="curency" >
                                                            <option value="" disabled selected >-- Selecciona una divisa --</option>
                                                            <option v-for="item in currency" :value="item.symbol">
                                                                {{ item.name }} ({{ item.symbol }})
                                                            </option>
                                                        </select>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-currency-dollar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="website">Pagina web (Opcional)</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="website"
                                                            placeholder="Ej: https://www.miempresa.com">
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
                                                        <input type="file" class="form-control" name="logo">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="image_login">Imagen de Login (*)</label>
                                                    <div class="form-group position-relative">
                                                        <input type="file" class="form-control" name="image_login">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Guardar cambios</button>
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