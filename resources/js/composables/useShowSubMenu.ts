import { ref } from 'vue';

export const useShowSubMenu = () => {
    const optionSelected = ref<0 | 1 | 2>(0);
    function updateOptionSelected(value: typeof optionSelected.value){
        optionSelected.value = value;
    }
    return {optionSelected, updateOptionSelected};
}