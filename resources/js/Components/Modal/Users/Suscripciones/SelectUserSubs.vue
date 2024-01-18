<script setup>
import { onMounted, ref, computed, watch } from 'vue';
import { initFlowbite } from 'flowbite'
import { useForm } from '@inertiajs/vue3';
import { IconEdit } from '@tabler/icons-vue';

onMounted(() => {
    initFlowbite();
    additionalBonos.value.push('');
    form.id_user = props.user.id_user
    additionalBonos.value = props.user.bonos
})

const form = useForm({
    id_user: '',
    id_bonos: []
});

const props = defineProps(['user', 'roles'])

const submit = () => {

    form.id_bonos = availableBonos.value.filter(bono => bono.checked).map(bono => bono.id);

    form.patch(route('admin.userssuscrip.update'), {
        preserveScroll: true,
        onSuccess: () => window.location.reload(),
        onFinish: () => form.reset(),
    });
};


const additionalBonos = ref([]);


const availableBonos = computed(() => {
    return props.roles.map(bono => ({
        ...bono,
        checked: bono.id === 0 || additionalBonos.value.some(userBono => userBono.id_roles === bono.id),
    })).filter(bono => {
        const isNotAssigned = !props.user.bonos.some(userBono => userBono.id_roles === bono.id);

        return isNotAssigned || bono.checked;
    });
});

</script>

<template>
    <!-- Modal toggle -->
    <button :data-dropdown-toggle="`dropdownSearch-${props.user.id_user}`" data-dropdown-placement="bottom"
        class="mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Editar Bonos
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
        </svg>
    </button>

    <div :id="`dropdownSearch-${props.user.id_user}`" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
        <ul class=" pt-3 h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownSearchButton">
            <li v-for="bono in availableBonos" :key="bono.id">
                <div class="flex items-center ps-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <input :id="'checkbox-item-' + bono.id+props.user.id_user" type="checkbox" v-model="bono.checked" :disabled="bono.disabled"
                        :class="{ 'text-gray-500 cursor-not-allowed': bono.disabled }"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                    <label :for="'checkbox-item-' + bono.id+props.user.id_user" :class="{ 'text-gray-500 cursor-not-allowed': bono.disabled }"
                        class="w-full py-2 ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                        {{ bono.nombre }}
                    </label>
                </div>
            </li>
        </ul>
        <a @click="submit"
            class="cursor-pointer flex items-center p-3 text-sm font-medium border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600">
            <IconEdit class="mr-1 ml-1 w-6 h-6" />
            Actualizar Bonos
        </a>


    </div>
</template>
