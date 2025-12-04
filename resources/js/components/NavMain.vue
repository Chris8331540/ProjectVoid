<script setup lang="ts">
import { SidebarGroup, SidebarMenu, SidebarMenuButton, SidebarMenuItem, useSidebar } from '@/components/ui/sidebar';
import { type SharedData, type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { computed} from 'vue';

defineProps<{
    items: NavItem[];
}>();

const page = usePage<SharedData>();
const currentPage = computed(() => page.url);


const {state} = useSidebar();
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <!-- <SidebarGroupLabel>Platform</SidebarGroupLabel> -->
        <SidebarMenu>
            <SidebarMenuItem v-for="item in items" :key="item.title">
                <SidebarMenuButton as-child :is-active="item.href === page.url" class="mt-0.5 mb-0.5">
                    <Link :href="item.href" class="flex justify-center items-center"
                        :class="[currentPage.startsWith(item.href) ? 'button-selected' : 'button bg-zinc-800', state!='collapsed'?'sidebarOpen':'aspect-square justify-center items-center !gap-0']">
                    <component v-if="typeof item.icon !== 'string'" :is="item.icon" />
                    <img v-else :src="item.icon" class="h-10 w-10 aspect-square object-contain"/>
                    <span>{{ item.title }}</span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>

<style scoped>


.button:hover {
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
    animation: textShine 2.5s linear infinite;
    transition: transform 0.5s ease-in-out, border-radius 0.2s linear;
    animation: breath 1.4s ease-in-out infinite, textShine 1.4s ease-in-out infinite;
}
.sidebarOpen{
    border-radius: 100px 20px;
}
.button:hover>img {
    filter: invert(1);
}

.button-selected {
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
    animation: textShine 2.5s linear infinite;
    animation: breath 1.4s ease-in-out infinite, textShine 1.4s ease-in-out infinite;
}

.button-selected>img {
    filter: invert(1);
}

.button-selected>component {
    filter: invert(1);
}

.img-config {
    min-height: 2.5rem;
    width: auto;
    object-fit: contain;
    aspect-ratio: 1 / 1;
}

@keyframes breath {
    0% {
        transform: scale(1);
        /* tamaño normal */
    }

    50% {
        transform: scale(1.04);
        /* tamaño expandido */
    }

    100% {
        transform: scale(1);
        /* vuelve al tamaño original */
    }
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