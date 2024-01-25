<script>
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'
import { ref, reactive, onMounted, onBeforeUnmount } from "vue";

export default {
    setup() {
        let map = ref(null);
        let mapURL = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        let icono = L.icon({
            iconUrl: '/img/marker-icon.png',
            shadowUrl: '/img/marker-shadow.png',
        });
        const currentEstacion = ref(null);



        const createMaplayer = () => {
            map.value = L.map('mapContainer').setView([41.3732, 2.154], 12);
            L.tileLayer(mapURL).addTo(map.value);

            if (state.listaPuntos.length > 0) {
                state.listaPuntos.forEach((feature) => {
                    const coordinates = feature.geometry.coordinates.reverse();
                    const marker = L.marker(coordinates, {icon: icono})
                        .addTo(map.value)
                        .on('click', () => {
                            currentEstacion.value = feature;
                        });
                });
            } else {
                console.error('No points to display on the map.');
            }
        };

        const state = reactive({
            listaPuntos: [],
            listaPuntosOcupados: [],
        });

        const obtenerPuntos = async () => {
            try {
                const response = await fetch('/api/map');
                const data = await response.json();
                //console.log('Data MAP from API:', data);

                if (Array.isArray(data.features)) {
                    return data.features;
                } else {
                    console.error('Invalid MAP data format:', data);
                    return [];
                }
            } catch (error) {
                console.error('Error fetching data:', error);
                return [];
            }
        };

        const obtenerPuntosOcupados = async () => {
            try {
                const response = await fetch('/api/map/ocupado');
                const data = await response.json();
                //console.log('Data OCUPADO from API:', data);
                if (Array.isArray(data)) {
                    return data;
                } else {
                    console.error('Invalid OCUPADO data format:', data);
                    return [];
                }
            } catch (error) {
                console.error('Error fetching data:', error);
                return [];
            }
        }

        onMounted(() => {
            obtenerPuntos().then((punto) => {
                state.listaPuntos = punto;
                obtenerPuntosOcupados().then((puntoOcupado) => {
                    state.listaPuntosOcupados = puntoOcupado
                    createMaplayer();
                })

            });
        });

        onBeforeUnmount(() => {
            if (map.value) {
                map.value.remove();
            }
        });

        return {
            state,
            currentEstacion,
        };
    },
};
</script>
<template>
    <div
        class="flex flex-col md:flex-row gap-4 m-8 h-[80vh] text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div
            class="w-full md:w-1/4 p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

            <h5 v-if="currentEstacion == null" class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">
                Elige un punto de carga
            </h5>
            <div v-else>
                <div v-if="currentEstacion.properties.funciona === 1">
                    <div
                        v-if="state.listaPuntosOcupados && state.listaPuntosOcupados.some(station => station.id === currentEstacion.properties.id)">
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
                    {{ currentEstacion.properties.ubicacion }}
                </h5>

            </div>

            <p v-if="currentEstacion == null" class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                Selecciona un punto de carga para ver su información actual
            </p>
            <p v-else class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                Pontencia: {{ currentEstacion.properties.potencia }} kW
            </p>
        </div>

        <div class="flex-[1_1_50vh] md:w-3/4">
            <div id="mapContainer"></div>
        </div>
    </div>
</template>
<style scoped>
#mapContainer {
    width: 100%;
    height: 100%;
}
</style>
