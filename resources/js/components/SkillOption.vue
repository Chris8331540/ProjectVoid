<script setup lang="ts">
import SkillTabs from '@/components/SkillTabs.vue';
import TextWrapper from '@/components/TextWrapper.vue';
const props = defineProps<{
    name?: string;
    agent: any,
    skillSelected: number,
    updateSkillSelected: Function
}>();
</script>

<template>
    <div class="w-full">
        <SkillTabs :skillSelected="skillSelected" :updateSkillSelected="updateSkillSelected"></SkillTabs>
    </div>
    <TextWrapper>
        <template v-for="basic in agent.basic">
            <div class="w-full relative z-10 coreSkill">
                <div class="title text-xl">{{ basic.name }}</div>
                <div class="info ml-1">{{ basic.info }}</div>
            </div>
        </template>
    </TextWrapper>
</template>