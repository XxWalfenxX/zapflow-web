<script setup>
import { onMounted } from 'vue';
import InputError from '@/Components/InputError.vue';
import { initFlowbite } from 'flowbite'
import { useForm } from '@inertiajs/vue3';
import { IconRefresh } from '@tabler/icons-vue';

onMounted(() => {
    initFlowbite();
})

const form = useForm({
    idUser: '',
    idBono: '',
});

const submit = () => {
    form.post(route('admin.userscarveh.store'), {
        preserveScroll: true,
        onSuccess: () => window.location.reload(),
        onFinish: () => form.reset(),
    });
};

const props = defineProps({
    bonosAvail: {
        type: Array,
    },
    usersAvail: {
        type: Array,
    },

});

const resetForm = () => {
    form.reset()
    form.errors = {}
}


</script>

<template>
    <!-- Modal toggle -->
    <button type="button" data-modal-target="addRol" data-modal-toggle="addRol"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-3.5 h-3.5 me-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 1v16M1 9h16" />
        </svg>
        Agregar bono a usuario
    </button>

    <!-- Main modal -->
    <div id="addRol" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Agregar Bonos
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="addRol">
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
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="user"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuario</label>
                            <select id="user" v-model="form.idUser"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="user in usersAvail" :value="user.id">{{ user.email }}</option>
                            </select>

                        </div>
                        <div>
                            <label for="bono"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bono</label>
                            <select id="bono" v-model="form.idBono"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="bono in bonosAvail" :value="bono.id">{{ bono.ubicacion }}</option>
                            </select>
                        </div>

                    </div>
                    <InputError class="my-2" :message="form.errors[0]" />
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Agregar Bono
                    </button>
                    <button @click="resetForm" type="button"
                        class="text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2">
                        <IconRefresh class="mr-1 -ml-1 w-6 h-6" />
                        Limpiar
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
.bg-gray-900.bg-opacity-50.dark\:bg-opacity-80.fixed.inset-0.z-40 {
    opacity: 0.2;
}
</style>
