<script setup>
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Modal } from 'flowbite';
import { onMounted } from 'vue';
import { IconCircleX } from "@tabler/icons-vue";

const props = defineProps({
    bono: {
        type: Array,
    }
});


const form = useForm({
    idBono: '',
    idUser: '',
});

const user = usePage().props.auth.user;
let targetEl
// set the modal menu element
onMounted(() => {
    targetEl = document.getElementById('modalEl');
    // Ahora $targetEl contiene el elemento modal y puedes usarlo según sea necesario
});

// options with default values
const options = {
    backdrop: 'dynamic',
    backdropClasses:
        'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
    closable: true,
};

// instance options object
const instanceOptions = {
    id: 'modalEl',
    override: true
};

let modal

const submit = () => {
    form.idBono = props.bono[0].id
    form.idUser = user.id
    form.post(route('user.payment.store'), {
        preserveScroll: true,
        onSuccess: () => window.location.reload(),
        onFinish: () => form.reset(),
        onError: () => {
            modal = new Modal(targetEl, options, instanceOptions);
            modal.show();
        }
    });
};


</script>
<template>
    <Head :title="`Comprar ` + props.bono[0].nombre" />

    <AuthenticatedLayout>
        <div class="py-12 flex-grow min-h-[80vh]">

            <div class="mx-auto sm:px-6 lg:px-8">
                <h1 class="font-bold text-4xl mb-3 dark:text-white">Comprar {{ bono[0].nombre }}</h1>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="relative overflow-x-auto">
                            <div class="flex justify-center m-32">
                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                    <div class="mb-2 sm:col-span-2 border-b">
                                        <div class="flex gap-2 mb-4 border-b justify-between text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="150" viewBox="0 0 338.667 89.785"
                                                class="mb-2" xmlns:v="https://vecta.io/nano">
                                                <g transform="translate(936.898 -21.779)">
                                                    <path clip-path="none"
                                                        d="M-828.604 39.734c-.697 0-1.289.506-1.398 1.195l-8.068 51.165a1.31 1.31 0 0 0 1.294 1.513h9.568c.696 0 1.289-.507 1.398-1.195l2.37-15.025c.108-.688.701-1.195 1.398-1.195h8.699c10.164 0 18.792-7.416 20.368-17.465 1.589-10.134-6.328-18.971-17.549-18.993zm9.301 11.422h6.96c5.73 0 7.596 3.381 7.006 7.12-.59 3.747-3.488 6.507-9.031 6.507h-7.084zm45.788 3.478c-2.416.009-5.196.504-8.317 1.804-7.159 2.984-10.597 9.151-12.057 13.647 0 0-4.647 13.717 5.852 21.253 0 0 9.737 7.255 20.698-.447l-.189 1.203a1.31 1.31 0 0 0 1.292 1.513h9.083c.697 0 1.289-.507 1.398-1.195l5.525-35.038a1.31 1.31 0 0 0-1.292-1.515h-9.083c-.697 0-1.29.507-1.398 1.195l-.297 1.886s-3.967-4.333-11.216-4.306zm.297 11.067c1.043 0 1.997.144 2.853.419 3.919 1.258 6.141 5.023 5.498 9.104-.793 5.025-4.914 8.725-10.199 8.725-1.042 0-1.996-.143-2.853-.418-3.918-1.258-6.154-5.023-5.511-9.104.793-5.025 4.927-8.727 10.212-8.727z"
                                                        fill="#003087" />
                                                    <path clip-path="none"
                                                        d="M-697.804 39.734c-.697 0-1.289.506-1.398 1.195l-8.068 51.165a1.31 1.31 0 0 0 1.294 1.513h9.568c.696 0 1.289-.507 1.398-1.195l2.37-15.025c.108-.688.701-1.195 1.398-1.195h8.699c10.164 0 18.791-7.416 20.366-17.465 1.59-10.134-6.326-18.971-17.547-18.993zm9.301 11.422h6.96c5.73 0 7.596 3.381 7.006 7.12-.59 3.747-3.487 6.507-9.031 6.507h-7.084zm45.787 3.478c-2.416.009-5.196.504-8.317 1.804-7.159 2.984-10.597 9.151-12.057 13.647 0 0-4.645 13.717 5.854 21.253 0 0 9.735 7.255 20.697-.447l-.189 1.203a1.31 1.31 0 0 0 1.294 1.513h9.082c.697 0 1.289-.507 1.398-1.195l5.527-35.038a1.31 1.31 0 0 0-1.294-1.515h-9.083c-.697 0-1.29.507-1.398 1.195l-.297 1.886s-3.967-4.333-11.216-4.306zm.297 11.067c1.043 0 1.997.144 2.853.419 3.919 1.258 6.141 5.023 5.498 9.104-.793 5.025-4.914 8.725-10.199 8.725-1.042 0-1.996-.143-2.853-.418-3.918-1.258-6.154-5.023-5.511-9.104.793-5.025 4.927-8.727 10.212-8.727z"
                                                        fill="#0070e0" />
                                                    <path clip-path="none"
                                                        d="M-745.92 55.859c-.72 0-1.232.703-1.012 1.388l9.958 30.901-9.004 14.562c-.437.707.071 1.62.902 1.62h10.642a1.77 1.77 0 0 0 1.513-.854l27.811-46.007c.427-.707-.083-1.611-.909-1.611h-10.641a1.77 1.77 0 0 0-1.522.869l-10.947 18.482-5.557-18.345c-.181-.597-.732-1.006-1.355-1.006z"
                                                        fill="#003087" />
                                                    <path clip-path="none"
                                                        d="M-609.107 39.734c-.696 0-1.289.507-1.398 1.195l-8.07 51.163a1.31 1.31 0 0 0 1.294 1.515h9.568c.696 0 1.289-.507 1.398-1.195l8.068-51.165a1.31 1.31 0 0 0-1.292-1.513z"
                                                        fill="#0070e0" />
                                                    <path clip-path="none"
                                                        d="M-908.37 39.734a2.59 2.59 0 0 0-2.556 2.185l-4.247 26.936c.198-1.258 1.282-2.185 2.556-2.185h12.445c12.525 0 23.153-9.137 25.095-21.519a20.76 20.76 0 0 0 .245-2.793c-3.183-1.669-6.922-2.624-11.019-2.624z"
                                                        fill="#001c64" />
                                                    <path clip-path="none"
                                                        d="M-874.832 42.359a20.76 20.76 0 0 1-.245 2.793c-1.942 12.382-12.571 21.519-25.095 21.519h-12.445c-1.273 0-2.358.926-2.556 2.185l-3.905 24.752-2.446 15.528a2.1 2.1 0 0 0 2.075 2.43h13.508a2.59 2.59 0 0 0 2.556-2.185l3.558-22.567a2.59 2.59 0 0 1 2.558-2.185h7.953c12.525 0 23.153-9.137 25.095-21.519 1.379-8.788-3.047-16.784-10.611-20.75z"
                                                        fill="#0070e0" />
                                                    <path clip-path="none"
                                                        d="M-923.716 21.779c-1.273 0-2.358.926-2.556 2.183l-10.6 67.216c-.201 1.276.785 2.43 2.077 2.43h15.719l3.903-24.752 4.247-26.936a2.59 2.59 0 0 1 2.556-2.185h22.519c4.098 0 7.836.956 11.019 2.624.218-11.273-9.084-20.58-21.873-20.58z"
                                                        fill="#003087" />
                                                </g>
                                            </svg>
                                            <span class="text-center font-bold">{{ bono[0].precio }}€</span>
                                        </div>

                                        <span class="text-xl font-semibold">{{ $page.props.auth.user.name }}</span>
                                        <address class="mb-4">Carrer de l'Esglesia, 9 - Cerdanyola del Valles, Barcelona
                                            08920</address>
                                    </div>
                                    <div class="mb-2 sm:col-span-2">
                                        <h2 class="text-2xl font-semibold">Pagar con</h2>
                                        <div class="flex justify-between">
                                            <div class="flex gap-2 text-center items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                                    viewBox="0 0 141.732 141.732">
                                                    <g fill="#2566af">
                                                        <path
                                                            d="M62.935 89.571h-9.733l6.083-37.384h9.734zM45.014 52.187L35.735 77.9l-1.098-5.537.001.002-3.275-16.812s-.396-3.366-4.617-3.366h-15.34l-.18.633s4.691.976 10.181 4.273l8.456 32.479h10.141l15.485-37.385H45.014zM121.569 89.571h8.937l-7.792-37.385h-7.824c-3.613 0-4.493 2.786-4.493 2.786L95.881 89.571h10.146l2.029-5.553h12.373l1.14 5.553zm-10.71-13.224l5.114-13.99 2.877 13.99h-7.991zM96.642 61.177l1.389-8.028s-4.286-1.63-8.754-1.63c-4.83 0-16.3 2.111-16.3 12.376 0 9.658 13.462 9.778 13.462 14.851s-12.075 4.164-16.06.965l-1.447 8.394s4.346 2.111 10.986 2.111c6.642 0 16.662-3.439 16.662-12.799 0-9.72-13.583-10.625-13.583-14.851.001-4.227 9.48-3.684 13.645-1.389z" />
                                                    </g>
                                                    <path
                                                        d="M34.638 72.364l-3.275-16.812s-.396-3.366-4.617-3.366h-15.34l-.18.633s7.373 1.528 14.445 7.253c6.762 5.472 8.967 12.292 8.967 12.292z"
                                                        fill="#e6a540" />
                                                    <path fill="none" d="M0 0h141.732v141.732H0z" />
                                                </svg>
                                                <span>Visa x-2454</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span>{{ bono[0].precio }}€</span>
                                                <span class="font-thin text-gray-500 text-xs">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 sm:col-span-2">
                                        <button @click="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                                            Pagar Ahora
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="modalEl" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <a type="button" :href="route('bonos')"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </a>
                    <div class="p-4 md:p-5 text-center">
                        <IconCircleX class="mx-auto mb-4 text-red-600 w-32 h-32" />
                        <h3 class="mb-5 text-3xl font-bold">Error</h3>
                        <h4 class="mb-5 text-normal font-normal text-gray-500 dark:text-gray-400">El bono solicitado sigue
                            vigente</h4>
                        <a type="button" :href="route('bonos')"
                            class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            OK
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
