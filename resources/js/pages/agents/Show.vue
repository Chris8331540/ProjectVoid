<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import CoreSkillOption from '@/components/CoreSkillOption.vue';
import SkillOption from '@/components/SkillOption.vue';
import TextWrapper from '@/components/TextWrapper.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { useCoreSkill } from '@/composables/useCoreSkill';
import { useShowSubMenu } from '@/composables/useShowSubMenu';
import { useSkill } from '@/composables/useSkill';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Agents',
        href: '/dashboard',
    },
];
const props = defineProps<{
    name?: string;
    agent: any
}>();
const propCoreSkill = useCoreSkill();
const propShowSubMenu = useShowSubMenu();
const propSkill = useSkill();
const ranks = {
    s: "/storage/images/agents/Icon_AgentRank_S.webp",
    a: "/storage/images/agents/Icon_AgentRank_A.webp"
}
const patternId = computed(() => `pattern-${Math.random().toString(36).substring(2, 9)}`);


function replacePlaceholder(text: string, multipliers: Array<any>) {
    let multipliersOrdered = orderMultipliers(multipliers);
    let index = 0; // Para llevar el seguimiento de los reemplazos
    return text.replace(/{multiplier}/g, () => multipliersOrdered[index++].multiplier || "");
}

function orderMultipliers(multipliers: Array<any>) {
    //Se suma 1, ya que numbeCore es el index del array que se usa para mostrar la información al usuario.
    return multipliers.filter(mult => mult.lvl == propCoreSkill.numberCore.value + 1).sort((a, b) => a.orden - b.orden);
}


</script>

