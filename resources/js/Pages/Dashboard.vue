<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <DashboardLayout pagina-header="Inicio">
        <div class="bg-gray-200 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-5xl">Hola, {{ $page.props.auth.user.name }}</h2>
                <div class="flex flex-row gap-4 justify-between min-h-[20em]">
                    <div class="flex items-center">
                        <img src="/img/zcard.png" alt="Z-Card">
                    </div>
                    <div class=" flex items-center w-1/2">
                        <div
                            class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700  w-3/4 h-3/4 flex flex-col justify-around">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">BONO_ACTUAL
                                </h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Fecha de caducidad:</p>

                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                            </div>
                            <div class="flex items-end">
                                <a href="#"
                                    class="justify-center w-full  mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Bonos disponibles
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
