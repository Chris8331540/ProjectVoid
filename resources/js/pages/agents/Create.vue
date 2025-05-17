<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import { computed } from 'vue';
import TextWrapper from '@/components/TextWrapper.vue';
import { ref } from "vue";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Agent',
        href: '/dashboard',
    },
];
const patternId = computed(() => `pattern-${Math.random().toString(36).substring(2, 9)}`);

/*variables para las plantillas*/
const agentDataJson = ref("");
const coreSkillDataJson = ref("");

function insertAgentDataTemplate() {
    const agentData = {
        "name": "Astra Yao",
        "info": "Famosa cantante",
        "rank": "s",
        "hp": "1200",
        "def": "300",
        "atk": "330",
        "crit_rate": "5",
        "crit_dmg": "50",
        "pen_ratio": "0",
        "impact": "0",
        "anomaly_mastery": "100",
        "anomaly_proficiency": "98",
        "energy_regen": "3.4",
        "element_id": "ether",
        "type_id": "support"
    };

    agentDataJson.value = JSON.stringify(agentData, null, 4);
}

function insertCoreSkillTemplate(){
    const coreSkillData = {
        "coreSkill":{
            "name": "Core Passive Graceful Andante",
            "info": "During the Idyllic Cadenza state...",
            "order" : 1,
            "image" : ""
        },
        "coreSkillMultipliers": ["24", "26", "28", "30", "32", "35"],
        "coreSkillAttributes":["atk"],
        "coreSkillAdditions":["0", "25", "25", "50", "50", "75"]
    }

    coreSkillDataJson.value = JSON.stringify(coreSkillData, null, 4);
}
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

            <TextWrapper width-class="w-full">
                <div class="relative z-10 flex w-full justify-between mb-3">
                    <div class="title relative z-10">Agent data</div>
                    <button class="btn-check vertical-align" @click="insertAgentDataTemplate">Insert agent data
                        template</button>
                </div>
                <div>
                    <textarea class="bg-black relative z-10 w-full rounded" v-model="agentDataJson"></textarea>
                </div>
            </TextWrapper>

            <TextWrapper width-class="w-full">
                <div class="relative z-10 flex w-full justify-between mb-3">
                    <div class="title relative z-10">CoreSkill data</div>
                    <button class="btn-check vertical-align" @click="insertCoreSkillTemplate">Insert CoreSkill
                        template</button>
                </div>
                <div>
                    <textarea class="bg-black relative z-10 w-full rounded" v-model="coreSkillDataJson"></textarea>
                </div>
            </TextWrapper>
        </div>


    </AppLayout>
</template>
<style scoped>
.vertical-align {
    align-content: center;
}
</style>