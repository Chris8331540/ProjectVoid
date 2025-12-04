<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import TextWrapper from '@/components/TextWrapper.vue';
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import InfiniteScroll from '@/components/InfiniteScroll.vue';
const props = defineProps<{
    name?: string;
    user: any
}>();
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile',
        href: '/dashboard',
    },
];
// const page = usePage();
// const user = page.props.auth?.user;

const formatedDate = dayjs(props.user.created_at).format('DD/MM/YY');
</script>

<template>

    <Head title="Profile" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <!--Se mostrará siempre ya que se supone que debe estar logueado para entrar, si o si-->
        <TextWrapper>
            <div class="relative z-10 title !ml-0">{{ user.name }}</div>
            <div class="relative z-10">Se unió el {{ formatedDate }}</div>

        </TextWrapper>
        <!-- <Link v-for="tierlist in user.tierlists" :href="'/tierlists/' + tierlist.id">
        <TextWrapper>
            <div class="relative z-10 title !ml-0">{{ tierlist.title }}</div>
            <div class="relative z-10">{{ tierlist.description }}</div>
        </TextWrapper>
        </Link> -->
        <InfiniteScroll class="mt-4 mb-2" :userId="user.id"></InfiniteScroll>
    </AppLayout>

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
    /* animation: textShine 2.5s linear infinite; */
    /* Transiciones específicas para los cambios de posicionamiento */
    animation: textShine 1.4s ease-in-out infinite;
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