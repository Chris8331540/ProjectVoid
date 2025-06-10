<script setup lang="ts">
import TextWrapper from '@/components/TextWrapper.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'About',
        href: '/about',
    },
];
</script>

<template>

    <Head title="About" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <TextWrapper>
            <div class="flex flex-col relative z-10 w-full">
                <div class="w-full">Hecho por: Christopher Obryan Mendoza Chevez</div>
                <div class="w-full">IES Trassierra</div>
            </div>
        </TextWrapper>
    </AppLayout>
</template>