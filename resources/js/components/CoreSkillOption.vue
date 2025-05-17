<script setup lang="ts">
import CoreSkillTabs from '@/components/CoreSkillTabs.vue';
import TextWrapper from '@/components/TextWrapper.vue';
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
    return multipliers.filter(mult => mult.lvl == props.numberCore + 1).sort((a, b) => a.order - b.order);
}

</script>

<template>
    <TextWrapper>
        <CoreSkillTabs class="relative z-10" :letterSelected="letterSelected" :numberCore="numberCore"
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
                                coreSkillAttribute.core_skill_addition[numberCore].value }}
                        </div>
                    </template>
                </div>

            </div>
        </template>
    </TextWrapper>
</template>
<style scoped>
.title-button {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 1rem;
    font-weight: 800;
}
</style>