<script setup>
import { onMounted, onBeforeUnmount, ref } from 'vue';
import { initFlowbite } from 'flowbite'
import { IconEye } from "@tabler/icons-vue";
import L from 'leaflet';


onMounted(() => {
    initFlowbite();
})

onBeforeUnmount(() => {
    if (map.value) {
        map.value.remove();
    }
});

const props = defineProps({
    punto: {
        type: Object,
    },

});

let map = ref(null);
let mapURL = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
let icono = L.icon({
            iconUrl: '/img/marker-icon.png',
            shadowUrl: '/img/marker-shadow.png',
        });


const createMaplayer = () => {
    setTimeout(() => {
        map.value = L.map(`mapWatchContainer-${props.punto.id}`).setView([props.punto.latitud, props.punto.longitud], 18);
        L.tileLayer(mapURL).addTo(map.value);
        L.marker([props.punto.latitud, props.punto.longitud], {icon: icono}).addTo(map.value);
    }, 0);

};


</script>

<template>
    <button type="button" :data-modal-target="`mapa-modal-${punto.id}`" :data-modal-toggle="`mapa-modal-${punto.id}`"
        @click="createMaplayer"
        class="focus:outline-none text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-green-900">
        <IconEye class="w-6 h-6 text-white" />
    </button>

    <div :id="`mapa-modal-${punto.id}`" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{punto.ubicacion}}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        :data-modal-hide="`mapa-modal-${punto.id}`">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div :id="`mapWatchContainer-${punto.id}`" class="mapDisplay"></div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button :data-modal-hide="`mapa-modal-${punto.id}`" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.mapDisplay {
    width: 100%;
    height: 500px
}
</style>
