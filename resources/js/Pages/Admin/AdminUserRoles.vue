<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';
import { initFlowbite } from 'flowbite'
import SelectUserRoles from '@/Components/Modal/Users/Roles/SelectUserRoles.vue';

onMounted(() => {
    initFlowbite();
})
DataTable.use(DataTablesCore);

const props = defineProps({
    userRoles: {
        type: Object,
    },
    roles: {
        type: Array,
    },

});

const options = {
    responsive: true,
    language: {
        url: '/json/Datatable_es-ES.json'
    },
};

// Función para agrupar por id de usuario con información de roles
function groupByIdUser(data) {
  const groupedData = {};

  data.forEach(item => {
    const idUser = item.id_user;
    const email = item.email;

    if (!groupedData[idUser]) {
      groupedData[idUser] = { id_user: idUser, email: email, roles: [] };
    }

    if (!groupedData[idUser].email.includes(email)) {
      groupedData[idUser].email += `, ${email}`;
    }

    const role = { id_roles: item.id_roles, nombre: item.nombre };
    groupedData[idUser].roles.push(role);
  });

  return Object.values(groupedData);
}

const userRolesSorted = groupByIdUser(props.userRoles);
console.log(userRolesSorted);
console.log(props.roles);
</script>

<template>
    <Head title="Gestión Usuarios" />

    <AuthenticatedLayout>
        <div class="py-12 flex-grow min-h-[80vh]">

            <div class="mx-auto sm:px-6 lg:px-8">
                <h1 class="font-bold text-4xl mb-3 dark:text-white">Gestionar Roles Usuarios</h1>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="relative overflow-x-auto">
                            <DataTable :options="options" class="display w-full">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in userRolesSorted">
                                        <th>
                                            {{ user.email }}
                                        </th>
                                        <td>
                                            <span v-for="roles in user.roles" class="text-xs font-medium me-2 px-2.5 py-1.5 rounded-full bg-blue-500 text-blue-100">{{ roles.nombre }}</span>
                                        </td>
                                        <td>
                                            <SelectUserRoles :user="user" :roles="roles"/>
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

