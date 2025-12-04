<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";


defineProps <{
    class?: string;
    letterSelected: string,
    numberCore: number,
    updateCoreSkill: (skill: any) => void
}>();
const letters = ["A", "B", "C", "D", "E", "F"];

</script>
<template>
    <div class="flex justify-center">
        <div class="button-box-wrapper relative z-10">
            <svg width="0" height="0" aria-hidden="true" class="relative z-10">
                <filter id="emboss">
                    <feGaussianBlur in="SourceAlpha" stdDeviation="9"></feGaussianBlur>
                    <feSpecularLighting surfaceScale="2" specularConstant=".75" specularExponent="17"
                        lighting-color="#ededed">
                        <fePointLight x="50%" y="-29000" z="20000"></fePointLight>
                    </feSpecularLighting>
                    <feComposite in2="SourceAlpha" operator="in"></feComposite>
                    <feComposite in="SourceGraphic" operator="arithmetic" k1="0" k2="1" k3="1" k4="0"></feComposite>
                </filter>
            </svg>
            <div class="w-full flex button-box italic uppercase tittle-button p-1 gap-1 transition-all duration-1000 ease-in-out">
                <button type="button" v-for="letter in letters" :key="letter" @click="updateCoreSkill(letter)" :data-char="letter" class="relative z-10" :title="letter"
                :class="[letterSelected===letter?'coreSkillSelectedEffect':'']">
                </button>
            </div>
            <div class="w-full h-full flex absolute top-0 left-0 dot-pattern"></div>
        </div>

    </div>


</template>
<style scoped>
.tittle-button {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 1rem;
    font-weight: 800;
}



/*estilos botonera principal*/
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

.button-box {
    background-color: black;
    border-radius: 100px;
}

/*BOTONES CSS */
svg{
  display: flex;
}
.button-box {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;

  /* flex-wrap: wrap; */

  position: relative;
  gap: 0.5rem;
  color: black;
}
button {
  display: grid;
  border: none;
  padding: 0.4rem;
  border-radius: 50%;
  box-shadow:  inset 0 0.1875em 1px #161616, 0 0 0 rgba(255, 255, 255, 0.1), 0.125em 0.125em 0.25em rgba(0, 0, 0, 0.125), 0 0.0625em 0.375em rgba(0, 0, 0, 0.1875);
  background: radial-gradient(circle 1.5em at 50% calc(100% - .5*3em), #101010 100%, transparent) #090909;
  font: inherit;
  text-transform: uppercase;
  transition: box-shadow 0.35s ease-out;
  cursor: pointer;
}

.coreSkillSelectedEffect{
  animation: shadowAnimation 3s ease-in-out infinite;
  outline: none;
}
button:active {
  --press: 1.5 ;
  animation: shadowAnimation 3s ease-in-out infinite;
  outline: none;
}
button::before, button::after {
  grid-area: 1/1;
  z-index: 1;
  width: 3em;
  height: 3em;
  border-radius: inherit;
  transform: translatey(calc(var(--press, 0)*.25*0.25em));
  transition: transform 0.25s ease-in-out;
  display: flex;
    justify-content: center;
    align-items: center;
}
button::before {
  box-shadow: inset 0 0.125em 0.125em -0.125em rgba(255, 255, 255, 0.5), inset 0 3em 0.125em -2.25em currentcolor, inset 0 3em 0.25em -2.25em currentcolor, inset 0 3em 0.375em -2.25em currentcolor, inset 0 3em 0.5em -2.25em currentcolor, inset 0 3em 0.625em -2.25em currentcolor, inset 0 3em 0.75em -2.25em currentcolor, inset 0 3em 0.875em -2.25em currentcolor, inset 0 3em 1em -2.25em currentcolor;
  background: linear-gradient(currentcolor 15%, transparent 65%), radial-gradient(circle 1.3125em, #292828 100%, currentcolor);
  color: #1d1c1c;
  content: "";
}
button::after {
  color: #010101;
  filter: url(#emboss) drop-shadow(1px 0.0625em 1px #000);
  content: attr(data-char);
}

@keyframes shadowAnimation {
  0% {
    box-shadow: inset 0 0 0.1875em #A6C100,
                inset 0 0.1875em 1px #161616,
                0 0.0625em 0.1875em rgba(255, 255, 255, 0.1),
                0.125em 0.125em 0.25em rgba(0, 0, 0, 0.125),
                0 0.0625em 0.375em rgba(0, 0, 0, 0.1875);
  }
  25% {
    box-shadow: inset 0 0 1em #DBD100,
                inset 0 0.1875em 1px #161616,
                0 0.0625em 0.1875em rgba(255, 255, 255, 0.1),
                0.125em 0.125em 0.25em rgba(0, 0, 0, 0.125),
                0 0.0625em 0.375em rgba(0, 0, 0, 0.1875);
  }
  50% {
    box-shadow: inset 0 0 0.1875em #A6C100,
                inset 0 0.1875em 1px #161616,
                0 0.0625em 0.1875em rgba(255, 255, 255, 0.1),
                0.125em 0.125em 0.25em rgba(0, 0, 0, 0.125),
                0 0.0625em 0.375em rgba(0, 0, 0, 0.1875);
  }
  75% {
    box-shadow: inset 0 0 1em #DBD100,
                inset 0 0.1875em 1px #161616,
                0 0.0625em 0.1875em rgba(255, 255, 255, 0.1),
                0.125em 0.125em 0.25em rgba(0, 0, 0, 0.125),
                0 0.0625em 0.375em rgba(0, 0, 0, 0.1875);
  }
  100% {
    box-shadow: inset 0 0 0.1875em #A6C100,
                inset 0 0.1875em 1px #161616,
                0 0.0625em 0.1875em rgba(255, 255, 255, 0.1),
                0.125em 0.125em 0.25em rgba(0, 0, 0, 0.125),
                0 0.0625em 0.375em rgba(0, 0, 0, 0.1875);
  }
}
</style>