<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import { computed } from 'vue';
import TextWrapper from '@/components/TextWrapper.vue';
import { ref } from "vue";

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';


const imagePreview = ref<{ [key: string]: string | null }>({
    imagePrincipal: null,
    imageShow: null,
})

function previewImage(event: Event, key: 'imagePrincipal' | 'imageShow') {
    const input = event.target as HTMLInputElement
    const file = input.files?.[0]
    if (!file) return

    const reader = new FileReader()
    reader.onload = (e: ProgressEvent<FileReader>) => {
        imagePreview.value[key] = e.target?.result as string
    }
    reader.readAsDataURL(file)
}

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
const basicSkillDataJson = ref("");
const dodgeSkillDataJson = ref("");
const assistSkillDataJson = ref("");

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
        "element": "ether",
        "type": "support"
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
            "basic": {
                "name": "\"Capriccio\"",
                "info": "Press {basic} to activate:<br>Perform up to three attacks forward, dealing Ether DMG.<br>During the 3rd-hit, hold {basic} to charge, drawing enemies in and expanding the attack range for a stronger attack. After using other skills, hold {basic} to initiate the 3rd-hit directly.",
                "image": "",
            },
            "basicMultipliers": [
                {
                    "name": "1st-Hit",
                    "multiplier_type": "atk",
                    "dmgs_dazes": [
                        ["43.80%", "41.30%"], ["59.10%", "56.40%"], ["120.90%", "114.80%"], ["270.70%", "219.40%"],
                        ["47.80%", "43.20%"], ["64.50%", "59.00%"], ["131.90%", "120.10%"], ["295.40%", "229.40%"],
                        ["51.80%", "45.10%"], ["69.90%", "61.60%"], ["142.90%", "125.40%"], ["320.10%", "239.40%"],
                        ["55.80%", "47.00%"], ["75.30%", "64.20%"], ["153.90%", "130.70%"], ["344.80%", "249.40%"]
                    ]
                },
                {
                    "name": "2nd-Hit",
                    "multiplier_type": "atk",
                    "dmgs_dazes": [
                        ["43.80%", "41.30%"], ["59.10%", "56.40%"], ["120.90%", "114.80%"], ["270.70%", "219.40%"],
                        ["47.80%", "43.20%"], ["64.50%", "59.00%"], ["131.90%", "120.10%"], ["295.40%", "229.40%"],
                        ["51.80%", "45.10%"], ["69.90%", "61.60%"], ["142.90%", "125.40%"], ["320.10%", "239.40%"],
                        ["55.80%", "47.00%"], ["75.30%", "64.20%"], ["153.90%", "130.70%"], ["344.80%", "249.40%"]
                    ]
                },
                {
                    "name": "1st-Hit",
                    "multiplier_type": "atk",
                    "dmgs_dazes": [
                        ["43.80%", "41.30%"], ["59.10%", "56.40%"], ["120.90%", "114.80%"], ["270.70%", "219.40%"],
                        ["47.80%", "43.20%"], ["64.50%", "59.00%"], ["131.90%", "120.10%"], ["295.40%", "229.40%"],
                        ["51.80%", "45.10%"], ["69.90%", "61.60%"], ["142.90%", "125.40%"], ["320.10%", "239.40%"],
                        ["55.80%", "47.00%"], ["75.30%", "64.20%"], ["153.90%", "130.70%"], ["344.80%", "249.40%"]
                    ]
                }
            ],


        }
    ];
    basicSkillDataJson.value = JSON.stringify(basicSkillData, null, 4);
}

function insertDodgeSkillTemplate() {
    const dodgeSkillData = [
        {
            "dodge": {
                "name": "Dash Attack: \"Lunar Eclipse Melody\"",
                "info": "Press {basic} during a dodge to activate:<br>Attack ahead, dealing Ether DMG.<br>When triggered, dragging thestick/joystick allows movement in the corresponding direction.",
                "image": "",
            },
            "dodgeMultipliers": [
                {
                    "name": "",
                    "multiplier_type": "atk",
                    "dmgs_dazes": [
                        ["43.80%", "41.30%"], ["59.10%", "56.40%"], ["120.90%", "114.80%"], ["270.70%", "219.40%"],
                        ["47.80%", "43.20%"], ["64.50%", "59.00%"], ["131.90%", "120.10%"], ["295.40%", "229.40%"],
                        ["51.80%", "45.10%"], ["69.90%", "61.60%"], ["142.90%", "125.40%"], ["320.10%", "239.40%"],
                        ["55.80%", "47.00%"], ["75.30%", "64.20%"], ["153.90%", "130.70%"], ["344.80%", "249.40%"]
                    ]
                }
            ],
        }
    ];
    dodgeSkillDataJson.value = JSON.stringify(dodgeSkillData, null, 4);
}

