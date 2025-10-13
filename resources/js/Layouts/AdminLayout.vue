<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue';
import Content from '@/Components/Admin/Content.vue';
</script>
<template>
        <Sidebar/>
        <Content>
            <slot/>
        </Content>
</template>