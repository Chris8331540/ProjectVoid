<script setup lang="ts">

defineProps<{
    name?: string
    skillSelected: number,
    updateSkillSelected: Function,
}>();

const skillButtons = ["basic", "dodge", "assist", "special", "chain"];
const skillImgs = ["basic_attack.webp", "dodge_attack.webp", "assist_attack.webp", "special_attack.webp", "chain_attack.webp"];
</script>
<template>
    <div class="button-container" id="botones-principal">
        <div class="button-box-wrapper">
            <div class="button-box">
                <div v-for="(skill, index) in skillButtons" :key="index" @click="updateSkillSelected(index)"
                    class="button-item relative z-10 button-animation"
                    :class="[skillSelected === index ? 'button-animation-active button-item-active' : '']">
                    <img :src="`/storage/images/attacks/${skillImgs[index]}`" class="button-icon w-12 h-12"
                        :class="[skillSelected === index ? 'button-icon-active' : '']" />
                    <span class="button-text title-button"
                        :class="[skillSelected === index ? 'button-text-active' : '']">{{ skill }}</span>
                </div>
            </div>
            <div class="w-full h-full flex absolute top-0 left-0 dot-pattern"></div>
        </div>
    </div>
</template>

<style scoped>
/*Transición botones skills */
.button-container {
    display: flex;
    width: 100%;
    justify-content: center;
    padding: 16px;
    position: relative;
    z-index: 0;
}

.button-box-wrapper {
    background-color: #27272a;
    border-radius: 100px;
    border: 4px solid black;
    display: inline-flex;
    position: relative;
}

.button-box {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.2rem;
    background-color: black;
    border-radius: 100px;

}

.button-item {
    width: 3rem;
    height: 50px;
    border-radius: 50px;
    color: black;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.7s;
}

.button-item:hover {
    width: 140px;
    justify-content: start;
    padding: 0.1rem
}

.button-text {
    opacity: 0;
    transition: opacity 0.5s;
    position: relative;
    width: 100%;
    text-align: start;
    font-weight: bold;
    font-size: 1rem;
    text-transform: uppercase;
}

.button-item:hover .button-text {
    opacity: 1;
}

.button-icon {
    margin-left: 3rem;
}

.button-item:hover .button-icon {
    margin-left: 0;
    margin-right: 0.5rem;

}

/*demás estilos*/

.title-button {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 1rem;
    font-weight: 800;
}

/**Botón activo */
.button-text-active {
    opacity: 1;
}

.button-icon-active {
    margin-left: 0;
    margin-right: 0.5rem;
}

.button-item-active {
    width: 140px;
    justify-content: start;
    padding: 0.1rem
}

.button-animation-active {
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
    animation:textShine 1.4s ease-in-out infinite;
    /* border-radius: 100px 20px; */
    /* Transiciones específicas para los cambios de posicionamiento */
    transition: all 0.5s ease-in-out;
    z-index: 20;
}

/**----------- */
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
    animation:textShine 1.8s ease-in-out infinite;
    /* border-radius: 100px 20px; */
    /* Transiciones específicas para los cambios de posicionamiento */
    transition: all 0.5s ease-in-out;
    z-index: 20;
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


@keyframes textShine {
    0% {
        background-position: 135% 50%;
    }

    100% {
        background-position: 0% 50%;
    }
}
</style>
