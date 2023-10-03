<script setup>
import { Link } from "@inertiajs/vue3";
import NavLinkGuest from "@/Components/NavLinkGuest.vue";
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },

    propUser: {
        type: Object,
    },
});
</script>

<template>
    <div
        class="min-h-screen flex flex-col dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div
                class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"
            >
                <a href="#" class="flex items-center">
                    <img
                        src="img/logo.png"
                        class="h-10 mr-3"
                        alt="ZapFlow Logo"
                    />
                    <span
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"
                        >ZapFlow</span
                    >
                </a>
                <div class="flex md:order-2">
                    <div v-if="canLogin">
                        <Link
                            v-if="propUser"
                            :href="route('dashboard')"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            Ir a tu cuenta
                        </Link>
                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                >Iniciar Sesión</Link
                            >
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 text-sm px-4 py-2 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                                >Registrarse</Link
                            >
                        </template>
                    </div>

                    <button
                        data-collapse-toggle="navbar-cta"
                        type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-cta"
                        aria-expanded="false"
                    >
                        <span class="sr-only">Open main menu</span>
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 17 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15"
                            />
                        </svg>
                    </button>
                </div>
                <div
                    class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                    id="navbar-cta"
                >
                    <ul
                        class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
                    >
                        <li>
                            <NavLinkGuest
                                :href="route('Inicio')"
                                :active="route().current('Inicio')"
                            >
                                Inicio
                            </NavLinkGuest>
                        </li>
                        <li>
                            <NavLinkGuest
                                :href="route('about')"
                                :active="route().current('about')"
                            >
                                Sobre Nosotros
                            </NavLinkGuest>
                        </li>
                        <li>
                            <NavLinkGuest
                                :href="route('bonos')"
                                :active="route().current('bonos')"
                            >
                                Bonos
                            </NavLinkGuest>
                        </li>
                        <li>
                            <NavLinkGuest
                                :href="route('contacto')"
                                :active="route().current('contacto')"
                            >
                                Contacto
                            </NavLinkGuest>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="mb-auto">
            <slot />
        </main>

        <footer class="bg-white rounded-lg shadow m-4 dark:bg-gray-800">
            <div
                class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between"
            >
                <span
                    class="text-sm text-gray-500 sm:text-center dark:text-gray-400"
                    >© 2023
                    <a href="https://flowbite.com/" class="hover:underline"
                        >ZapFlow™</a
                    >. Todos los derechos reservados.
                </span>
                <ul
                    class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0"
                >
                    <li>
                        <Link
                            :href="route('about')"
                            class="mr-4 hover:underline md:mr-6"
                            >Sobre Nosotros</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('Inicio')"
                            class="mr-4 hover:underline md:mr-6"
                            >Politica de Privacidad</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('contacto')"
                            class="mr-4 hover:underline md:mr-6"
                            >Contacto</Link
                        >
                    </li>
                </ul>
            </div>
        </footer>
    </div>
</template>
