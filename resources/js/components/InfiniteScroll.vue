<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { Link } from '@inertiajs/vue3'
import TextWrapper from './TextWrapper.vue'
import { usePage } from '@inertiajs/vue3';
import StarScore from './StarScore.vue';
const props = defineProps<{
    userId?: any
}>();

const usepage = usePage<any>();
//compruebo que existe un usuario autenticado, y en caso de que sí, que compruebe sus ids, si son iguales entonces
//el usuario autenticado es válido para que se le muestre el botón de eliminar la tierlist
const isUserAuth = usepage.props.auth.user == null ? false : usepage.props.auth.user.id == props.userId;
const currentUrl = window.location.pathname;
const tierlistUrl = currentUrl === '/tierlists';
const tierlists = ref<any>([])
const page = ref(1)
const loading = ref(false)
const hasMore = ref(true)
const scrollContainer = ref(null)

const deleteTierlist = async (id: number) => {
    try {
        await axios.delete(`/tierlists/${id}`);
        tierlists.value = tierlists.value.filter((t: any) => t.id !== id);
    } catch (error) {
        console.error("Error deleting tierlist:", error);
    }
};

const fetchItems = async () => {
    if (loading.value || !hasMore.value) return
    loading.value = true
    try {
        // URL sin /api porque usamos web.php y same domain
        const res = await axios.get(`${currentUrl}` + `?page=${page.value}`)
        // Laravel pagination: last_page está en res.data.last_page
        //controlar qué parte de la respuesta se copia al array tierlists dependiendo de la url
        //TODO: optimizar dado que al final comparten el mismo formato json (en principio)
        if (page.value === 1) tierlists.value = res.data.data
        else tierlists.value.push(...res.data.data)

        hasMore.value = page.value < res.data.last_page
        if (hasMore.value) page.value++

    } catch (error) {
        console.error(error)
    } finally {
        loading.value = false
    }
}
const onScroll = () => {
    const el = scrollContainer.value as any;
    if (!el) return

    if (el.scrollTop + el.clientHeight >= el.scrollHeight - 100) {
        fetchItems()
    }
}
onMounted(() => {
    fetchItems()
})
</script>

<template>
    <div ref="scrollContainer" @scroll="onScroll" class="overflow-y-auto scroll-container"
        :class="tierlistUrl ? 'scroll-75vh' : 'scroll-65vh'">

        <TextWrapper v-for="tierlist in tierlists" :key="tierlist.id">
            <div class="flex flex-row">
                <div class="flex flex-col" :class="isUserAuth ? 'w-2/3' : 'w-full'">
                    <Link :href="`/tierlists/${tierlist.id}`">
                    <div class="relative z-10 title !ml-0 w-full">{{ tierlist.title }}, by {{ tierlist.user.name }}
                    </div>

                    <div class="relative z-10 w-full">{{ tierlist.description }}</div>
                    <StarScore :averageScore="tierlist.average_score" :tierlistId="tierlist.id">
                    </StarScore>
                    </Link>
                </div>

                <div v-if="isUserAuth" class="w-1/3 flex flex-wrap justify-end content-center">
                    <button @click="deleteTierlist(tierlist.id)"
                        class="bg-button depth-effect sm:w-1/2 !text-center sm:self-end p-2">
                        Delete</button>
                </div>
            </div>

        </TextWrapper>


        <p v-if="loading">Cargando más...</p>
        <p v-if="!hasMore && !loading">No hay más datos.</p>
    </div>
</template>
<style scoped>
.scroll-75vh {
    height: 75vh;
}

.scroll-65vh {
    height: 65vh;
}

.scroll-container {
    -ms-overflow-style: none;
    /* IE y Edge */
    scrollbar-width: none;
    /* Firefox */
}

.scroll-container::-webkit-scrollbar {
    display: none;
    /* Chrome, Safari y Opera */
}

.bg-button {
    position: relative;
    z-index: 10;
    border-color: #CE0A10;
    border: 0.25rem solid;
    color: #CE0A10;
    font-weight: bolder;
    text-transform: uppercase;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-style: italic;
}

.bg-button:hover {
    border-color: black;
    color: black;
    background-color: #CE0A10;
    transition: all 0.05s ease-in-out;

}

.depth-effect {
    box-shadow: inset 0 0 10px 6px #000000, 0 0 10px 2px rgba(255, 255, 255, 0.1), 0.125em 0.125em 0.25em rgba(0, 0, 0, 0.125), 0 0.0625em 0.375em rgba(0, 0, 0, 0.1875);
    border-radius: 2rem;
}

.depth-effect:hover {
    box-shadow: none;
}

.depth-effect::before,
.depth-effect::after {
    z-index: 1;
    border-radius: inherit;
    display: flex;
    justify-content: center;
    align-items: center;
}

.bg-button:hover {
    text-transform: uppercase;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-style: italic;
    font-size: 1rem;
    font-weight: 800;
    color: black;
    background: linear-gradient(to left,
            #CE0A10 0%,
            #ed060e 25%,
            #CE0A10 50%,
            #ed060e 75%,
            #CE0A10 100%);
    background-size: 400% auto;
    animation: textShine 2.5s linear infinite;
    /* border-radius: 100px 20px; */
    /* Transiciones específicas para los cambios de posicionamiento */
    transition: transform 0.5s ease-in-out, border-radius 1s ease;
    animation: breath 1.4s ease-in-out infinite, textShine 1.4s ease-in-out infinite;
}

@keyframes breath {
    0% {
        transform: scale(1);
        /* tamaño normal */
    }

    50% {
        transform: scale(1.02);
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