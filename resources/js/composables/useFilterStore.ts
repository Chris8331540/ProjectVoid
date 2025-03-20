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