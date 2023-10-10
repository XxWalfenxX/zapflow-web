<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import "leaflet/dist/leaflet.css";
import { LMap, LTileLayer, LMarker } from "@vue-leaflet/vue-leaflet";
import { ref } from "vue";
//import arcades from "/Users/Bemen3/Downloads/estacions.json";
import axios from "axios";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

var arcades = ref();

axios.get("/api/kudos").then((response) => {
    arcades = response.data;
});

let zoom = ref(12);
let center = ref([41.3732, 2.154]);

var mapURL = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";

if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
    mapURL =
        "https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png";
}

var currentEstacion = ref("");
</script>

<template>
    <Head title="Inicio" />
    <GuestLayout
        :canLogin="canLogin"
        :canRegister="canRegister"
        :propUser="$page.props.auth.user"
    >
        <div
            class="flex flex-col md:flex-row gap-4 m-8 h-[80vh] text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700"
        >
            <div
                class="w-full md:w-1/4 p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700"
            >
                <h5
                    v-if="currentEstacion == ''"
                    class="mb-2 text-3xl font-bold text-gray-900 dark:text-white"
                >
                    Elige un punto de carga
                </h5>
                <h5
                    v-else
                    class="mb-2 text-3xl font-bold text-gray-900 dark:text-white"
                >
                    {{ currentEstacion.NOM_ESTACIO }}
                </h5>
                <p
                    v-if="currentEstacion == ''"
                    class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400"
                >
                    Selecciona un punto de carga para ver su información actual
                </p>
                <p
                    v-else
                    class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400"
                >
                    {{ currentEstacion.PICTO }}
                </p>
            </div>

            <div class="flex-[1_1_50vh] md:w-3/4">
                <l-map
                    ref="map"
                    v-model:zoom="zoom"
                    v-model:center="center"
                    :useGlobalLeaflet="false"
                >
                    <l-tile-layer
                        :url="mapURL"
                        layer-type="base"
                        name="Stadia Maps Basemap"
                    ></l-tile-layer>
                    <l-marker
                        v-for="arcade in arcades.features"
                        :lat-lng="arcade.geometry.coordinates.reverse()"
                        @click="currentEstacion = arcade.properties"
                    ></l-marker>
                </l-map>
            </div>
        </div>
    </GuestLayout>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
