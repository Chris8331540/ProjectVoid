import {ref} from 'vue';

//Actualizamos la variable
export const useCoreSkill = () =>{
    const letterSelected = ref<"A" | "B" | "C" | "D" | "E" | "F">("A");

    function updateLetter(value: typeof letterSelected.value){
        letterSelected.value = value;
        return letterSelected;
    }

    return {letterSelected, updateLetter};
}