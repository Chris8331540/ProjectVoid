<script setup lang="ts">

import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';


const patternId = computed(() => `pattern-${Math.random().toString(36).substring(2, 9)}`);

defineProps<{
    imgSrc: string,
    name: string,
    elementIcon: string,
    typeIcon: string,
    agentId: number
}>();

</script>

<template>
    <Link :href="route('agents.show', agentId)" target="_blank" method="get" as="a">
    <div class="relative w-full h-full"> <!-- Contenedor principal -->
        <svg class="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" fill="none">
            <defs>
                <pattern :id="patternId" x="0" y="0" width="8" height="8" patternUnits="userSpaceOnUse">
                    <path d="M-1 5L5 -1M3 9L8.5 3.5" stroke-width="0.5"></path>
                </pattern>
            </defs>
            <rect stroke="none" :fill="`url(#${patternId})`" width="100%" height="100%"></rect>
        </svg>
        <!-- Contenedor para la imagen y el texto -->
        <div class="absolute inset-0 group"> <!-- Añade group para manejar el hover -->
            <div class="absolute bottom-0 z-20 flex">
                <img :src="elementIcon" class="icon-class w-6 h-6 object-contain" />
                <img :src="typeIcon" class="icon-class w-6 h-6 object-contain" />
            </div>
            <!-- Imagen con transición y efecto de escala -->
            <img :src="imgSrc" :alt="name"
                class="tierlist-image absolute max-w-full transform origin-top top-4 transition duration-300 ease-in-out -mt-6" />
        </div>
    </div>
    </Link>
</template>


<style scoped>
.tierlist-image{
    transform: scale(2);
}
/* .tierlist-image:hover{
    transform: scale(2.5);
} */
.container {
    color: white;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    flex-direction: column;
}

@keyframes textShine {
    0% {
        background-position: 135% 50%;
    }

    100% {
        background-position: 0% 50%;
    }
}

.group:hover p {
    text-transform: uppercase;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 1.2rem;
    font-style: italic;
    font-weight: bolder;
    filter: drop-shadow(2px 2px 4px black);
    margin: 5px;
    background: linear-gradient(to left,
            #A6C100 0%,
            #DBD100 25%,
            #A6C100 50%,
            #DBD100 75%,
            #A6C100 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    /**text-fill-color: transparent;**/
    background-size: 400% auto;
    animation: textShine 2.5s linear infinite;
    transition: all .2s ease-in-out;
}
</style>