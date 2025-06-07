<script setup lang="ts">
import { ref, watch, computed } from 'vue'

import axios from 'axios'
import { Link, usePage } from '@inertiajs/vue3';
const props = defineProps<{
    tierlistId: number
    averageScore: number
}>();
const average = ref<number>(props.averageScore);
const hover = ref<number | null>(null)
const errorMessage = ref('');

const widthPercentage = computed(() => {
    // Mostrar estrellas llenas según el promedio
    return `${(hover.value ?? average.value) * 20}%`
})

const page = usePage();
const canExecute = computed(() => page.url !== '/tierlists');
const rate = async (score: number) => {
    if (!canExecute.value) return
    console.log(typeof (score))
    try {
        const res = await axios.post(`/tierlists/${props.tierlistId}/rate`, { score })
        average.value = res.data.average
    } catch (error: any) {
        if (error.response?.status === 401) {
            errorMessage.value = 'Debes iniciar sesión para votar.'

        } else {
            console.error('Error al guardar puntuación:', error)
        }
    }
}
</script>

<template>
    <div class="relative z-10 flex w-max flex-row items-center">
        <!-- Estrellas vacías -->
        <div class="relative cursor-pointer" @mouseleave="canExecute ? hover = null : null">
            <div class="flex text-gray-300">
                <span v-for="i in 5" :key="'bg-' + i" class="text-2xl" @mouseover="canExecute ? hover = i : null"
                    @click="rate(i)">★</span>
            </div>
            <!-- Estrellas rellenas en amarillo -->
            <div class="absolute top-0 left-0 flex color-star overflow-hidden pointer-events-none"
                :style="{ width: widthPercentage }">
                <span v-for="i in 5" :key="'fg-' + i" class="text-2xl">★</span>
            </div>
        </div>
        <div class="ml-2 text-gray-500 relative z-10 font-bold">{{ average.toFixed(1) }}</div>
        <Link v-if="errorMessage" :href="route('login')"
            class="text-sm text-red-500 bg-red-100 px-2 py-1 rounded transition-opacity duration-300 ml-2">
        {{ errorMessage }}
        </Link>
    </div>
</template>

<style scoped>
.stars {
    align-items: center;
}

.color-star {
    background: linear-gradient(to left,
            #bea200 0%,
            #ffee00 25%,
            #bea200 50%,
            #ffee00 75%,
            #bea200 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    /**text-fill-color: transparent;**/
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