<template>

    <Head :title="agent.name" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="relative w-full min-h-screen "> <!-- Contenedor principal -->
            <!-- Fondo con patrón -->
            <svg class="absolute inset-0 w-full h-full stroke-neutral-900/20 dark:stroke-neutral-100/20" fill="none">
                <defs>
                    <pattern :id="patternId" x="0" y="0" width="8" height="8" patternUnits="userSpaceOnUse">
                        <path d="M-1 5L5 -1M3 9L8.5 3.5" stroke-width="0.5"></path>
                    </pattern>
                </defs>
                <rect stroke="none" :fill="`url(#${patternId})`" width="100%" height="100%"></rect>
            </svg>

            <div class="w-full p-4">
                <div class="pj-presentation flex relative z-10 overflow-hidden"
                    :style="{ backgroundImage: `url(${agent.image_show})` }">
                    <div class="flex pj-name w-full justify-end items-center p-4 z-20 flex-wrap">
                        <div class="mr-8 flex flex-col">
                            <div class="flex">
                                <span class="mr-5 border-text">{{ agent.name }}</span>
                            </div>

                            <div class="flex mr-8">
                                <img :src="agent.element.image" class="w-12 mr-5" />
                                <img :src="agent.type.image" class="w-12 mr-5" />
                                <img v-if="agent.rank == 's'" :src="ranks.s" class="w-12" />
                                <img v-else :src="ranks.a" class="w-12 mr-0" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="w-full pl-4 pt-4 pr-4 uppercase title-show">stats (level 60)</div>
            <div class="w-full flex flex-wrap md:flex-nowrap">
                <div class="flex w-full md:w-1/2">
                    <TextWrapper>
                        <div class="flex flex-col gap-5 font-bold">
                            <div
                                class="flex w-full bg-black justify-between rounded-full relative z-10 py-3 px-8 depth-effect">
                                <div class="base-text-style uppercase text-start">
                                    hp
                                </div>
                                <div class="text-end">
                                    {{ agent.hp }}
                                </div>
                            </div>
                            <div
                                class="flex w-full bg-black justify-between rounded-full relative z-10 py-3 px-8 depth-effect">
                                <div class="base-text-style uppercase text-start">
                                    def
                                </div>
                                <div class="text-end">
                                    {{ agent.def }}
                                </div>
                            </div>
                            <div
                                class="flex w-full bg-black justify-between rounded-full relative z-10 py-3 px-8 depth-effect">
                                <div class="base-text-style uppercase text-start">
                                    atk
                                </div>
                                <div class="text-end">
                                    {{ agent.atk }}
                                </div>
                            </div>
                            <div
                                class="flex w-full bg-black justify-between rounded-full relative z-10 py-3 px-8 depth-effect">
                                <div class="base-text-style uppercase text-start">
                                    crit rate
                                </div>
                                <div class="text-end">
                                    {{ agent.crit_rate }}%
                                </div>
                            </div>
                            <div
                                class="flex w-full bg-black justify-between rounded-full relative z-10 py-3 px-8 depth-effect">
                                <div class="base-text-style uppercase text-start">
                                    crit dmg
                                </div>
                                <div class="text-end">
                                    {{ agent.crit_dmg }}%
                                </div>
                            </div>
                        </div>
                    </TextWrapper>
                </div>
                <div class="flex w-full md:w-1/2">
                    <TextWrapper>
                        <div class="flex flex-col gap-5 font-bold">
                            <div
                                class="flex w-full bg-black justify-between rounded-full relative z-10 py-3 px-8 depth-effect">
                                <div class="base-text-style uppercase text-start">
                                    pen ratio
                                </div>
                                <div class="text-end">
                                    {{ agent.pen_ratio }}
                                </div>
                            </div>
                            <div
                                class="flex w-full bg-black justify-between rounded-full relative z-10 py-3 px-8 depth-effect">
                                <div class="base-text-style uppercase text-start">
                                    impact
                                </div>
                                <div class="text-end">
                                    {{ agent.impact }}
                                </div>
                            </div>
                            <div
                                class="flex w-full bg-black justify-between rounded-full relative z-10 py-3 px-8 depth-effect">
                                <div class="base-text-style uppercase text-start">
                                    anomaly mastery
                                </div>
                                <div class="text-end">
                                    {{ agent.anomaly_mastery }}
                                </div>
                            </div>
                            <div
                                class="flex w-full bg-black justify-between rounded-full relative z-10 py-3 px-8 depth-effect">
                                <div class="base-text-style uppercase text-start">
                                    anomaly proficiency
                                </div>
                                <div class="text-end">
                                    {{ agent.anomaly_proficiency }}
                                </div>
                            </div>
                            <div
                                class="flex w-full bg-black justify-between rounded-full relative z-10 py-3 px-8 depth-effect">
                                <div class="base-text-style uppercase text-start">
                                    energy regen
                                </div>
                                <div class="text-end">
                                    {{ agent.energy_regen }}
                                </div>
                            </div>
                        </div>
                    </TextWrapper>



                </div>
            </div>

            <div class="w-full flex z-0 p-4" id="botones-principal">
                <div class="w-full button-box-wrapper relative">
                    <div class="w-full flex button-box italic uppercase title-button">
                        <div class="w-1/3 button-left flex justify-center bg-black p-4 cursor-pointer"
                            @click="propShowSubMenu.updateOptionSelected(0)"
                            :class="[propShowSubMenu.optionSelected.value === 0 ? 'button-animation' : '']">
                            <span class="relative z-10">core skills</span>
                        </div>
                        <div class="w-1/3 button-middle flex justify-center bg-black p-4 cursor-pointer"
                            @click="propShowSubMenu.updateOptionSelected(1)"
                            :class="[propShowSubMenu.optionSelected.value === 1 ? 'button-animation' : '']">
                            <span class="relative z-10">skills</span>
                        </div>
                        <div class="w-1/3 button-right flex justify-center bg-black p-4 cursor-pointer"
                            @click="propShowSubMenu.updateOptionSelected(2)"
                            :class="[propShowSubMenu.optionSelected.value === 2 ? 'button-animation' : '']">
                            <span class="relative z-10">mindscapes</span>
                        </div>
                    </div>
                    <div class="w-full h-full flex absolute top-0 left-0 dot-pattern"></div>
                </div>
            </div>

            <CoreSkillOption v-if="propShowSubMenu.optionSelected.value === 0" :coreSkills="agent.core_skill"
                :numberCore="propCoreSkill.numberCore.value" :letterSelected="propCoreSkill.letterSelected.value"
                :updateCoreSkill="propCoreSkill.updateCoreSkill">
            </CoreSkillOption>
            <SkillOption v-if="propShowSubMenu.optionSelected.value === 1" :agent="agent"
                :skillSelected="propSkill.skillSelected.value" :updateSkillSelected="propSkill.updateSkillSelected">
            </SkillOption>



        </div>


    </AppLayout>

