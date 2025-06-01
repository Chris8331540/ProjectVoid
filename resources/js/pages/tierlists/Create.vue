<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import ImageHolderTierList from '@/components/ImageHolderTierList.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import draggable from "vuedraggable";
import TextWrapper from '@/components/TextWrapper.vue';
import { ref } from 'vue';
import { watch } from 'vue';

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';
const titleTierlist = ref("");
const descriptionTierlist = ref("");
const serializedTierList = ref("");
type TierCategory = 's' | 'a' | 'b' | 'c' | 'd' | 'e'
const categoriesName: TierCategory[] = ['s', 'a', 'b', 'c', 'd', 'e']
const tierlistOrdered = ref<Record<TierCategory, any[]>>({
    s: [],
    a: [],
    b: [],
    c: [],
    d: [],
    e: [],
});
watch(
    tierlistOrdered,
    (newVal) => {
        serializedTierList.value = JSON.stringify(newVal);
    },
    { deep: true }
);

const props = defineProps<{
    name?: string;
    agents: any
}>();
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tier List',
        href: '/dashboard',
    },
];

// const originalAgents = ref([...props.agents]);
const unassignedAgents = ref([...props.agents]);

</script>

<template>

    <Head title="Tier List" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <form action="/tierlists/create" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrfToken" />
            <TextWrapper width-class="w-full flex flex-row">
                <div class="relative z-10 flex gap-4 justify-content-center align-content-center align-items-center">
                    <div class="title relative z-10 min-w-fit pr-1">Tierlist title</div>
                    <input class="bg-black relative z-10 w-full rounded pl-2 pr-2" v-model="titleTierlist" name="titleTierlist">
                </div>
            </TextWrapper>
            <TextWrapper width-class="w-full flex flex-row">
                <div class="relative z-10 flex gap-4 justify-content-center align-content-center align-items-center">
                    <div class="title relative z-10 min-w-fit pr-1">Tierlist description</div>
                    <input class="bg-black relative z-10 w-full rounded pl-2 pr-2" v-model="descriptionTierlist" name="descriptionTierlist">
                </div>
            </TextWrapper>
            <TextWrapper>
                <div class="flex flex-col space-y-2 relative z-10">
                    <div v-for="category in categoriesName" :key="category"
                        class="flex items-center border-2 rounded p-1">
                        <!-- Primera columna: nombre de la categoría -->
                        <div
                            class="w-24 min-h-28 font-bold uppercase text-center text-white depth-effect rounded category title">
                            {{ category }}
                        </div>
                        <draggable :list="tierlistOrdered[category]" :group="'tierlist'" item-key="id" :scroll="true"
                            :scrollSensitivity="100" :scrollSpeed="20" :forceFallback="true"
                            class="flex flex-row w-full min-h-28 depth-effect rounded px-2 gap-2 flex-wrap p-2">
                            <template #item="{ element }">
                                <div class="relative aspect-square overflow-hidden rounded border h-24 w-24">
                                    <ImageHolderTierList :imgSrc="element.image" :name="element.name"
                                        :elementIcon="element.element.image" :typeIcon="element.type.image"
                                        :agentId="element.id" />
                                </div>
                            </template>
                        </draggable>
                    </div>
                </div>
            </TextWrapper>
            <TextWrapper class="flex flex-row">
                <draggable v-model="unassignedAgents" :group="'tierlist'" item-key="id" :scroll="true"
                    :scrollSensitivity="100" :scrollSpeed="20" :forceFallback="true"
                    class="flex flex-row w-full min-h-28 depth-effect rounded px-2 gap-2 flex-wrap p-2 relative z-10">
                    <template #item="{ element }">
                        <div class="relative aspect-square overflow-hidden rounded border h-24 w-24">
                            <ImageHolderTierList :imgSrc="element.image" :name="element.name"
                                :elementIcon="element.element.image" :typeIcon="element.type.image"
                                :agentId="element.id" />
                        </div>
                    </template>
                </draggable>
            </TextWrapper>
            <input type="hidden" name="tierlistData" :value="serializedTierList" />
            <div class="flex ml-6 mt-4">
                <input type="submit" value="Create Tierlist"
                    class="p-2 bg-neutral-900 rounded button mb-8 cursor-pointer">
            </div>
        </form>
    </AppLayout>

</template>
<style scoped>
/*Efecto de profundidad para las stats */
.depth-effect {
    box-shadow: inset 0 0 10px 6px #000000, 0 0 10px 2px rgba(255, 255, 255, 0.1), 0.125em 0.125em 0.25em rgba(0, 0, 0, 0.125), 0 0.0625em 0.375em rgba(0, 0, 0, 0.1875);
    background-color: transparent;
    /*#0a0a0a0a */
}

.depth-effect::before,
.depth-effect::after {
    z-index: 1;
    border-radius: inherit;
    display: flex;
    justify-content: center;
    align-items: center;
}

.category {
    align-content: center;
    font-size: x-large;
}

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