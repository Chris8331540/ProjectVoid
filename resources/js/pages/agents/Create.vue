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

//tomar en cuenta que los valores de coreSkillMultipliers son un array por cada valor (6 niveles) es decir, que es posible tener de 1 a X valores, y opr lo tanto arrays
//de la misma forma los coreSkillAdditions, X valores y 6 niveles, por lo que de 1 a X arrays
function insertCoreSkillTemplate() {
    const coreSkillData = [{
        "coreSkill": {
            "name": "Core Passive Graceful Andante",
            "info": "During the Idyllic Cadenza state...",
            "order": 1,
            "image": ""
        },
        "coreSkillMultipliers": [["24", "26", "28", "30", "32", "35"]],
        "coreSkillAttributes": ["atk"],
        "coreSkillAdditions": [["0", "25", "25", "50", "50", "75"]]
    }]

    coreSkillDataJson.value = JSON.stringify(coreSkillData, null, 4);
}

function insertBasicSkillTemplate() {
    const basicSkillData = [
        {
            "basics": [{
                "name": "\"Capriccio\"",
                "info": "Press {basic} to activate:<br>Perform up to three attacks forward, dealing Ether DMG.<br>During the 3rd-hit, hold {basic} to charge, drawing enemies in and expanding the attack range for a stronger attack. After using other skills, hold {basic} to initiate the 3rd-hit directly.",
                "image": "",
            }],
            "basicMultipliers": [
                {
                    "name": "1st-Hit",
                    "multiplier_type": "atk",
                    "dmgs_dazes": [
                        [["43.80%", "41.30%"], ["59.10%", "56.40%"], ["120.90%", "114.80%"], ["270.70%", "219.40%"]],
                        [["47.80%", "43.20%"], ["64.50%", "59.00%"], ["131.90%", "120.10%"], ["295.40%", "229.40%"]],
                        [["51.80%", "45.10%"], ["69.90%", "61.60%"], ["142.90%", "125.40%"], ["320.10%", "239.40%"]],
                        [["55.80%", "47.00%"], ["75.30%", "64.20%"], ["153.90%", "130.70%"], ["344.80%", "249.40%"]],
                        [["59.80%", "48.90%"], ["80.70%", "66.80%"], ["164.90%", "136.00%"], ["369.50%", "259.40%"]],
                        [["63.80%", "50.80%"], ["86.10%", "69.40%"], ["175.90%", "141.30%"], ["394.20%", "269.40%"]],
                        [["67.80%", "52.70%"], ["91.50%", "72.00%"], ["186.90%", "146.60%"], ["418.90%", "279.40%"]],
                        [["71.80%", "54.60%"], ["96.90%", "74.60%"], ["197.90%", "151.90%"], ["443.60%", "289.40%"]],
                        [["75.80%", "56.50%"], ["102.30%", "77.20%"], ["208.90%", "157.20%"], ["468.30%", "299.40%"]],
                        [["79.80%", "58.40%"], ["107.70%", "79.80%"], ["219.90%", "162.50%"], ["493.00%", "309.40%"]],
                        [["83.80%", "60.30%"], ["113.10%", "82.40%"], ["230.90%", "517.70%"], ["493.00%", "319.40%"]],
                        [["87.80%", "62.20%"], ["118.50%", "85.00%"], ["241.90%", "173.10%"], ["542.40%", "329.40%"]],
                        [["87.80%", "62.20%"], ["118.50%", "85.00%"], ["241.90%", "173.10%"], ["542.40%", "329.40%"]],
                        [["87.80%", "62.20%"], ["118.50%", "85.00%"], ["241.90%", "173.10%"], ["542.40%", "329.40%"]],
                        [["87.80%", "62.20%"], ["118.50%", "85.00%"], ["241.90%", "173.10%"], ["542.40%", "329.40%"]],
                        [["87.80%", "62.20%"], ["118.50%", "85.00%"], ["241.90%", "173.10%"], ["542.40%", "329.40%"]],
                    ]
                },
                {
                    "name": "2nd-Hit",
                    "multiplier_type": "atk",
                },
                {
                    "name": "1st-Hit",
                    "multiplier_type": "atk",
                }
            ],


        }
    ]

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