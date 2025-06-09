<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem, useSidebar } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, Plus, Medal, User } from 'lucide-vue-next';
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
        icon: Medal,
    }
];

const footerNavItems: NavItem[] = [
    {
        title: 'Add Agent',
        href: '/agents/create',
        icon: Plus,
    }
];
const {isMobile, state} = useSidebar();
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('home')">
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
                    class="w-full flex btn-login gap-2 p-2 rounded border text-neutral-600 hover:text-neutral-800 dark:text-neutral-300 dark:hover:text-neutral-100 hover:bg-zinc-800">
                    <component :is="User" />
                   <span v-if="state!='collapsed' || isMobile">Log in</span></button>
                </Link>
            </div>

        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
<style scoped>
.btn-login{
    justify-content: center;
}
</style>
