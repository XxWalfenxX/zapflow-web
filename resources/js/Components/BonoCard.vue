

<script setup>
import { CheckIcon } from "@heroicons/vue/20/solid";

defineProps({
    nombre: {
        type: String,
    },
    descripcion: {
        type: Array,
    },
    precio: {
        type: Number,
    },
    suscrito: {
        type: Boolean,
    },
    renovar: {
        type: Boolean,
    },
});
</script>

<template>
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto mt-16 max-w-2xl rounded-3xl ring-1 ring-gray-200 sm:mt-20 lg:mx-0 lg:flex lg:max-w-none">
            <div class="p-8 sm:p-10 lg:flex-auto">
                <h3 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ nombre }}
                </h3>
                <div class="mt-10 flex items-center gap-x-4">
                    <h4 class="flex-none text-sm font-semibold leading-6 text-blue-600">
                        ¿Que Incluye?
                    </h4>
                    <div class="h-px flex-auto bg-gray-100" />
                </div>
                <ul role="list"
                    class="mt-8 grid grid-cols-1 gap-4 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:grid-cols-2 sm:gap-6">
                    <li v-for="feature in descripcion" :key="feature" class="flex gap-x-3">
                        <CheckIcon class="h-6 w-5 flex-none text-blue-600" aria-hidden="true" />
                        {{ feature }}
                    </li>
                </ul>
            </div>
            <div class="-mt-2 p-2 lg:mt-0 lg:w-full lg:max-w-md lg:flex-shrink-0">
                <div
                    class="rounded-2xl h-full bg-gray-50 dark:bg-gray-800 py-10 text-center ring-1 ring-inset ring-gray-900/5 lg:flex lg:flex-col lg:justify-center lg:py-16">
                    <div class="mx-auto max-w-xs px-8">
                        <p class="mt-6 flex items-baseline justify-center gap-x-2">
                            <span class="text-5xl font-bold tracking-tight text-gray-900 dark:text-white">€{{ precio
                            }}</span>
                            <span
                                class="text-sm font-semibold leading-6 tracking-wide text-gray-600 dark:text-gray-300">/año</span>
                        </p>
                        <div v-if="suscrito == true">
                            <button type="button"
                                class="mt-10 block w-full rounded-md text-white bg-blue-400 dark:bg-blue-500 cursor-not-allowed px-3 py-2 text-sm font-semibold text-center"
                                disabled>Ya estás suscrito</button>
                        </div>
                        <div v-else-if="renovar == true">
                            <a href="#"
                                class="mt-10 block w-full rounded-md bg-blue-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Renovar
                            </a>
                        </div>
                        <a href="#" v-else
                            class="mt-10 block w-full rounded-md bg-blue-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Suscribirse
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
