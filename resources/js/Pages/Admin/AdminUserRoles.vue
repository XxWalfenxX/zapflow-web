<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';
import DeleteCrudModal from '@/Components/Modal/DeleteCrudModal.vue';
import { initFlowbite } from 'flowbite'
import AddRolCrudModal from '@/Components/Modal/Roles/AddRolCrudModal.vue';
import EditRolCrudModal from '@/Components/Modal/Roles/EditRolCrudModal.vue';

onMounted(() => {
    initFlowbite();
})
DataTable.use(DataTablesCore);

defineProps({
    userRoles: {
        type: Object,
    },

});

const options = {
    responsive: true,
    language: {
        url: '/json/Datatable_es-ES.json'
    },
};

</script>

<template>
    <Head title="Gestión Usuarios" />

    <AuthenticatedLayout>
        <div class="py-12 flex-grow min-h-[80vh]">

            <div class="mx-auto sm:px-6 lg:px-8">
                <h1 class="font-bold text-4xl mb-3 dark:text-white">Gestionar Roles Usuarios</h1>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-3">
                            <AddRolCrudModal />
                        </div>
                        <div class="relative overflow-x-auto">
                            <DataTable :options="options" class="display w-full">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Nombre de Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="rol in userRoles">
                                        <th>
                                            {{ rol.email }}
                                        </th>
                                        <td>
                                            {{ rol.nombre }}
                                        </td>
                                        <td>
                                            <DeleteCrudModal :key="`delete-modal-${rol.id}`" :id="`${rol.id}`" url="admin.roles.destroy" :disabled="rol.nombre == 'user'">
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

