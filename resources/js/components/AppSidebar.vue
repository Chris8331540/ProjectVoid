<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, Plus, Trophy } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

import { usePage } from '@inertiajs/vue3';

const page = usePage();

const isAuthenticated = (page.props.auth as { user: any }).user !== null;
const mainNavItems: NavItem[] = [
    {
        title: 'Agents',
        href: '/agents',
        icon: "/storage/images/agents/Icon_Agents.webp",
    },
    {
        title: 'Tier List',
        href: '/tierlists',
        icon: Trophy,
    }
];

const footerNavItems: NavItem[] = [
    {
        title: 'Add Agent',
        href: '/agents/create',
        icon: Plus,
    }
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                        <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <!--Este se encarga de mostrar el usuario logeado-->
        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser v-if="isAuthenticated" />
            <div v-else>
                <Link :href="route('login')">
                <button
                    class=" w-full p-2 rounded border text-neutral-600 hover:text-neutral-800 dark:text-neutral-300 dark:hover:text-neutral-100 hover:bg-zinc-800">Iniciar
                    sesión</button>
                </Link>
            </div>

        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
