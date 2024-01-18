<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted } from 'vue'
import { initFlowbite, Tabs } from 'flowbite'
import AdminButtonLink from '@/Components/AdminButtonLink.vue';

onMounted(() => {
    initFlowbite();
})


</script>

<template>
    <Head title="Panel de Administración" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Panel de Administración</h2>
        </template>

        <div class="py-12 flex-grow min-h-[80vh]">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex flex-col md:flex-row gap-4 m-8 min-h-[62vh] justify-center items-center">

                            <div class="md:flex">
                                <ul
                                    class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
                                    <li>
                                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                            Usuarios</h2>
                                    </li>
                                    <li>

                                        <AdminButtonLink :href="route('admin.users')"
                                            :active="route().current('admin.users')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4 me-2 text-gray-800 dark:text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>

                                            Lista
                                        </AdminButtonLink>

                                    </li>
                                    <li>
                                        <AdminButtonLink :href="route('admin.usersroles')" :active="false">
                                            <svg class="w-4 h-4 me-2 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                                <path
                                                    d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                                <path
                                                    d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                                            </svg>
                                            Roles
                                        </AdminButtonLink>
                                    </li>
                                    <li>
                                        <AdminButtonLink :href="route('admin.userssuscrip')" :active="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2 text-gray-800 dark:text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>


                                                Suscripciones
                                        </AdminButtonLink>
                                    </li>
                                    <li>
                                        <AdminButtonLink href="#" :active="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-4 h-4 me-2 text-gray-800 dark:text-white">
                                                <path fill-rule="evenodd"
                                                    d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Cargando Vehiculos
                                        </AdminButtonLink>
                                    </li>

                                </ul>
                                <ul
                                    class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
                                    <li>
                                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                            Puntos de Carga</h2>
                                    </li>
                                    <li>
                                        <AdminButtonLink :href="route('admin.puntosc')" :active="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4 me-2 text-gray-800 dark:text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                            Lista
                                        </AdminButtonLink>
                                    </li>
                                </ul>
                                <ul
                                    class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
                                    <li>
                                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                            Bonos</h2>
                                    </li>
                                    <li>
                                        <AdminButtonLink :href="route('admin.bonos')" :active="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4 me-2 text-gray-800 dark:text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                            Lista
                                        </AdminButtonLink>
                                    </li>
                                </ul>
                                <ul
                                    class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
                                    <li>
                                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                            Roles</h2>
                                    </li>
                                    <li>
                                        <AdminButtonLink :href="route('admin.roles')" :active="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4 me-2 text-gray-800 dark:text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                            Lista
                                        </AdminButtonLink>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</AuthenticatedLayout></template>

