<script setup>
import { Head } from '@inertiajs/vue3';
import { onBeforeUnmount, onMounted, ref } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';
import DeleteCrudModal from '@/Components/Modal/DeleteCrudModal.vue';
import { initFlowbite, Modal } from 'flowbite'
import AddUserCrudModal from '@/Components/Modal/Users/AddUserCrudModal.vue';
import EditUserCrudModal from '@/Components/Modal/Users/EditUserCrudModal.vue';
import 'leaflet/dist/leaflet.css';
import VerMapaPunto from '@/Components/Modal/PuntosCarga/VerMapaPunto.vue';


onMounted(() => {
    initFlowbite();
})

onBeforeUnmount(() => {
    if (map.value) {
        map.value.remove();
    }
});

DataTable.use(DataTablesCore);

defineProps({
    puntos_carga: {
        type: Object,
    },

});

const options = {
    responsive: true,
    language: {
        url: '/json/Datatable_es-ES.json'
    }
};


</script>

<template>
    <Head title="Gestión Puntos de carga" />

    <AuthenticatedLayout>
        <div class="py-12 flex-grow min-h-[80vh]">

            <div class="mx-auto sm:px-6 lg:px-8">
                <h1 class="font-bold text-4xl mb-3 dark:text-white">Gestionar Puntos de Carga</h1>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="mb-3">
                            <!--<AddUserCrudModal />-->
                        </div>

                        <div class="w-full">
                            <DataTable :options="options" class="display">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Latitiud</th>
                                        <th>Longitud</th>
                                        <th>Ubicación</th>
                                        <th>Potencia</th>
                                        <th>Funciona</th>
                                        <th>Ultimo Mantenimiento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="punto in puntos_carga" @click="showOnMap(punto)">
                                        <th>
                                            {{ punto.id }}
                                        </th>
                                        <td>
                                            {{ punto.latitud }}
                                        </td>
                                        <td>
                                            {{ punto.longitud }}
                                        </td>
                                        <td>
                                            {{ punto.ubicacion }}
                                        </td>
                                        <td>
                                            {{ punto.potencia }}
                                        </td>
                                        <td>
                                            <input type="checkbox" v-if="punto.funciona === 1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                checked disabled>
                                            <input type="checkbox" v-else
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                disabled>
                                        </td>
                                        <td>
                                            <p v-if="punto.ultimo_mantenimiento === null">No hay datos</p>
                                            <p v-else>{{ punto.ultimo_mantenimiento }}</p>
                                        </td>
                                        <td>
                                            <VerMapaPunto :punto="punto"/>
                                            <EditUserCrudModal />
                                            <DeleteCrudModal :key="`delete-modal-${punto.id}`" :id="`${punto.id}`">
                                            </DeleteCrudModal>
                                        </td>
                                    </tr>
                                </tbody>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
#mapWatchContainer {
    height: 500px;
    width: 500px;
}
</style>
