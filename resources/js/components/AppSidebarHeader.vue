<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';

import BreadcrumbsAgents from '@/components/BreadcrumbsAgents.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItemType } from '@/types';
import { ref, onMounted } from "vue";

const isAgentsPage = ref(false);

onMounted(() => {
    isAgentsPage.value = window.location.pathname === "/agents";
});

defineProps<{
    breadcrumbs?: BreadcrumbItemType[];
}>();

//Averiguar porque uso BreadcrumbsAgents dependiendo si esta en /agents
</script>

<template>
    <header
        class="flex h-16 shrink-0 items-center gap-2 border-b border-sidebar-border/70 px-6 transition-[width,height] ease-linear group-has-[[data-collapsible=icon]]/sidebar-wrapper:h-12 md:px-4">
        <div class="flex items-center gap-2 title">
            <SidebarTrigger class="-ml-1" />
            <!-- <template v-if="isAgentsPage">
                <BreadcrumbsAgents :breadcrumbs="breadcrumbs"></BreadcrumbsAgents>
            </template>
<template v-else> -->
            <template v-if="breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
            <!-- </template> -->

        </div>
    </header>
</template>
