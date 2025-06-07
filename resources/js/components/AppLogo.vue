<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';

interface Props {
    class?: string;
}

defineProps<Props>();
</script>

<template>
    <div class="flex aspect-square size-8 items-center justify-center rounded-md text-sidebar-primary-foreground">
        <AppLogoIcon class="size-5" />
    </div>
    <div class="ml-1 grid flex-1 text-left text-sm">
        <span class="mb-0.5 truncate font-semibold leading-none logo-title">Project Void</span>
    </div>
</template>
<style scoped>
.logo-title {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 800;
    font-size: large;
    background: linear-gradient(to left,
            #7c7c7c 0%,
            #a8a8a8 25%,
            #7c7c7c 50%,
            #a8a8a8 75%,
            #7c7c7c 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    background-size: 400% auto;
    animation: textShine 2.5s linear infinite;
}

@keyframes textShine {
    0% {
        background-position: 135% 50%;
    }

    100% {
        background-position: 0% 50%;
    }
}
</style>