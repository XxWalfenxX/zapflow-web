<script setup>
import { onMounted, ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import { initFlowbite } from 'flowbite'
import { useForm } from '@inertiajs/vue3';
import { IconRefresh } from '@tabler/icons-vue';
import L from 'leaflet';
import VueTailwindDatepicker from "vue-tailwind-datepicker";


onMounted(() => {
    initFlowbite();
})

const form = useForm({
    latitud: '',
    longitud: '',
    ubicacion: '',
    potencia: '',
    funciona: false,
    ultimo_mantenimiento: ''
});

const submit = () => {
    form.ultimo_mantenimiento = dateValue.value[0]
    form.post(route('admin.puntosc.store'), {
        preserveScroll: true,
        onSuccess: () => window.location.reload(),
        onFinish: () => form.reset(),
    });
};

const resetForm = () => {
    form.reset()
    form.errors = {}
}


let map = ref(null);
let mapURL = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
let icono = L.icon({
            iconUrl: '/img/marker-icon.png',
            shadowUrl: '/img/marker-shadow.png',
        });
        


let marcador = null;
const createMaplayer = () => {
    setTimeout(() => {
        if (map.value == null) {
            map.value = L.map(`addNewPunto`).setView([41.3732, 2.154], 12);
            L.tileLayer(mapURL).addTo(map.value);


            map.value.on('click', function (e) {
                if (marcador) {
                    map.value.removeLayer(marcador);
                }
                form.latitud = e.latlng.lat
                form.longitud = e.latlng.lng
                marcador = new L.Marker([e.latlng.lat, e.latlng.lng], { draggable: true, icon: icono }).addTo(map.value)
                marcador.on('dragend', function (e) {
                    let position = marcador.getLatLng();
                    form.latitud = position.lat
                    form.longitud = position.lng
                })
            })
        }

    }, 0);

};
const dateValue = ref([]);
const formatter = ref({
    date: 'DD-MM-YYYY',
    month: 'MMM',
})


</script>

<template>
    <!-- Modal toggle -->
    <button type="button" data-modal-target="addUser" data-modal-toggle="addUser" @click="createMaplayer"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-3.5 h-3.5 me-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 1v16M1 9h16" />
        </svg>
        Añadir Punto de Carga
    </button>

    <!-- Main modal -->
    <div id="addUser" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-5xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Agregar Punto de Carga
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="addUser">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form @submit.prevent="submit">
                    <div class="flex gap-10 mb-4 justify-center">
                        <div id="addNewPunto" class="mapDisplay"></div>
                        <div class="grid gap-4 sm:grid-cols-2 place-self-center">
                            <div>
                                <label for="latitud"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Latitud</label>
                                <input type="number" name="latitud" id="latitud" v-model="form.latitud" step="any"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="41.42803856848066" required>
                            </div>
                            <div>
                                <label for="longitud"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Longitud</label>
                                <input type="number" name="longitud" id="longitud" v-model="form.longitud" step="any"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="2.171917146142346" required>
                            </div>
                            <div class="mb-2 sm:col-span-2">
                                <label for="ubicacion"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ubicación</label>
                                <input type="text" name="ubicacion" id="ubicacion" v-model="form.ubicacion"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="C. de Cartellà, 48, Nou Barris, 08031 Barcelona" required>
                            </div>
                            <div>
                                <label for="potencia"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Potencia</label>
                                <input type="number" name="potencia" id="potencia" v-model="form.potencia" step="0.1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="5.5" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de
                                    Mantenimiento</label>
                                <vue-tailwind-datepicker v-model="dateValue" i18n="es" :formatter="formatter"
                                    input-classes="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    as-single />
                            </div>

                            <div class="flex items-center">
                                <div class="flex items-center h-5">
                                    <input id="funciona" type="checkbox" value="" v-model="form.funciona"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                                </div>
                                <label for="funciona"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Funciona</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Agregar Punto de Carga
                    </button>
                    <button @click="resetForm"
                        class="text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2">
                        <IconRefresh class="mr-1 -ml-1 w-6 h-6" />
                        Limpiar
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
<style scoped>
.mapDisplay {
    width: 50%;
    height: 500px;
}
</style>
