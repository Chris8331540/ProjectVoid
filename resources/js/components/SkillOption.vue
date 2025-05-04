<script setup lang="ts">
import SkillTabs from '@/components/SkillTabs.vue';
import TextWrapper from '@/components/TextWrapper.vue';

import Accordion from 'primevue/accordion';
import AccordionPanel from 'primevue/accordionpanel';
import AccordionHeader from 'primevue/accordionheader';
import AccordionContent from 'primevue/accordioncontent';


import { ref, computed } from 'vue';
const props = defineProps<{
    name?: string;
    agent: any,
    skillSelected: number,
    updateSkillSelected: Function
}>();

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
            return `<img src="/storage/images/attacks/${abilitysImg[placeholder]}" alt="${placeholder}" class="w-8 h-8 inline" />`;
        } else {
            return match; // Si no es un placeholder válido, mantenemos el texto original
        }
    });

    return resultText;
}
const currentLvl = ref(1);
//Tendría que ordenar los dazes, dmgs y otherproperties por nivel, para poder usar currentLvl
const findMultiplier = (array: any[], lvl: any) => {
    return array.find(item => item.lvl === lvl)?.multiplier || "-";
};

</script>

<template>
    <div class="w-full">
        <SkillTabs :skillSelected="skillSelected" :updateSkillSelected="updateSkillSelected"></SkillTabs>
    </div>
    <TextWrapper v-if="skillSelected === 0" widthClass="w-1/2">
        <template v-for="(basic, indexBasic) in agent.basic">
            <div class="w-full relative z-10 coreSkill">
                <div class="title text-xl">Basic Attack: {{ basic.name }}</div>
                <div class="info ml-1" v-html="replacePlaceholderImg(basic.info)"></div>
            </div>
            <!--Multiplicadores-->
            <Accordion class="relative z-10">
                <TextWrapper paddingClass="p-0" class="pt-2">
                    <AccordionPanel value="0" class="relative z-10">
                        <AccordionHeader class="header-accordion">Multipliers</AccordionHeader>
                        <AccordionContent>
                            <div class="p-4 relative z-10">
                                <label for="lvl">Nivel: {{ currentLvl }}</label>
                                <input class="shiny-slider" type="range" min="1" max="12" v-model.number="currentLvl"
                                    id="lvl" />

                                <div class="flex flex-col gap-4 font-bold mt-4">
                                    <div v-for="(entry, index) in agent.basic[indexBasic].basic_multiplier" :key="index"
                                        class="flex w-full gap-4 flex-col base-text-style">
                                        <div
                                            class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                            <div class="uppercase text-start">
                                                {{ entry.name }} Dmg Multiplier
                                            </div>
                                            <div class="md:text-end">
                                                {{ findMultiplier(entry.basic_dmg, currentLvl) }}
                                            </div>
                                        </div>

                                        <div
                                            class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                            <div class="uppercase text-start">
                                                {{ entry.name }} Daze Multiplier
                                            </div>
                                            <div class="md:text-end">
                                                {{ findMultiplier(entry.basic_daze, currentLvl) }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </AccordionContent>
                    </AccordionPanel>
                </TextWrapper>

            </Accordion>

        </template>
    </TextWrapper>


    <TextWrapper v-if="skillSelected === 1" widthClass="w-1/2">
        <template v-for="(dodge, indexDodge) in agent.dodge">
            <div class="w-full relative z-10 coreSkill">
                <div class="title text-xl">{{ dodge.name }}</div>
                <div class="info ml-1" v-html="replacePlaceholderImg(dodge.info)"></div>
            </div>
            <!--Multiplicadores-->
            <Accordion class="relative z-10">
                <TextWrapper paddingClass="p-0" class="pt-2">
                    <AccordionPanel value="0" class="relative z-10">
                        <AccordionHeader class="header-accordion">Multipliers</AccordionHeader>
                        <AccordionContent>
                            <div class="p-4 relative z-10">
                                <label for="lvl">Nivel: {{ currentLvl }}</label>
                                <input class="shiny-slider" type="range" min="1" max="12" v-model.number="currentLvl"
                                    id="lvl" />

                                <div class="flex flex-col gap-4 font-bold mt-4">
                                    <div v-for="(entry, index) in agent.dodge[indexDodge].dodge_multiplier" :key="index"
                                        class="flex w-full gap-4 flex-col base-text-style">
                                        <div
                                            class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                            <div class="uppercase text-start">
                                                {{ entry.name }} Dmg Multiplier
                                            </div>
                                            <div class="md:text-end">
                                                {{ findMultiplier(entry.dodge_dmg, currentLvl) }}
                                            </div>
                                        </div>

                                        <div
                                            class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                            <div class="uppercase text-start">
                                                {{ entry.name }} Daze Multiplier
                                            </div>
                                            <div class="md:text-end">
                                                {{ findMultiplier(entry.dodge_daze, currentLvl) }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </AccordionContent>
                    </AccordionPanel>
                </TextWrapper>
            </Accordion>

        </template>
    </TextWrapper>


    <TextWrapper v-if="skillSelected === 2" widthClass="w-1/2">
        <template v-for="(assist, indexAssist) in agent.assist">
            <div class="w-full relative z-10 coreSkill">
                <div class="title text-xl">{{ assist.name }}</div>
                <div class="info ml-1" v-html="replacePlaceholderImg(assist.info)"></div>
            </div>
            <!--Multiplicadores-->
            <Accordion class="relative z-10">
                <TextWrapper paddingClass="p-0" class="pt-2">
                    <AccordionPanel value="0" class="relative z-10">
                        <AccordionHeader class="header-accordion">Multipliers</AccordionHeader>
                        <AccordionContent>
                            <div class="p-4 relative z-10">
                                <label for="lvl">Nivel: {{ currentLvl }}</label>
                                <input class="shiny-slider" type="range" min="1" max="12" v-model.number="currentLvl"
                                    id="lvl" />

                                <div class="flex flex-col gap-4 font-bold mt-4">
                                    <div v-for="(entry, index) in agent.assist[indexAssist].assist_multiplier"
                                        :key="index" class="flex w-full gap-4 flex-col base-text-style">
                                        <div
                                            class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                            <div class="uppercase text-start">
                                                {{ entry.name }} Dmg Multiplier
                                            </div>
                                            <div class="md:text-end">
                                                {{ findMultiplier(entry.assist_dmg, currentLvl) }}
                                            </div>
                                        </div>

                                        <div
                                            class="justify-between rounded-full relative z-10 py-3 px-8 depth-effect md:flex">
                                            <div class="uppercase text-start">
                                                {{ entry.name }} Daze Multiplier
                                            </div>
                                            <div class="md:text-end">
                                                {{ findMultiplier(entry.assist_daze, currentLvl) }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </AccordionContent>
                    </AccordionPanel>
                </TextWrapper>
            </Accordion>

        </template>
    </TextWrapper>


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
</style>