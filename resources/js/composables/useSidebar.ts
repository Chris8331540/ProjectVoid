import { defineStore } from 'pinia';
import { ref } from 'vue';


export const useSidebarStore = defineStore("sidebarStore", () => {
    const sidebar = ref(localStorage.getItem('sidebar') !== 'false');

    const updateSidebar = (value: boolean) => {
        sidebar.value = value;
    }
    return { sidebar, updateSidebar };
});