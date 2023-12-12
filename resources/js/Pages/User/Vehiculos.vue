<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { Head } from '@inertiajs/vue3';

</script>
<template>
    <Head title="Mis Vehículos" />
    <DashboardLayout pagina-header="Mis Vehículos">
        <div class="bg-gray-200 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="flex flex-col gap-4 min-h-[20em]">

                    <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            Próximamente se podrá ver la información de tus vehiculos
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button"
                            class="text-white bg-blue-400 dark:bg-blue-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            disabled>Agregar vehículo</button>
                    </div>
                    <div class=" bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div role="status"
                            class="space-y-8 animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
                            <div
                                class="flex items-center justify-center w-full h-48 bg-gray-300 rounded sm:w-96 dark:bg-gray-700">
                                <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                                </svg>
                            </div>
                            <div class="w-full">
                                <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-72 mb-10"></div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[100px] mb-2.5"></div>
                                    <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[100px] mb-2.5"></div>
                                    <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[100px] mb-2.5"></div>
                                    <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[100px] mb-2.5"></div>
                                    <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[100px]"></div>
                                </div>
                            </div>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
