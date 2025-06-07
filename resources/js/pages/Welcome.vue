<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
];
const props = defineProps<{
    name?: string;
}>();
</script>

<template>

    <Head title="Inicio" />

    <AppLayout :breadcrumbs="breadcrumbs">
    </AppLayout>

</template>
<style>
.list-move,
.list-enter-active,
.list-leave-active {
    transition: all 0.8s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
}

.list-leave-active {
    position: absolute;
}

.list-enter-to {
    opacity: 1;
}
</style>