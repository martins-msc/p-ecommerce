<script setup>
import { onMounted } from 'vue';
import defaultLogo from '../../template/assets/images/logo/logo.png';

const props = defineProps({
    logo: String,
    imageLogin: String,
});
</script>

<template>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div> <!--class="auth-logo"  tenia esta clase-->
                        <a href="index.html"><img :src="logo ? `/storage/${logo}` : defaultLogo" alt="Logo"
                                style="width: 100px;"></a>
                    </div>
                    <slot />

                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <!-- para la imagen  -->
                    <div :style="{
                        backgroundImage: imageLogin ? `url('/storage/${imageLogin}')` : null,
                        backgroundSize: 'cover',
                        backgroundPosition: 'center',
                        backgroundRepeat: 'no-repeat',
                        height: '100%',
                        width: '100%'
                    }"></div>
                </div>
            </div>
        </div>

    </div>
</template>
