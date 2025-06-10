<script setup lang="ts">
import SkillTabs from '@/components/SkillTabs.vue';
import TextWrapper from '@/components/TextWrapper.vue';

import Accordion from 'primevue/accordion';
import AccordionPanel from 'primevue/accordionpanel';
import AccordionHeader from 'primevue/accordionheader';
import AccordionContent from 'primevue/accordioncontent';


import { ref, computed, reactive, onMounted } from 'vue';
const props = defineProps<{
    name?: string;
    agent: any,
    skillSelected: number,
    updateSkillSelected: Function
}>();
const srcReplacement = "/storage/images/attacks/";
const abilitysImg: {
    [key: string]: string;  // Define que las claves son cadenas y los valores son cadenas
} = {
    "basic": "basic_attack.webp",
    "assist": "assist_attack.webp",
    "chain": "chain_attack.webp",
    "dodge": "dodge_attack.webp",
    "special": "special_attack.webp"
};
function replacePlaceholderImg(text: string) {
    // Expresión regular para encontrar texto dentro de {}
    const regex = /\{(\w+)\}/g;

    // Reemplazar las coincidencias en el texto
    const resultText = text.replace(regex, (match, placeholder) => {
        // Verificamos si el placeholder es una clave válida
        if (abilitysImg[placeholder]) {
            return `<img src="${srcReplacement + abilitysImg[placeholder]}" alt="${placeholder}" class="w-8 h-8 inline" />`;
        } else {
            return match; // Si no es un placeholder válido, mantenemos el texto original
        }
    });

    return resultText;
}
// const currentLvl = ref(1);
//Tendría que ordenar los dazes, dmgs y otherproperties por nivel, para poder usar currentLvl
const findMultiplier = (array: any[], lvl: any) => {
    console.log(typeof array);
    return array.find(item => item.lvl === lvl)?.multiplier || "-";
};
const levelMap = reactive<{
    basic: number[],
    dodge: number[],
    assist: number[],
    special: number[],
    chain: number[]
    // agrega más categorías si las tienes
}>({
    basic: [],
    dodge: [],
    assist: [],
    special: [],
    chain: [],
});
onMounted(() => {
    levelMap.basic = props.agent.basic.map(() => 1);
    levelMap.dodge = props.agent.dodge.map(() => 1);
    levelMap.assist = props.agent.assist.map(() => 1);
    levelMap.special = props.agent.special.map(() => 1);
    levelMap.chain = props.agent.chain.map(() => 1);
});
</script>

