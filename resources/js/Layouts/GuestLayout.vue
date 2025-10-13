<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import logo from '../../template/assets/images/logo/logo.png';

import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img :src="logo" alt="Logo"></a>
                    </div>
                    <slot />

                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</template>
