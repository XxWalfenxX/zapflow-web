<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';
import DeleteCrudModal from '@/Components/Modal/DeleteCrudModal.vue';
import { initFlowbite } from 'flowbite'
import AddPuntoCrudModal from '@/Components/Modal/PuntosCarga/AddPuntoCrudModal.vue'
import EditPuntoCrudModal from '@/Components/Modal/PuntosCarga/EditPuntoCrudModal.vue';
import 'leaflet/dist/leaflet.css';
import VerMapaPunto from '@/Components/Modal/PuntosCarga/VerMapaPunto.vue';


onMounted(() => {
    initFlowbite();
})

DataTable.use(DataTablesCore);

const props = defineProps({
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


const formatDate  = (dateString, index) => {
    const date = new Date(dateString);
    const day = date.getDate().toString().padStart(2, '0');;
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const year = date.getFullYear();
    props.puntos_carga[index].ultimo_mantenimiento = `${day}-${month}-${year}`

    return `${day}-${month}-${year}`;
  }

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
                            <AddPuntoCrudModal />
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
                                    <tr v-for="(punto, index) in puntos_carga">
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
                                            {{ punto.potencia }} kW
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
                                            <p v-else>{{ formatDate(punto.ultimo_mantenimiento, index)  }}</p>
                                        </td>
                                        <td>
                                            <VerMapaPunto :punto="punto"/>
                                            <EditPuntoCrudModal :punto="punto"/>
                                            <DeleteCrudModal :key="`delete-modal-${punto.id}`" :id="`${punto.id}`" url="admin.puntosc.destroy">
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
