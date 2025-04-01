//ESTE NO FUNCIONA / NO SE USA
//EXPLICACION: Necesitaba que el componente PADRE se modificara al cambiar el valor de un componente HIJO
//una variable reactive/ref no funciona de hijo a padre solo de padre a hijo, para eso usar defineEmits o v-model
//o usar ref y seguir el ejemplo de useCoreSkills, donde el padre pasa los return de useCoreSkills al hijo para que sean la misma instancia y por lo tanto si afecte al padre

import { reactive } from "vue";

export const useFilterStore = () =>{
    const state = reactive({
        rank:"all",
        element:"all",
        type:"all"
    });

    const updateRank = (value: string) =>{
        state.rank = value;
    }

    const updateElement = (value:string)=>{
        state.element = value;
    }

    const updateType = (value:string)=>{
        state.type = value;    
    }

    return {
        state,
        updateRank,
        updateElement,
        updateType
    }
}