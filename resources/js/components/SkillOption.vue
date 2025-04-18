<script setup lang="ts">
import SkillTabs from '@/components/SkillTabs.vue';
import TextWrapper from '@/components/TextWrapper.vue';
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
</script>

<template>
    <div class="w-full">
        <SkillTabs :skillSelected="skillSelected" :updateSkillSelected="updateSkillSelected"></SkillTabs>
    </div>
    <TextWrapper v-if="skillSelected===0">
        <template v-for="basic in agent.basic">
            <div class="w-full relative z-10 coreSkill">
                <div class="title text-xl">Basic Attack: {{ basic.name }}</div>
                <div class="info ml-1" v-html="replacePlaceholderImg(basic.info)"></div>
            </div>
            <!--Multiplicadores-->
            <div>
                <table></table>
            </div>
        </template>
    </TextWrapper>
</template>