<template>
    <div class="w-full">
        <SkillTabs :skillSelected="skillSelected" :updateSkillSelected="updateSkillSelected"></SkillTabs>
    </div>
    <div v-if="skillSelected === 0" class="w-full flex-wrap flex relative z-10">
        <TextWrapper v-for="(basic, indexBasic) in agent.basic" widthClass="sm:w-1/2 w-full">
            <div class="flex flex-col h-full skill-container">
                <div class="w-full relative z-10 coreSkill">
                    <div class="title text-xl">{{ basic.name }}</div>
                    <div class="info ml-1" v-html="replacePlaceholderImg(basic.info)"></div>
                </div>
                <!--Multiplicadores-->
                <Accordion class="relative z-10" v-if="agent.basic[indexBasic].basic_multiplier!=''">
                    <TextWrapper paddingClass="p-0" class="pt-2">
                        <AccordionPanel value="0" class="relative z-10">
                            <AccordionHeader class="header-accordion">Multipliers</AccordionHeader>
                            <AccordionContent>
                                <div class="p-4 relative z-10">
                                    <label :for="'lvl-basic-' + indexBasic">Level: {{ levelMap.basic[indexBasic]
                                        }}</label>
                                    <input class="shiny-slider" type="range" min="1" max="16"
                                        v-model.number="levelMap.basic[indexBasic]" :id="'lvl-basic-' + indexBasic" />

                                    <div class="flex flex-col gap-4 font-bold mt-4">
                                        <div v-for="(entry, index) in agent.basic[indexBasic].basic_multiplier"
                                            :key="index" class="flex w-full gap-4 flex-col base-text-style">
                                            <div
                                                class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                                <div class="uppercase text-start">
                                                    {{ entry.name }} Dmg Multiplier
                                                </div>
                                                <div class="md:text-end">
                                                    {{ findMultiplier(entry.basic_dmg, levelMap.basic[indexBasic]) }}
                                                </div>
                                            </div>

                                            <div
                                                class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                                <div class="uppercase text-start">
                                                    {{ entry.name }} Daze Multiplier
                                                </div>
                                                <div class="md:text-end">
                                                    {{ findMultiplier(entry.basic_daze, levelMap.basic[indexBasic]) }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </AccordionContent>
                        </AccordionPanel>
                    </TextWrapper>

                </Accordion>
            </div>

        </TextWrapper>
    </div>


    <div v-if="skillSelected === 1" class="w-full flex-column flex-wrap flex relative z-10">
        <TextWrapper v-for="(dodge, indexDodge) in agent.dodge" widthClass="sm:w-1/2 w-full">
            <div class="flex flex-col h-full skill-container">
                <div class="w-full relative z-10 coreSkill">
                    <div class="title text-xl">{{ dodge.name }}</div>
                    <div class="info ml-1" v-html="replacePlaceholderImg(dodge.info)"></div>
                </div>
                <!--Multiplicadores-->
                <Accordion class="relative z-10" v-if="agent.dodge[indexDodge].dodge_multiplier!=''">
                    <TextWrapper paddingClass="p-0" class="pt-2">
                        <AccordionPanel value="0" class="relative z-10">
                            <AccordionHeader class="header-accordion">Multipliers</AccordionHeader>
                            <AccordionContent>
                                <div class="p-4 relative z-10">
                                    <label :for="'lvl-dodge-' + indexDodge">Level: {{
                                        levelMap.dodge[indexDodge] }}</label>
                                    <input class="shiny-slider" type="range" min="1" max="16"
                                        v-model.number="levelMap.dodge[indexDodge]" :id="'lvl-dodge-' + indexDodge" />
                                    <div class="flex flex-col gap-4 font-bold mt-4">
                                        <div v-for="(entry, index) in agent.dodge[indexDodge].dodge_multiplier"
                                            :key="index" class="flex w-full gap-4 flex-col base-text-style">
                                            <div
                                                class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                                <div class="uppercase text-start">
                                                    {{ entry.name }} Dmg Multiplier
                                                </div>
                                                <div class="md:text-end">
                                                    {{ findMultiplier(entry.dodge_dmg, levelMap.dodge[indexDodge]) }}
                                                </div>
                                            </div>

                                            <div
                                                class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                                <div class="uppercase text-start">
                                                    {{ entry.name }} Daze Multiplier
                                                </div>
                                                <div class="md:text-end">
                                                    {{ findMultiplier(entry.dodge_daze, levelMap.dodge[indexDodge]) }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </AccordionContent>
                        </AccordionPanel>
                    </TextWrapper>
                </Accordion>
            </div>
        </TextWrapper>
    </div>

    <div v-if="skillSelected === 2" class="w-full flex-column flex-wrap flex relative z-10">
        <TextWrapper v-for="(assist, indexAssist) in agent.assist" widthClass="sm:w-1/2 w-full">
            <div class="flex flex-col h-full skill-container">
                <div class="w-full relative z-10 coreSkill">
                    <div class="title text-xl">{{ assist.name }}</div>
                    <div class="info ml-1" v-html="replacePlaceholderImg(assist.info)"></div>
                </div>
                <!--Multiplicadores-->
                <Accordion class="relative z-10" v-if="agent.assist[indexAssist].assist_multiplier!=''">
                    <TextWrapper paddingClass="p-0" class="pt-2">
                        <AccordionPanel value="0" class="relative z-10">
                            <AccordionHeader class="header-accordion">Multipliers</AccordionHeader>
                            <AccordionContent>
                                <div class="p-4 relative z-10">
                                    <label :for="'lvl-assist-' + indexAssist">Level: {{ levelMap.assist[indexAssist]
                                        }}</label>
                                    <input class="shiny-slider" type="range" min="1" max="16"
                                        v-model.number="levelMap.assist[indexAssist]"
                                        :id="'lvl-assist-' + indexAssist" />

                                    <div class="flex flex-col gap-4 font-bold mt-4">
                                        <div v-for="(entry, index) in agent.assist[indexAssist].assist_multiplier"
                                            :key="index" class="flex w-full gap-4 flex-col base-text-style">
                                            <div
                                                class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                                <div class="uppercase text-start">
                                                    {{ entry.name }} Dmg Multiplier
                                                </div>
                                                <div class="md:text-end">
                                                    {{ findMultiplier(entry.assist_dmg, levelMap.assist[indexAssist]) }}
                                                </div>
                                            </div>

                                            <div
                                                class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                                <div class="uppercase text-start">
                                                    {{ entry.name }} Daze Multiplier
                                                </div>
                                                <div class="md:text-end">
                                                    {{ findMultiplier(entry.assist_daze, levelMap.assist[indexAssist])
                                                    }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </AccordionContent>
                        </AccordionPanel>
                    </TextWrapper>
                </Accordion>
            </div>
        </TextWrapper>
    </div>

    <div v-if="skillSelected === 3" class="w-full flex-column flex-wrap flex relative z-10">
        <TextWrapper v-for="(special, indexSpecial) in agent.special" widthClass="sm:w-1/2 w-full">
            <div class="flex flex-col h-full skill-container">
                <div class="w-full relative z-10 coreSkill">
                    <div class="title text-xl">{{ special.name }}</div>
                    <div class="info ml-1" v-html="replacePlaceholderImg(special.info)"></div>
                </div>
                <!--Multiplicadores-->
                <Accordion class="relative z-10" v-if="agent.special[indexSpecial].special_multiplier!=''">
                    <TextWrapper paddingClass="p-0" class="pt-2">
                        <AccordionPanel value="0" class="relative z-10">
                            <AccordionHeader class="header-accordion">Multipliers</AccordionHeader>
                            <AccordionContent>
                                <div class="p-4 relative z-10">
                                    <label :for="'lvl-special-' + indexSpecial">Level: {{ levelMap.special[indexSpecial]
                                    }}</label>
                                    <input class="shiny-slider" type="range" min="1" max="16"
                                        v-model.number="levelMap.special[indexSpecial]"
                                        :id="'lvl-special-' + indexSpecial" />

                                    <div class="flex flex-col gap-4 font-bold mt-4">
                                        <div v-for="(entry, index) in agent.special[indexSpecial].special_multiplier"
                                            :key="index" class="flex w-full gap-4 flex-col base-text-style">
                                            <div
                                                class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                                <div class="uppercase text-start">
                                                    {{ entry.name }} Dmg Multiplier
                                                </div>
                                                <div class="md:text-end">
                                                    {{ findMultiplier(entry.special_dmg, levelMap.special[indexSpecial])
                                                    }}
                                                </div>
                                            </div>

                                            <div
                                                class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                                <div class="uppercase text-start">
                                                    {{ entry.name }} Daze Multiplier
                                                </div>
                                                <div class="md:text-end">
                                                    {{ findMultiplier(entry.special_daze,
                                                        levelMap.special[indexSpecial]) }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </AccordionContent>
                        </AccordionPanel>
                    </TextWrapper>
                </Accordion>
            </div>
        </TextWrapper>
    </div>

    <div v-if="skillSelected === 4" class="w-full flex-column flex-wrap flex relative z-10">
        <TextWrapper v-for="(chain, indexChain) in agent.chain" widthClass="sm:w-1/2 w-full">
            <div class="flex flex-col h-full skill-container">
                <div class="w-full relative z-10 coreSkill">
                    <div class="title text-xl">{{ chain.name }}</div>
                    <div class="info ml-1" v-html="replacePlaceholderImg(chain.info)"></div>
                </div>
                <!--Multiplicadores-->
                <Accordion class="relative z-10" v-if="agent.chain[indexChain].chain_multiplier!=''">
                    <TextWrapper paddingClass="p-0" class="pt-2">
                        <AccordionPanel value="0" class="relative z-10">
                            <AccordionHeader class="header-accordion">Multipliers</AccordionHeader>
                            <AccordionContent>
                                <div class="p-4 relative z-10">
                                    <label :for="'lvl-chain-' + indexChain">Level: {{ levelMap.chain[indexChain]
                                        }}</label>
                                    <input class="shiny-slider" type="range" min="1" max="16"
                                        v-model.number="levelMap.chain[indexChain]" id="'lvl-chain-'+indexChain" />

                                    <div class="flex flex-col gap-4 font-bold mt-4">
                                        <div v-for="(entry, index) in agent.chain[indexChain].chain_multiplier"
                                            :key="index" class="flex w-full gap-4 flex-col base-text-style">
                                            <div
                                                class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                                <div class="uppercase text-start">
                                                    {{ entry.name }} Dmg Multiplier
                                                </div>
                                                <div class="md:text-end">
                                                    {{ findMultiplier(entry.chain_dmg, levelMap.chain[indexChain]) }}
                                                </div>
                                            </div>

                                            <div
                                                class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                                <div class="uppercase text-start">
                                                    {{ entry.name }} Daze Multiplier
                                                </div>
                                                <div class="md:text-end">
                                                    {{ findMultiplier(entry.chain_daze, levelMap.chain[indexChain]) }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </AccordionContent>
                        </AccordionPanel>
                    </TextWrapper>
                </Accordion>
            </div>
        </TextWrapper>
    </div>

</template>

<style scoped>
input[type="range"] {
    width: 100%;
}

.shiny-slider {
    -webkit-appearance: none;
    width: 100%;
    height: 0px;
    background: transparent;
    position: relative;
}

/* Barra del slider (track) */
.shiny-slider::-webkit-slider-runnable-track {
    height: 8px;
    border-radius: 4px;
    background: linear-gradient(to left,
            #A6C100 0%,
            #DBD100 25%,
            #A6C100 50%,
            #DBD100 75%,
            #A6C100 100%);
}

.shiny-slider::-moz-range-track {
    height: 8px;
    border-radius: 4px;
    background: linear-gradient(to left,
            #A6C100 0%,
            #DBD100 25%,
            #A6C100 50%,
            #DBD100 75%,
            #A6C100 100%);
}

/* Thumb del slider */
.shiny-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 18px;
    height: 18px;
    background: #A6C100;
    border-radius: 50%;
    border: 3px solid white;
    margin-top: -5px;
    cursor: pointer;
    z-index: 10;
    position: relative;
}

.shiny-slider::-moz-range-thumb {
    width: 18px;
    height: 18px;
    background: #A6C100;
    border: none;
    border-radius: 50%;
    cursor: pointer;
}

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

.base-text-style {
    font-size: 0.85rem;
}

/*ACORDEON*/
.p-accordionpanel,
.p-accordionheader {
    border: none;
}

:deep(.p-accordioncontent-content) {
    border: none !important;
}

.header-accordion {
    font-weight: bold;
}

.skill-container {
    justify-content: space-between;
}
</style>