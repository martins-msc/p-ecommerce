<template>
  <Sidebar />
  <Content :title="title">
    <slot />
  </Content>
</template>
<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue';
import Content from '@/Components/Admin/Content.vue';
import { watch, computed } from 'vue';
import { usePage } from '@inertiajs/vue3'; // para que sea accesible desde todas las unidades
import Swal from 'sweetalert2';

defineProps({
  title: String
});

const page = usePage();

// Creamos una propiedad computada para observar los mensajes flash
const flashMessage = computed(() => page.props.flash?.message);
const flashIcon = computed(() => page.props.flash?.icon);

// Observamos cuando cambia el valor de flashmessage
watch(flashMessage, (message) => {
  if (message) {
    Swal.fire({
      position: "top-end",
      icon: `${flashIcon.value}`,
      title: flashMessage.value,
      showConfirmButton: false,
      timer: 1500,
      timerProgressBar: true,
    }).then(() => {
            page.props.flash.message = null;
        });;
  }
}, { immediate: true });
</script>
