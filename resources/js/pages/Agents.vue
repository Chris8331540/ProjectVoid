<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { computed } from "vue";
import AppearanceTabs from '@/components/AppearanceTabs.vue';

import { useFilterStore } from '@/composables/useFilters';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Agents',
        href: '/agents',
    },
];

const props = defineProps<{
    name?: string;
    agents: Array<any>;
}>();



const filterStore = useFilterStore();
//Propiedad computada para filtrar los agentes reactivamente
const agentsFiltered = computed(() => {
    return props.agents.filter(agent => {
        const matchesRank = filterStore.rank === 'all' || agent.rank === filterStore.rank;
        const matchesElement = filterStore.element === 'all' || agent.element.name === filterStore.element;
        const matchesType = filterStore.type === 'all' || agent.type.name === filterStore.type;

        return matchesRank && matchesElement && matchesType;
    });
});

// Divide los agentes filtrados en filas de 4
const groupedAgents = computed(() => {
    const chunkSize = 4; // 4 agentes por fila
    const rows = [];
    for (let i = 0; i < agentsFiltered.value.length; i += chunkSize) {
        rows.push(agentsFiltered.value.slice(i, i + chunkSize));
    }
    return rows;
});


</script>

<template>

    <Head title="Agents" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <AppearanceTabs></AppearanceTabs>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div v-for="(row, rowIndex) in groupedAgents" :key="rowIndex"
                class="grid auto-rows-min gap-4 md:grid-cols-4 transition-all">
                <TransitionGroup name="list">
                    <div v-for="agent in row" :key="agent.id"
                        class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        <PlaceholderPattern :imgSrc="agent.image" :name="agent.name" :elementIcon="agent.element.image"
                            :typeIcon="agent.type.image" :agentId="agent.id"/>
                    </div>
                </TransitionGroup>

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