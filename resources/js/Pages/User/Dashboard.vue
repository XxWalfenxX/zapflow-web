<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { Head, Link } from '@inertiajs/vue3';


const props = defineProps({
    bonoInfo: {
        type: Object,
    },

});


let fechaFormateada = '';
let porcentajeBarra = 'width: 0%';

if (props.bonoInfo.length !== 0 && props.bonoInfo[0].fecha_fin !== undefined) {
    const fecha_fin = new Date(props.bonoInfo[0].fecha_fin);

    // Obtener la fecha actual
    const fecha_actual = new Date();

    // Calcular la diferencia en milisegundos
    const diferencia_ms = fecha_fin - fecha_actual;

    // Calcular la diferencia en días
    const diferencia_dias = Math.ceil(diferencia_ms / (1000 * 60 * 60 * 24));

    // Definir el límite de dias para el porcentaje (por ejemplo, 366 = 100%)
    const limite_superior = 366;

    // Ajustar el porcentaje según la diferencia de días
    const porcentaje = Math.max(0, Math.min((diferencia_dias / limite_superior) * 100, 100));

    // Actualizar la variable porcentajeBarra
    porcentajeBarra = `width: ${porcentaje}%`;

    // Formatear la fecha
    const date_options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    };
    fechaFormateada = fecha_fin.toLocaleDateString(undefined, date_options);
}




</script>

<template>
    <Head title="Dashboard" />

    <DashboardLayout pagina-header="Inicio">
        <div class="bg-gray-200 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-5xl">Hola, {{ $page.props.auth.user.name }}</h2>
                <div class="flex flex-row gap-4 min-h-[20em] mt-10">
                    <div class="flex items-center justify-center w-full">

                        <div
                            class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] h-[600px] w-[300px] shadow-xl">
                            <div
                                class="w-[148px] h-[18px] bg-gray-800 top-0 rounded-b-[1rem] left-1/2 -translate-x-1/2 absolute">
                            </div>
                            <div class="h-[46px] w-[3px] bg-gray-800 absolute -start-[17px] top-[124px] rounded-s-lg"></div>
                            <div class="h-[46px] w-[3px] bg-gray-800 absolute -start-[17px] top-[178px] rounded-s-lg"></div>
                            <div class="h-[64px] w-[3px] bg-gray-800 absolute -end-[17px] top-[142px] rounded-e-lg"></div>
                            <div class="rounded-[2rem] overflow-hidden w-[272px] h-[572px] bg-white dark:bg-gray-500">
                                <div class="flex h-[572px] m-4">
                                    <img src="/img/zcard.png" alt="Z-Card" class="object-contain">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" flex items-center justify-center w-full">
                        <div
                            class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700  w-3/4 h-1/2 flex flex-col justify-around">

                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{
                                bonoInfo.length > 0 ? (bonoInfo[0].nombre === undefined ? 'No tienes suscripción activa' :
                                    bonoInfo[0].nombre) : 'No tienes suscripción activa' }}
                            </h5>

                            <div v-if="fechaFormateada === undefined">
                                <p class="dark:text-white">No tienes subscripción o ha caducado</p>
                            </div>
                            <div v-else>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Fecha de caducidad: {{
                                    fechaFormateada }}</p>

                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2.5 rounded-full" :style="porcentajeBarra"></div>
                                </div>
                            </div>


                            <div class="flex items-end">
                                <Link :href="route('user.bonos')"
                                    class="justify-center w-full  mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Mis Bonos
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </Link>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
