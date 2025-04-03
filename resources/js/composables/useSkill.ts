import {ref} from 'vue';

export const useSkill = () =>{
    const skillSelected = ref<0 | 1 | 2 | 3 | 4>(0);

    function updateSkillSelected(value: typeof skillSelected.value){
        skillSelected.value = value;
    }

    return {skillSelected, updateSkillSelected};
}