<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import TextWrapper from '@/components/TextWrapper.vue';
import { Link } from '@inertiajs/vue3';
import InfiniteScroll from '@/components/InfiniteScroll.vue';
const props = defineProps<{
    name?: string;
}>();
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tier List',
        href: '/dashboard',
    },
];
</script>

<template>

    <Head title="Tier List" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <!--Solo mostrar el botón si está logueado-->
        <div class="flex ml-6 mt-4">
            <Link :href="'/tierlists/create'" class="p-2 bg-neutral-900 rounded button">
            Create tierlist
            </Link>
        </div>
        <InfiniteScroll class="mt-4 mb-2"></InfiniteScroll>
    </AppLayout>

</template>
<style scoped>
.button:hover {
    text-transform: uppercase;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-style: italic;
    font-size: 1rem;
    font-weight: 800;
    color: black;
    background: linear-gradient(to left,
            #A6C100 0%,
            #DBD100 25%,
            #A6C100 50%,
            #DBD100 75%,
            #A6C100 100%);
    background-size: 400% auto;
    /* animation: textShine 2.5s linear infinite; */
    /* Transiciones específicas para los cambios de posicionamiento */
    animation: textShine 1.4s ease-in-out infinite;
}
@keyframes textShine {
    0% {
        background-position: 135% 50%;
    }

    100% {
        background-position: 0% 50%;
    }
}
</style>