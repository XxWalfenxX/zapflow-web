<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';
import DeleteCrudModal from '@/Components/Modal/DeleteCrudModal.vue';
import { initFlowbite, Modal } from 'flowbite'
import AddUserCrudModal from '@/Components/Modal/Users/AddUserCrudModal.vue';
import EditUserCrudModal from '@/Components/Modal/Users/EditUserCrudModal.vue';

onMounted(() => {
    initFlowbite();
})
DataTable.use(DataTablesCore);

defineProps({
    users: {
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
    <Head title="Gestión Usuarios" />

    <AuthenticatedLayout>
        <div class="py-12 flex-grow min-h-[80vh]">

            <div class="mx-auto sm:px-6 lg:px-8">
                <h1 class="font-bold text-4xl mb-3 dark:text-white">Gestionar Usuarios</h1>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-3">
                            <AddUserCrudModal />
                        </div>
                        <div class="relative overflow-x-auto">
                            <DataTable :options="options" class="display w-full">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Correo Electrónico</th>
                                        <th>Contraseña</th>
                                        <th>Fecha de creación</th>
                                        <th>Fecha última actualización</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users">
                                        <th>
                                            {{ user.id }}
                                        </th>
                                        <td>
                                            {{ user.name }}
                                        </td>
                                        <td>
                                            {{ user.email }}
                                        </td>
                                        <td>
                                            ●●●●●●●●●●●●●●●●
                                        </td>
                                        <td>
                                            {{ user.created_at }}
                                        </td>
                                        <td>
                                            {{ user.updated_at !== null ? user.updated_at : 'No hay datos' }}
                                        </td>
                                        <td>
                                            <EditUserCrudModal :key="`update-modal-${user.id}`" :id="`${user.id}`" :nombre="user.name" :email="user.email"/>
                                            <DeleteCrudModal :key="`delete-modal-${user.id}`" :id="`${user.id}`">
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

