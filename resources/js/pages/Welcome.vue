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
        <div class="w-full flex flex-col p-4 h-full justify-center">
            <div class="w-full flex justify-center">
                <img class="rounded max-h-96" src="/storage/images/app/zenless-zone-zero-characters-portrailt-photo.jpg"/>
            </div>
            <div class="w-full flex justify-center">
                <p class="title text-xl">Welcome to Project Void, a fan project</p>
            </div>
            <div>

            </div>
        </div>
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