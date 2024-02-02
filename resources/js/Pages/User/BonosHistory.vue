<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { Head, useForm } from '@inertiajs/vue3';
import { IconShoppingCartCheck, IconDownload } from "@tabler/icons-vue";
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

onMounted(() => {
    initFlowbite();
})

const props = defineProps({
    bonosComprados: {
        type: Array,
    },
});


const form = useForm({
    username: '',
    email: '',
    idfactura: '',
    bono: '',
    precio: '',
    fecha: ''
});

const submit = (username, email, idfactura, bono, precio, fecha) => {
    const data = {
        username: username,
        email: email,
        idfactura: idfactura,
        bono: bono,
        precio: precio,
        fecha: fecha
    };

    axios.post(route('pdf'), data, { responseType: 'blob' })
        .then(response => {
            const blob = new Blob([response.data], { type: 'application/pdf' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'factura.pdf';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.error('Error al generar el PDF:', error);
        });
};

const convertirFecha = (fecha) => {
    const date = new Date(fecha)
    return date.toLocaleDateString(undefined)
}


</script>

<template>
    <Head title="Historial de Compras" />

    <DashboardLayout pagina-header="Historial de Compras">
        <div class="bg-gray-200 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-2 m-5 text-gray-900 dark:text-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Lista de Bonos comprados</h5>
                </div>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-3 sm:py-4" v-for="(bono, index) in bonosComprados">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <IconShoppingCartCheck />
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ bono.nombre }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        Fecha de compra: {{ convertirFecha(bono.fecha_inicio) }}
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white mr-2">
                                    {{ bono.precio }}€
                                </div>
                                <button :data-tooltip-target="`tooltip-animation-${index}`"
                                    @click="submit($page.props.auth.user.name, $page.props.auth.user.email, `ZA-${$page.props.auth.user.id}${index}${bono.id}`, bono.nombre, bono.precio, bono.fecha_inicio)"
                                    class="text-gray-700 border border-gray-700 hover:bg-gray-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:border-gray-500 dark:text-gray-500 dark:hover:text-white dark:focus:ring-gray-800 dark:hover:bg-gray-500">
                                    <IconDownload />
                                    <span class="sr-only">Descargar Factura</span>
                                    <div :id="`tooltip-animation-${index}`" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Descargar Factura
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