</template>
<style scoped>
.base-text-style {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.title-button {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 1rem;
    font-weight: 800;
}

.pj-name {
    text-transform: uppercase;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-style: italic;
    font-size: 2rem;
    font-weight: 800;
    color: white;
}

.title-show {
    text-transform: uppercase;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-style: italic;
    font-size: 1.5rem;
    font-weight: 800;
    color: white;
}

.pj-presentation {
    /* border-radius: 400px 80px; */
    background-color: black;
    border-radius: 15px;

    background-size: cover;
    /* Ajusta la imagen para cubrir el div */
    background-position: left center;
    /* Centra la imagen */
    background-repeat: no-repeat;
    /* Evita que se repita */

}

.border-text {
    -webkit-text-stroke-width: 2px;
    -webkit-text-stroke-color: black;
}

/*estilos botones */
.button-animation {
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
    animation: breath 1.4s ease-in-out infinite, textShine 1.4s ease-in-out infinite;
    /* border-radius: 100px 20px; */
    /* Transiciones específicas para los cambios de posicionamiento */
    transition: transform 0.5s ease-in-out, border-radius 1s ease;
    z-index: 20;
}

.button-left {
    border-radius: 120px 40px 200px 120px;
}

.button-middle {
    border-radius: 100px 40px;
}

.button-right {
    border-radius: 200px 120px 120px 40px;
}

.button-box-wrapper {
    /* background-color: #24242c; */
    background-color: oklch(0.274 0.006 286.033);
    /* hex: #27272a*/
    border-radius: 100px;
    padding: 0.2rem;
    border: 4px solid black;
    min-width: 473.6px;
}

.text-wrapper {
    background-color: oklch(0.274 0.006 286.033);
    padding: 0.2rem;
    border: 4px solid black;
}

.dot-pattern {
    border-radius: 100px;
    pointer-events: none;

    opacity: 0.4;
    background-image: repeating-linear-gradient(45deg, #27272a 25%, transparent 25%, transparent 75%, #27272a 75%, #27272a), repeating-linear-gradient(45deg, #27272a 25%, transparent 25%, transparent 75%, #27272a 75%, #27272a);
    background-position: 0 0, 4px 4px;
    background-size: 8px 8px;
}

.dot-pattern-text {
    border-radius: 12px;
    pointer-events: none;

    opacity: 0.4;
    background-image: repeating-linear-gradient(45deg, #27272a 25%, transparent 25%, transparent 75%, #27272a 75%, #27272a), repeating-linear-gradient(45deg, #27272a 25%, transparent 25%, transparent 75%, #27272a 75%, #27272a);
    background-position: 0 0, 4px 4px;
    background-size: 8px 8px;
}

.button-box {
    background-color: black;
    border-radius: 100px;


}

/* .button-animation:hover>img {
    filter: invert(1);
} */

@keyframes breath {
    0% {
        transform: scale(1);
        /* tamaño normal */
    }

    50% {
        transform: scale(1.02, 1.08);
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

.button-animation:hover {
    animation: breath 1.4s ease-in-out infinite, textShine 1.4s ease-in-out infinite;
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
</style>
