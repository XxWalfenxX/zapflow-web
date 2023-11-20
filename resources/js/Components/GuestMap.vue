<script>
export default {
    data() {
        return {
            geojson: null,
            puntosOcupados: null,
        };
    },
    async created() {
        const response = await fetch("/api/map");
        this.geojson = await response.json();
        const rMapaOcupado = await fetch("/api/map/ocupado");
        this.puntosOcupados = await rMapaOcupado.json();
    },
};
</script>

<script setup>
import { LMap, LTileLayer, LGeoJson, LMarker } from "@vue-leaflet/vue-leaflet";
import { ref } from "vue";

var currentEstacion = ref("");

let zoom = ref(12);
let center = ref([41.3732, 2.154]);

var mapURL = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";

if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
    mapURL =
        "https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png";
}
</script>
<template>
    <div
        class="flex flex-col md:flex-row gap-4 m-8 h-[80vh] text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div
            class="w-full md:w-1/4 p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 v-if="currentEstacion == ''" class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">
                Elige un punto de carga
            </h5>
            <div v-else>
                <div v-if="currentEstacion.funciona === 1">
                    <div v-if="puntosOcupados && puntosOcupados.some(station => station.id === currentEstacion.id)">
                        <img src="img/puntoOcupado.png" alt="Punto de carga estado">
                    </div>
                    <div v-else>
                        <img src="img/puntoVacio.png" alt="Punto de carga estado">
                    </div>

                </div>
                <div v-else>
                    <img src="img/puntoError.png" alt="Punto de carga estado">
                </div>

                <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">
                    {{ currentEstacion.ubicacion }}
                </h5>

            </div>

            <p v-if="currentEstacion == ''" class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                Selecciona un punto de carga para ver su información actual
            </p>
            <p v-else class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                Pontencia: {{ currentEstacion.potencia }} kW
            </p>
        </div>

        <div class="flex-[1_1_50vh] md:w-3/4">
            <l-map ref="map" v-model:zoom="zoom" v-model:center="center" :useGlobalLeaflet="false">
                <l-tile-layer :url="mapURL" layer-type="base" name="Stadia Maps Basemap"></l-tile-layer>
                <l-marker v-for="punto in geojson?.features" :lat-lng="punto.geometry.coordinates.reverse()"
                    @click="currentEstacion = punto.properties"></l-marker>
            </l-map>
        </div>
    </div>
</template>
