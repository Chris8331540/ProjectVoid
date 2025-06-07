<script setup lang="ts">
import { SidebarProvider } from '@/components/ui/sidebar';
import { onMounted, ref } from 'vue';
import {useSidebarStore} from '@/composables/useSidebar';
interface Props {
    variant?: 'header' | 'sidebar';
}

defineProps<Props>();

const isOpen = ref(true);
const {sidebar, updateSidebar} = useSidebarStore();
onMounted(() => {
    isOpen.value = localStorage.getItem('sidebar') !== 'false';
    //cambiamos el valor de nuestro composable al establecido
    updateSidebar(isOpen.value);
});

const handleSidebarChange = (open: boolean) => {
    isOpen.value = open;
    localStorage.setItem('sidebar', String(open));
    //cambiamos el valor de nuestro composable
    updateSidebar(isOpen.value);
};
</script>

<template>
    <div v-if="variant === 'header'" class="flex min-h-screen w-full flex-col">
        <slot />
    </div>
    <SidebarProvider v-else :default-open="isOpen" :open="isOpen" @update:open="handleSidebarChange">
        <slot />
    </SidebarProvider>
</template>
