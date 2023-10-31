<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { ref } from "vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import { Switch, SwitchGroup, SwitchLabel } from "@headlessui/vue";

const agreed = ref(false);

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>
<template>
    <Head title="Contacto" />
    <GuestLayout
        :canLogin="canLogin"
        :canRegister="canRegister"
        :propUser="$page.props.auth.user"
    >
        <div class="px-6 py-24 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2
                    class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl"
                >
                    Contacta con nosotros
                </h2>
                <p class="mt-2 text-lg leading-8 text-gray-600 dark:text-gray-500">
                    Si tienes alguna duda, contacta con nuestro equipo
                </p>
            </div>
            <form
                action="#"
                method="POST"
                class="mx-auto mt-16 max-w-xl sm:mt-20"
            >
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <label
                            for="first-name"
                            class="block text-sm font-semibold leading-6 text-gray-900 dark:text-white"
                            >Nombre</label
                        >
                        <div class="mt-2.5">
                            <input
                                type="text"
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <label
                            for="last-name"
                            class="block text-sm font-semibold leading-6 text-gray-900 dark:text-white"
                            >Apellido</label
                        >
                        <div class="mt-2.5">
                            <input
                                type="text"
                                name="last-name"
                                id="last-name"
                                autocomplete="family-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label
                            for="company"
                            class="block text-sm font-semibold leading-6 text-gray-900 dark:text-white"
                            >Empresa</label
                        >
                        <div class="mt-2.5">
                            <input
                                type="text"
                                name="company"
                                id="company"
                                autocomplete="organization"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label
                            for="email"
                            class="block text-sm font-semibold leading-6 text-gray-900 dark:text-white"
                            >Email</label
                        >
                        <div class="mt-2.5">
                            <input
                                type="email"
                                name="email"
                                id="email"
                                autocomplete="email"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label
                            for="phone-number"
                            class="block text-sm font-semibold leading-6 text-gray-900 dark:text-white"
                            >Número de telefono</label
                        >
                        <div class="relative mt-2.5">
                            <input
                                type="tel"
                                name="phone-number"
                                id="phone-number"
                                autocomplete="tel"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label
                            for="message"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Mensaje</label
                        >
                        <div class="mt-2.5">
                            <textarea
                                name="message"
                                id="message"
                                rows="4"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <SwitchGroup as="div" class="flex gap-x-4 sm:col-span-2">
                        <div class="flex h-6 items-center">
                            <Switch
                                v-model="agreed"
                                :class="[
                                    agreed ? 'bg-indigo-600' : 'bg-gray-200',
                                    'flex w-8 flex-none cursor-pointer rounded-full p-px ring-1 ring-inset ring-gray-900/5 transition-colors duration-200 ease-in-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600',
                                ]"
                            >
                                <span class="sr-only">Aceptar las politicas</span>
                                <span
                                    aria-hidden="true"
                                    :class="[
                                        agreed
                                            ? 'translate-x-3.5'
                                            : 'translate-x-0',
                                        'h-4 w-4 transform rounded-full bg-white shadow-sm ring-1 ring-gray-900/5 transition duration-200 ease-in-out',
                                    ]"
                                />
                            </Switch>
                        </div>
                        <SwitchLabel class="text-sm leading-6 text-gray-600">
                            Al seleccionar esto, usted acepta nuestra
                            {{ " " }}
                            <a href="#" class="font-semibold text-indigo-600"
                                >política de privacidad</a
                            >.
                        </SwitchLabel>
                    </SwitchGroup>
                </div>
                <div class="mt-10">
                    <button
                        type="submit"
                        class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        Let's talk
                    </button>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
