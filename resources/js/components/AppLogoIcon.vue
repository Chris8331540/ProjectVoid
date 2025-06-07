<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <!-- <img src="/storage/images/app/logoVoidHunter.png" /> -->
    <div class="animated-mask"></div>
</template>
<style scoped>
.animated-mask {
    width: 300px;
    height: 300px;

    /* Fondo animado (el gradiente en movimiento) */
    background: linear-gradient(to top right,
        #4d4d4d 0%,
        #7a7a7a 25%,
        #4d4d4d 50%,
        #7a7a7a 75%,
        #4d4d4d 100%);
    background-size: 350% auto;
    animation: textShine 2s linear infinite;

    /* Aplicar el PNG como máscara */
    -webkit-mask-image: url('/storage/images/app/logoVoidHunter.png');
    -webkit-mask-size: contain;
    -webkit-mask-repeat: no-repeat;
    -webkit-mask-position: center;

    mask-image: url('/storage/images/app/logoVoidHunter.png');
    mask-size: contain;
    mask-repeat: no-repeat;
    mask-position: center;

    /* Esto hace que solo se vea el gradiente donde el PNG es opaco */
    background-clip: border-box;
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