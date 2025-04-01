<script setup lang="ts">

const props = defineProps<{
    name?: string

}>();


</script>
<!-- <template>
    <div class="w-full flex z-0 p-4 justify-center" id="botones-principal">
                <div class="w-4/6 button-box-wrapper relative">
                    <div class="w-full flex button-box italic uppercase title-button">
                        <div class="w-1/5 flex justify-start items-center p-2 cursor-pointer button-animation button-left relative z-10">
                            <img src="/storage/images/attacks/basic_attack.webp" class="w-12 h-12"/><span class="relative z-10">basic</span>
                        </div>
                        <div class="w-1/5 flex justify-start items-center p-2 cursor-pointer button-animation button-middle relative z-10">
                            <img src="/storage/images/attacks/dodge_attack.webp" class="w-12 h-12"/><span class="relative z-10">dodge</span>
                        </div>
                        <div class="w-1/5 flex justify-start items-center p-2 cursor-pointer button-animation button-middle relative z-10">
                            <img src="/storage/images/attacks/assist_attack.webp" class="w-12 h-12"/><span class="relative z-10">assist</span>
                        </div>
                        <div class="w-1/5 flex justify-start items-center p-2 cursor-pointer button-animation button-middle relative z-10">
                            <img src="/storage/images/attacks/special_attack.webp" class="w-12 h-12"/><span class="relative z-10">special</span>
                        </div>
                        <div class="w-1/5 flex justify-start items-center p-2 cursor-pointer button-animation button-right relative z-10">
                            <img src="/storage/images/attacks/chain_attack.webp" class="w-12 h-12"/><span class="relative z-10">chain</span>
                        </div>
                    </div>
                    <div class="w-full h-full flex absolute top-0 left-0 dot-pattern"></div>
                </div>
            </div>
</template> -->
<template>
    <div class="w-full flex z-0 p-4 justify-center" id="botones-principal">
        <div class="inline-flex button-box-wrapper relative">
            <div class="inline-flex button-box italic uppercase title-button">
                <!-- Primer botón: -->
                <div class="inline-flex justify-start items-center p-2 cursor-pointer button-animation button-left relative z-10 group">
                    <img src="/storage/images/attacks/basic_attack.webp" class="w-12 h-12"/>
                    <span class="ml-2 mr-4 transition-all duration-300 hidden group-hover:block">basic</span>
                </div>
                <!-- Segundo botón: -->
                <div class="inline-flex justify-start items-center p-2 cursor-pointer button-animation button-middle relative z-10 group">
                    <img src="/storage/images/attacks/dodge_attack.webp" class="w-12 h-12"/>
                    <span class="ml-2 mr-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 hidden group-hover:block">dodge</span>
                </div>
                <!-- Tercer botón: -->
                <div class="inline-flex justify-start items-center p-2 cursor-pointer button-animation button-middle relative z-10 group">
                    <img src="/storage/images/attacks/assist_attack.webp" class="w-12 h-12"/>
                    <span class="ml-2 mr-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 hidden group-hover:block">assist</span>
                </div>
                <!-- Cuarto botón: -->
                <div class="inline-flex justify-start items-center p-2 cursor-pointer button-animation button-middle relative z-10 group">
                    <img src="/storage/images/attacks/special_attack.webp" class="w-12 h-12"/>
                    <span class="ml-2 mr-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 hidden group-hover:block">special</span>
                </div>
                <!-- Quinto botón: -->
                <div class="inline-flex justify-start items-center p-2 cursor-pointer button-animation button-right relative z-10 group">
                    <img src="/storage/images/attacks/chain_attack.webp" class="w-12 h-12"/>
                    <span class="ml-2 mr-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 hidden group-hover:block">chain</span>
                </div>
            </div>
            <div class="w-full h-full flex absolute top-0 left-0 dot-pattern"></div>
        </div>
    </div>
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
.button-animation:hover {
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

</style>
