<script setup lang="ts">
import { useAppearance } from '@/composables/useAppearance';
import { Monitor, Moon, Sun } from 'lucide-vue-next';
// import { useElement, useRank, useType } from "@/composables/useFilters";
import { ref, onMounted, watch } from "vue";

import { useFilterStore } from '@/composables/useFilters';

const isAgentsPage = ref(false);

onMounted(() => {
    isAgentsPage.value = window.location.pathname === "/agents";
});

interface Props {
    class?: string;
}

const { class: containerClass = '' } = defineProps<Props>();

const { appearance, updateAppearance } = useAppearance();

const filterStore = useFilterStore();
const tabs = [
    { value: 'light', Icon: Sun, label: 'Light' },
    { value: 'dark', Icon: Moon, label: 'Dark' },
    { value: 'system', Icon: Monitor, label: 'System' },
] as const;

const elements = [
    { Icon: "/storage/images/elements/Icon_All.webp", label: "All", value: "all" },
    { Icon: "/storage/images/elements/Icon_Electric.webp", label: "Electric", value: "electric" },
    { Icon: "/storage/images/elements/Icon_Ether.webp", label: "Ether", value: "ether" },
    { Icon: "/storage/images/elements/Icon_Fire.webp", label: "Fire", value: "fire" },
    { Icon: "/storage/images/elements/Icon_Frost.webp", label: "Ether", value: "frost" },
    { Icon: "/storage/images/elements/Icon_Ice.webp", label: "Ether", value: "ice" },
    { Icon: "/storage/images/elements/Icon_Physical.webp", label: "Ether", value: "physical" },

] as const;

const ranks = [
    { Icon: "/storage/images/agents/Icon_All.webp", label: "All", value: "all" },
    { Icon: "/storage/images/agents/Icon_AgentRank_S.webp", label: "S", value: "s" },
    { Icon: "/storage/images/agents/Icon_AgentRank_A.webp", label: "A", value: "a" },

] as const;

const types = [
    { Icon: "/storage/images/types/Icon_All.webp", label: "All", value: "all" },
    { Icon: "/storage/images/types/Icon_Anomaly.webp", label: "Anomaly", value: "anomaly" },
    { Icon: "/storage/images/types/Icon_Attack.webp", label: "Attack", value: "attack" },
    { Icon: "/storage/images/types/Icon_Defense.webp", label: "Defense", value: "defense" },
    { Icon: "/storage/images/types/Icon_Stun.webp", label: "Stun", value: "stun" },
    { Icon: "/storage/images/types/Icon_Support.webp", label: "Support", value: "support" },

] as const;

</script>
<template>
    <template v-if="isAgentsPage">
        <div class="flex flex-wrap justify-center">


            <div
                :class="['inline-flex gap-1 rounded-lg bg-neutral-100 p-1 dark:bg-neutral-800 m-2 mt-4', containerClass]">
                <button v-for="{ Icon, label, value } in ranks" :key="value" @click="filterStore.updateRank(value)"
                    :class="[
                        'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                        filterStore.rank === value
                            ? 'bg-white shadow-sm dark:bg-neutral-700 dark:text-neutral-100'
                            : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60',
                    ]" :title="label">
                    <img :src="Icon" :alt="label" class="icon-class w-8 h-8 object-contain" />
                </button>
            </div>
            <div
                :class="['inline-flex gap-1 rounded-lg bg-neutral-100 p-1 dark:bg-neutral-800 m-2 mt-4', containerClass]">

                <button v-for="{ Icon, label, value } in elements" :key="value"
                    @click="filterStore.updateElement(value)" :class="[
                        'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                        filterStore.element === value
                            ? 'bg-white shadow-sm dark:bg-neutral-700 dark:text-neutral-100'
                            : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60',
                    ]" :title="label">
                    <img :src="Icon" :alt="label" class="icon-class w-8 h-8 object-contain" />
                </button>
            </div>
            <div
                :class="['inline-flex gap-1 rounded-lg bg-neutral-100 p-1 dark:bg-neutral-800 m-2 mt-4', containerClass]">
                <button v-for="{ Icon, label, value } in types" :key="value" @click="filterStore.updateType(value)"
                    :class="[
                        'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                        filterStore.type === value
                            ? 'bg-white shadow-sm dark:bg-neutral-700 dark:text-neutral-100'
                            : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60',
                    ]" :title="label">
                    <img :src="Icon" :alt="label" class="icon-class w-8 h-8 object-contain" />
                </button>
            </div>
        </div>
    </template>

    <template v-else>
        <div :class="['inline-flex gap-1 rounded-lg bg-neutral-100 p-1 dark:bg-neutral-800', containerClass]">
            <button v-for="{ value, Icon, label } in tabs" :key="value" @click="updateAppearance(value)" :class="[
                'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                appearance === value
                    ? 'bg-white shadow-sm dark:bg-neutral-700 dark:text-neutral-100'
                    : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60',
            ]">
                <component :is="Icon" class="-ml-1 h-4 w-4" />
                <span class="ml-1.5 text-sm">{{ label }}</span>
            </button>
        </div>
    </template>
</template>
