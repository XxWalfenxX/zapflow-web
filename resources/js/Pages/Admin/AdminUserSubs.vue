<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';
import { initFlowbite } from 'flowbite'
import SelectUserSubs from '@/Components/Modal/Users/Suscripciones/SelectUserSubs.vue';
import AddUsersSubsModal from '@/Components/Modal/Users/Suscripciones/AddUsersSubsModal.vue';

onMounted(() => {
    initFlowbite();
})
DataTable.use(DataTablesCore);

const props = defineProps({
    userSubs: {
        type: Object,
    },
    bonosAvail: {
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
      groupedData[idUser] = { id_user: idUser, email: email, bonos: [] };
    }

    if (!groupedData[idUser].email.includes(email)) {
      groupedData[idUser].email += `, ${email}`;
    }

    const role = { id_roles: item.id_subscripciones, nombre: item.nombre };
    groupedData[idUser].bonos.push(role);
  });

  return Object.values(groupedData);
}

const userBonosSorted = groupByIdUser(props.userSubs);
</script>

<template>
    <Head title="Gestión Suscripciones" />

    <AuthenticatedLayout>
        <div class="py-12 flex-grow min-h-[80vh]">

            <div class="mx-auto sm:px-6 lg:px-8">
                <h1 class="font-bold text-4xl mb-3 dark:text-white">Gestionar Bonos Usuarios</h1>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-3">
                            <AddUsersSubsModal />
                        </div>
                        <div class="relative overflow-x-auto">
                            <DataTable :options="options" class="display w-full">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Bonos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in userBonosSorted">
                                        <th>
                                            {{ user.email }}
                                        </th>
                                        <td>
                                            <span v-for="bono in user.bonos" class="text-xs font-medium me-2 px-2.5 py-1.5 rounded-full bg-blue-500 text-blue-100">{{ bono.nombre }}</span>
                                        </td>
                                        <td>
                                            <SelectUserSubs :user="user" :roles="bonosAvail"/>
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

