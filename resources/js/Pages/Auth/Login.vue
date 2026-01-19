<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    setting: {
        type: Object
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout :logo="setting?.logo" :imageLogin="setting?.image_login">

        <Head :title="`Log in - ${setting?.system_name}`" />

        <div>
            <h1 class="auth-title">{{ setting?.system_name }}</h1>
            <p class="auth-subtitle mb-5">Ingresa al sistema</p>

            <form @submit.prevent="submit">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Nombre de usuario"
                        v-model="form.email" required autofocus autocomplete="Nombre de usuario">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Contrasena"
                        v-model="form.password" required autocomplete="current-password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Acceso</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">No tienes una cuenta? <a :href="route('register')"
                        class="font-bold">Registrate</a>.</p>
                <p>
                    <Link v-if="canResetPassword" :href="route('password.request')" class="font-bold">
                    Olvidaste tu contrasena?
                    </Link>
                </p>

            </div>
        </div>
    </GuestLayout>
</template>
