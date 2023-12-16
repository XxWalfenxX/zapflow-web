<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { Head } from '@inertiajs/vue3';
import { IconShoppingCartCheck } from "@tabler/icons-vue";
const props = defineProps({
    bonosComprados: {
        type: Array,
    },
});

const convertirFecha = (fecha) => {
    const date = new Date(fecha)
    return date.toLocaleDateString(undefined)
}


</script>

<template>
    <Head title="HIstorial de Compras" />

    <DashboardLayout pagina-header="Historial de Compras">
        <div class="bg-gray-200 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-2 m-5 text-gray-900 dark:text-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Lista de Bonos comprados</h5>
                </div>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700" >
                        <li class="py-3 sm:py-4" v-for="bono in bonosComprados">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <IconShoppingCartCheck/>
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ bono.nombre }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        Fecha de compra: {{ convertirFecha(bono.fecha_inicio) }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{ bono.precio }}€
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
