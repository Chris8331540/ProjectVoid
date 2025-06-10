<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
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
const form = useForm({});
const page = usePage<any>();
const isAuth = page.props.auth.user != null;
const isAdmin = isAuth ? page.props.auth.user.role == "admin" : false;
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
function confirmDelete(agentId: number) {
    if (confirm('Are you sure about delete this agent?')) {
        form.delete(`/agents/delete/${agentId}`, {
            preserveScroll: true,
            onSuccess: () => {
                console.log('Agent deleted successfully');
            },
            onError: () => {
                alert('Error deleting agent');
            },
        });
    }
}

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
                        class="relative group aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        <PlaceholderPattern :imgSrc="agent.image" :name="agent.name" :elementIcon="agent.element.image"
                            :typeIcon="agent.type.image" :agentId="agent.id" />

                        <button v-if="isAdmin" @click="confirmDelete(agent.id)"
                            class="bg-button depth-effect right-2 top-2 z-10 hidden h-10 w-10 items-center justify-center group-hover:flex"
                            title="Delete agent">
                            ✖
                        </button>
                    </div>
                </TransitionGroup>
            </div>
        </div>
    </AppLayout>

</template>
<style scoped>
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

.bg-button {
    position: absolute;
    z-index: 10;
    border-color: #CE0A10;
    border: 0.25rem solid;
    color: #CE0A10;
    font-weight: bolder;
    text-transform: uppercase;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.bg-button:hover {
    border-color: black;
    color: black;
    background-color: #CE0A10;
    transition: all 0.05s ease-in-out;

}

.depth-effect {
    box-shadow: inset 0 0 10px 12px #000000, 0 0 10px 2px rgba(255, 255, 255, 0.1), 0.125em 0.125em 0.25em rgba(0, 0, 0, 0.125), 0 0.0625em 0.375em rgba(0, 0, 0, 0.1875);
    border-radius: 2rem;
}

.depth-effect:hover {
    box-shadow: none;
}

.depth-effect::before,
.depth-effect::after {
    z-index: 1;
    border-radius: inherit;
    display: flex;
    justify-content: center;
    align-items: center;
}

.bg-button:hover {
    text-transform: uppercase;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: black;
    background: linear-gradient(to left,
            #CE0A10 0%,
            #ed060e 25%,
            #CE0A10 50%,
            #ed060e 75%,
            #CE0A10 100%);
    background-size: 400% auto;
    transition: transform 0.5s ease-in-out, border-radius 1s ease;
    animation: breath 1.4s ease-in-out infinite, textShine 1.4s linear infinite;
}

@keyframes breath {
    0% {
        transform: scale(1);
        /* tamaño normal */
    }

    50% {
        transform: scale(1.04);
        /* tamaño expandido */
    }

    100% {
        transform: scale(1);
        /* vuelve al tamaño original */
    }
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