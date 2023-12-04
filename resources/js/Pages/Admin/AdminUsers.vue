<script setup>
import { Head } from '@inertiajs/vue3';

import AdminDashboard from '../../Layouts/AdminDashboard.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);


defineProps({
    users: {
        type: Object,
    },

});

const data = [
    [1, 2],
    [3, 4],
];

</script>

<template>
    <Head title="Gestión Usuarios" />

    <AdminDashboard>
        <h1 class="font-bold text-4xl mb-3">Gestionar Usuarios</h1>

        <DataTable :data="data" class="display">
            <thead>
                <tr>
                    <th>A</th>
                    <th>B</th>
                </tr>
            </thead>
        </DataTable>


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Contraseña
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de creación
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de actualización
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ user.id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ user.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.password }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.created_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.updated_at !== null ? user.updated_at : 'No hay datos' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminDashboard>
</template>
<style>
@import 'datatables.net-dt';
</style>
