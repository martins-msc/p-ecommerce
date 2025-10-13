<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <h1 class="auth-title">Iniciar sesion</h1>
        <p class="auth-subtitle mb-5">Ingresa con tus datos</p>

        <!--template-->
        <form @submit.prevent="submit">
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" placeholder="Correo electronico"
                    v-model="form.email" required autocomplete="username">
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>
                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" placeholder="Nombre de usuario"
                    v-model="form.name" required autofocus autocomplete="name">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" placeholder="Contrasena"
                    v-model="form.password" required autocomplete="new-password">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" placeholder="Confirmar contrasena"
                    v-model="form.password_confirmation" required autocomplete="new-password">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing">Registrar</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p class="text-gray-600">Ya tienes una cuenta? <a :href="route('login')" class="font-bold">Iniciar
                    sesion</a>.</p>
            <p>
                <Link v-if="canResetPassword" :href="route('password.request')" class="font-bold">
                Olvidaste tu contrasena?
                </Link>
            </p>

        </div>
    </GuestLayout>
</template>
