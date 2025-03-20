import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useFilterStore = defineStore('filterStore', () => {
    const rank = ref<"all" | "a" | "s">("all");
    const element = ref<"all" | "frost" | "ice" | "fire" | "electric" | "ether" | "physical">("all");
    const type = ref<"all" | "anomaly" | "attack" | "defense" | "support" | "stun">("all");

    function updateRank(value: typeof rank.value) {
        rank.value = value;
    }

    function updateElement(value: typeof element.value) {
        element.value = value;
    }

    function updateType(value: typeof type.value) {
        type.value = value;
    }

    return { rank, element, type, updateRank, updateElement, updateType };
});