function insertAssistSkillTemplate() {
    const assistSkillData = [
        {
            "assist":
            {
                "name": "Quick Assist: \"One Luminous Sky\"",
                "info": "When the on-field character is launched, press {assist} to activate.<br>Attack enemies in front, dealing Ether DMG.<br>Character is invulnerable while using this skill.",
                "image": "",
            }
            ,
            "assistMultipliers": [
                {
                    "name": "",
                    "multiplier_type": "atk",
                    "dmgs_dazes": [
                        ["43.80%", "41.30%"], ["59.10%", "56.40%"], ["120.90%", "114.80%"], ["270.70%", "219.40%"],
                        ["47.80%", "43.20%"], ["64.50%", "59.00%"], ["131.90%", "120.10%"], ["295.40%", "229.40%"],
                        ["51.80%", "45.10%"], ["69.90%", "61.60%"], ["142.90%", "125.40%"], ["320.10%", "239.40%"],
                        ["55.80%", "47.00%"], ["75.30%", "64.20%"], ["153.90%", "130.70%"], ["344.80%", "249.40%"]
                    ]
                }
            ]
        }

    ];
    assistSkillDataJson.value = JSON.stringify(assistSkillData, null, 4);
}
</script>

<template>

    <Head title="Create Agent" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <form action="/agents/create" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrfToken" />
            <div class="relative w-full min-h-screen ">
                <svg class="absolute inset-0 w-full h-full stroke-neutral-900/20 dark:stroke-neutral-100/20"
                    fill="none">
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
                        <button type="button" class="btn-check vertical-align" @click="insertAgentDataTemplate">Insert agent data
                            template</button>
                    </div>
                    <div>
                        <textarea class="bg-black relative z-10 w-full rounded" v-model="agentDataJson"
                            name="agentDataJson"></textarea>
                    </div>
                </TextWrapper>

                <TextWrapper width-class="w-full">
                    <div class="relative z-10 flex w-full justify-between mb-3">
                        <div class="title relative z-10">Core Skill data</div>
                        <button type="button" class="btn-check vertical-align" @click="insertCoreSkillTemplate">Insert Core Skill
                            template</button>
                    </div>
                    <div>
                        <textarea class="bg-black relative z-10 w-full rounded" v-model="coreSkillDataJson"
                            name="coreSkillDataJson"></textarea>
                    </div>
                </TextWrapper>

                <TextWrapper width-class="w-full">
                    <div class="relative z-10 flex w-full justify-between mb-3">
                        <div class="title relative z-10">Basic Skill data</div>
                        <button type="button" class="btn-check vertical-align" @click="insertBasicSkillTemplate">Insert Basic Skill
                            template</button>
                    </div>
                    <div>
                        <textarea class="bg-black relative z-10 w-full rounded" v-model="basicSkillDataJson"
                            name="basicSkillDataJson"></textarea>
                    </div>
                </TextWrapper>
                <TextWrapper width-class="w-full">
                    <div class="relative z-10 flex w-full justify-between mb-3">
                        <div class="title relative z-10">Dodge Skill data</div>
                        <button type="button" class="btn-check vertical-align" @click="insertDodgeSkillTemplate">Insert Dodge Skill
                            template</button>
                    </div>
                    <div>
                        <textarea class="bg-black relative z-10 w-full rounded" v-model="dodgeSkillDataJson"
                            name="dodgeSkillDataJson"></textarea>
                    </div>
                </TextWrapper>
                <TextWrapper width-class="w-full">
                    <div class="relative z-10 flex w-full justify-between mb-3">
                        <div class="title relative z-10">Assist Skill data</div>
                        <button type="button" class="btn-check vertical-align" @click="insertAssistSkillTemplate">Insert Assist Skill
                            template</button>
                    </div>
                    <div>
                        <textarea class="bg-black relative z-10 w-full rounded" v-model="assistSkillDataJson"
                            name="assistSkillDataJson"></textarea>
                    </div>
                </TextWrapper>

                <TextWrapper width-class="w-full">
                    <div class="relative z-10 flex w-full justify-between mb-3">
                        <div class="title relative z-10">Agent images</div>
                    </div>
                    <div>
                        <input name="imagePrincipal" type="file" @change="previewImage($event, 'imagePrincipal')" class="relative z-10"
                            required/>
                        <img v-if="imagePreview.imagePrincipal" :src="imagePreview.imagePrincipal"
                            class="mt-2 max-w-[200px] relative z-10" />

                        <input name="imageShow" type="file" @change="previewImage($event, 'imageShow')" class="relative z-10" required />
                        <img v-if="imagePreview.imageShow" :src="imagePreview.imageShow"
                            class="mt-2 max-w-[200px] relative z-10" />
                    </div>
                </TextWrapper>
                
                <TextWrapper>
                    <div>
                        <input class="relative z-10" type="submit" value="Crear agente">
                    </div>
                </TextWrapper>
            </div>
        </form>


    </AppLayout>
</template>
<style scoped>
.vertical-align {
    align-content: center;
}
</style>