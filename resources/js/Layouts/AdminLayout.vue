<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue';
import Content from '@/Components/Admin/Content.vue';

defineProps({
  title: String
});

</script>
<template>
        <Sidebar/>
        <Content :title="title">
            <slot/>
        </Content>
</template>