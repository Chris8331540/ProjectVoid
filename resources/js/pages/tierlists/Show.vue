<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import ImageHolderTierList from '@/components/ImageHolderTierList.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

import TextWrapper from '@/components/TextWrapper.vue';
import { Link } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import { ref } from 'vue';
import StarScore from '@/components/StarScore.vue';
type TierCategory = 's' | 'a' | 'b' | 'c' | 'd' | 'e'

const categoriesName: TierCategory[] = ['s', 'a', 'b', 'c', 'd', 'e']
// 1. Inicializar el objeto organizado
const tierlistOrdered = ref<Record<TierCategory, any[]>>({
    s: [],
    a: [],
    b: [],
    c: [],
    d: [],
    e: [],
})

const props = defineProps<{
    name?: string;
    tierlist: any
}>();
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tier List',
        href: '/dashboard',
    },
];


function ordenarTierlist(entries: any[]) {
    //Distribuir según categoría 
    entries.forEach(entry => {
        const cat = (entry.category || '').toLowerCase() as TierCategory
        if (categoriesName.includes(cat)) {
            tierlistOrdered.value[cat].push(entry)
        }
    })

    // Ordenar por 'order'
    categoriesName.forEach(cat => {
        tierlistOrdered.value[cat].sort((a, b) => (a.order || 0) - (b.order || 0))
    })
}

ordenarTierlist(props.tierlist.tierlist_entries);
const formatedDate = dayjs(props.tierlist.user.created_at).format('DD/MM/YY');
</script>

<template>

    <Head title="Tier List" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <TextWrapper class="-mb-4">
            <div class="flex flex-column">
                <div>
                    <div class="relative z-10 title !ml-0">{{ tierlist.title }} by <Link :href="route('user.profile', tierlist.user.id)">{{ tierlist.user.name }}</Link></div>
                    <div class="relative z-10"> {{ tierlist.description }}</div>
                </div>
                <div>
                    <StarScore :averageScore="tierlist.average_score" :tierlistId="tierlist.id">
                    </StarScore>
                </div>
            </div>

        </TextWrapper>
        <TextWrapper>
            <div class="flex flex-col space-y-2 relative z-10">
                <div v-for="category in categoriesName" :key="category" class="flex items-center border-2 rounded p-1">
                    <!-- Primera columna: nombre de la categoría -->
                    <div
                        class="w-24 h-24 font-bold uppercase text-center text-white depth-effect rounded category title">
                        {{ category }}
                    </div>
                    <div class="flex flex-row w-full h-24 depth-effect rounded">
                        <div v-for="entry in tierlistOrdered[category]" :key="entry.id"
                            class="relative aspect-square overflow-hidden rounded border border-sidebar-border/70 dark:border-sidebar-border m-1">
                            <ImageHolderTierList :imgSrc="entry.agent.image" :name="entry.agent.name"
                                :elementIcon="entry.agent.element.image" :typeIcon="entry.agent.type.image"
                                :agentId="entry.agent.id" />
                        </div>
                    </div>
                </div>
            </div>
        </TextWrapper>

    </AppLayout>

</template>
<style scoped>
.stars {
    align-items: center;
}

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
</style>