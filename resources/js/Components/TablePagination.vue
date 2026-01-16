<script setup>

import { Link } from '@inertiajs/vue3'
const props = defineProps({
    elements: Object,
});

</script>

<template>
    <div class="card-body">
        <nav aria-label="Page navigation example">
            <div class="row">
                <div class="col-5 text-muted mt-3">
                    Mostrando {{ elements.from }} a {{ elements.to }} de {{ elements.total }} registros
                </div>
                <div class="col-7">
                    <ul class="pagination pagination-primary justify-content-end">
                        <li v-for="(link, index) in elements.links" class="page-item" :class="{ 'active': link.active }"
                            :key="index">
                            <a v-if="link.url === null" class="page-link" href="#">
                                <span v-if="link.label.includes('Previous')" aria-hidden="true"><i
                                        class="bi bi-chevron-left"></i></span>
                                <span v-else aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                            </a>
                            <Link v-else class="page-link" :href="link.url">
                                <span v-if="!link.label.includes('&')">{{ link.label }}</span>
                                <span v-if="link.label.includes('Next')" aria-hidden="true"><i
                                        class="bi bi-chevron-right"></i></span>
                                <span v-if="link.label.includes('Previous')"><i class="bi bi-chevron-left"></i></span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>
