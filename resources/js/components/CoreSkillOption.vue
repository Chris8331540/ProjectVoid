<script setup lang="ts">
import CoreSkillTabs from '@/components/CoreSkillTabs.vue';

const props = defineProps<{
    name?: string;
    coreSkills: any,
    numberCore: number,
    letterSelected: string,
    updateCoreSkill: Function

}>();

function replacePlaceholder(text: string, multipliers: Array<any>) {
    let multipliersOrdered = orderMultipliers(multipliers);
    let index = 0; // Para llevar el seguimiento de los reemplazos
    return text.replace(/{multiplier}/g, () => multipliersOrdered[index++].multiplier || "");
}

function orderMultipliers(multipliers: Array<any>) {
    //Se suma 1, ya que numbeCore es el index del array que se usa para mostrar la información al usuario.
    return multipliers.filter(mult => mult.lvl == props.numberCore + 1).sort((a, b) => a.orden - b.orden);
}


</script>

<template>
    <div class="w-full flex p-4 z-0">
                <div class="w-full flex rounded-xl relative text-wrapper">
                    <div class="w-full flex-col relative bg-black rounded-md p-4">
                        <CoreSkillTabs class="relative z-10" :letterSelected="letterSelected"
                            :numberCore="numberCore"
                            :updateCoreSkill="updateCoreSkill"></CoreSkillTabs>
                        <template v-for="coreSkill in coreSkills">
                            <div class="w-full relative z-10 coreSkill">
                                <div class="title text-xl">{{ coreSkill.name }}</div>
                                <div class="info ml-1">{{ replacePlaceholder(coreSkill.info,
                                    coreSkill.core_skill_multiplier) }}</div>
                                <div class="w-full relative z-10 flex flex-row flex-wrap">
                                    <template v-for="coreSkillAttribute in coreSkill.core_skill_attribute">
                                        <div class="uppercase text-lg ml-1 title-button italic">
                                            {{ coreSkillAttribute.name }} +{{
                                                coreSkillAttribute.core_skill_addition[numberCore].value}}
                                        </div>
                                    </template>
                                </div>

                            </div>
                        </template>
                        <div class="w-full h-full flex absolute top-0 left-0 dot-pattern-text"></div>
                    </div>
                </div>
            </div>
</template>
<style scoped>

.text-wrapper {
    background-color: oklch(0.274 0.006 286.033);
    padding: 0.2rem;
    border: 4px solid black;
}

.dot-pattern-text {
    border-radius: 12px;
    pointer-events: none;

    opacity: 0.4;
    background-image: repeating-linear-gradient(45deg, #27272a 25%, transparent 25%, transparent 75%, #27272a 75%, #27272a), repeating-linear-gradient(45deg, #27272a 25%, transparent 25%, transparent 75%, #27272a 75%, #27272a);
    background-position: 0 0, 4px 4px;
    background-size: 8px 8px;
}
.title-button {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 1rem;
    font-weight: 800;
}
</style>