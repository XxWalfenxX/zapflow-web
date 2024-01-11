<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';
import DeleteCrudModal from '@/Components/Modal/DeleteCrudModal.vue';
import { initFlowbite } from 'flowbite'
import AdminBonos from '@/Components/Modal/Bonos/AddBonos.vue';
import EditBonosModal from '@/Components/Modal/Bonos/EditBonosModal.vue';

onMounted(() => {
    initFlowbite();
})
DataTable.use(DataTablesCore);

const props = defineProps({
    bonos: {
        type: Object,
    },

});

const options = {
    responsive: true,
    language: {
        url: '/json/Datatable_es-ES.json'
    }
};

props.bonos?.map((bono) => {
    bono.descripcion = bono.descripcion.replaceAll('/', ', ');
})

</script>

<template>
    <Head title="Gestión Bonos" />

    <AuthenticatedLayout>
        <div class="py-12 flex-grow min-h-[80vh]">

            <div class="mx-auto sm:px-6 lg:px-8">
                <h1 class="font-bold text-4xl mb-3 dark:text-white">Gestionar Bonos</h1>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-3">
                            <AdminBonos />
                        </div>
                        <div class="relative overflow-x-auto">
                            <DataTable :options="options" class="display w-full">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="bono in bonos">
                                        <th>
                                            {{ bono.id }}
                                        </th>
                                        <td>
                                            {{ bono.nombre }}
                                        </td>
                                        <td>
                                            {{ bono.descripcion }}
                                        </td>
                                        <td>
                                            {{ bono.precio }}€
                                        </td>
                                        <td>
                                            <EditBonosModal :bono="bono"/>
                                            <DeleteCrudModal :key="`delete-modal-${bono.id}`" :id="`${bono.id}`" url="admin.bonos.destroy">
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

