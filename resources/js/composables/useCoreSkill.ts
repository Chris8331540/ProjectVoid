import {ref} from 'vue';

let coreLetters = ["A", "B", "C", "D", "E", "F"];
//Actualizamos la variable
//tambien podemos tener otra variable para acceder al "array" del objeto, donde A = 0, B = 1, etc
export const useCoreSkill = () =>{
    const letterSelected = ref<"A" | "B" | "C" | "D" | "E" | "F">("A");
    const numberCore = ref<0 | 1 | 2 | 3 | 4 | 5>(0);

    function updateCoreSkill(value: typeof letterSelected.value){
        letterSelected.value = value;
        numberCore.value = coreLetters.indexOf(value) as 0 | 1 | 2 | 3 | 4 | 5;
    }
    return {letterSelected,numberCore, updateCoreSkill};
}