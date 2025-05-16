<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import { computed } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Agent',
        href: '/dashboard',
    },
];
const patternId = computed(() => `pattern-${Math.random().toString(36).substring(2, 9)}`);
</script>

<template>
    <Head title="Create Agent" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative w-full min-h-screen ">
            <svg class="absolute inset-0 w-full h-full stroke-neutral-900/20 dark:stroke-neutral-100/20" fill="none">
                <defs>
                    <pattern :id="patternId" x="0" y="0" width="8" height="8" patternUnits="userSpaceOnUse">
                        <path d="M-1 5L5 -1M3 9L8.5 3.5" stroke-width="0.5"></path>
                    </pattern>
                </defs>
                <rect stroke="none" :fill="`url(#${patternId})`" width="100%" height="100%"></rect>
            </svg>
        </div>
    </AppLayout>
</template>