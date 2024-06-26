<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import "leaflet/dist/leaflet.css";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const stats = [
    { name: "Puntos de carga en España", value: "200+" },
    { name: "Mantenimiento", value: "24/7" },
    { name: "Clientes Satisfechos", value: "1.000+" },
];
const people = [
    {
        name: "Manel Botet",
        role: "Co-Founder / CEO",
        imageUrl:
            "https://lh3.googleusercontent.com/ogw/AKPQZvyy8LiR_C8Vdhri_mM1aDGRuv_jqTS3XOh_f21u",
        ipop: "https://sites.google.com/bemen3.cat/lipop-de-manel-botet/autoconeixement"
    },
    {
        name: "Marc Lecha",
        role: "Co-Founder / CEO",
        imageUrl:
            "https://lh3.googleusercontent.com/a/ACg8ocIv3YnxI72EJlMaH1UI6RZcA4pZyyIKMABR1felycw4Z6aiKfU5g5rEdUuFoSVHKnKk6exsJJOLqrOW00PwOWMorg",
        ipop: "https://sites.google.com/bemen3.cat/pop-marc-lecha/inicio"
    },
];

</script>

<template>
    <Head title="Inicio" />
    <GuestLayout :canLogin="canLogin" :canRegister="canRegister" :propUser="$page.props.auth.user">
        <section class="relative isolate overflow-hidden px-6 py-24 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl lg:max-w-4xl">
                <div class="flex flex-wrap items-center ">
                    <img src="img/logo.png" class="ml-auto mr-5 md:h-24 h-10" alt="ZapFlow Logo" />
                    <span
                        class="self-center md:text-7xl font-semibold whitespace-nowrap dark:text-white mr-auto text-2xl">ZapFlow</span>
                </div>

                <figure class="mt-10">
                    <blockquote
                        class="text-center text-xl font-semibold leading-8 text-gray-900 sm:text-2xl sm:leading-9 dark:text-white">
                        <p>
                            Instalación y gestión de puntos de carga de vehículos eléctricos
                        </p>
                    </blockquote>
                </figure>
            </div>
        </section>
        <div class="relative isolate overflow-hidden bg-gray-900 py-24 sm:py-32">

            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=focalpoint&fp-y=.8&w=2830&h=1500&q=80&blend=111827&sat=-100&exp=15&blend-mode=multiply"
                alt="" class="absolute inset-0 -z-10 h-full w-full object-cover object-right md:object-center" />
            <div class="hidden sm:absolute sm:-top-10 sm:right-1/2 sm:-z-10 sm:mr-10 sm:block sm:transform-gpu sm:blur-3xl"
                aria-hidden="true">
                <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20"
                    style="
                        clip-path: polygon(
                            74.1% 44.1%,
                            100% 61.6%,
                            97.5% 26.9%,
                            85.5% 0.1%,
                            80.7% 2%,
                            72.5% 32.5%,
                            60.2% 62.4%,
                            52.4% 68.1%,
                            47.5% 58.3%,
                            45.2% 34.5%,
                            27.5% 76.7%,
                            0.1% 64.9%,
                            17.9% 100%,
                            27.6% 76.8%,
                            76.1% 97.7%,
                            74.1% 44.1%
                        );
                    " />
            </div>
            <div class="absolute -top-52 left-1/2 -z-10 -translate-x-1/2 transform-gpu blur-3xl sm:top-[-28rem] sm:ml-16 sm:translate-x-0 sm:transform-gpu"
                aria-hidden="true">
                <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20"
                    style="
                        clip-path: polygon(
                            74.1% 44.1%,
                            100% 61.6%,
                            97.5% 26.9%,
                            85.5% 0.1%,
                            80.7% 2%,
                            72.5% 32.5%,
                            60.2% 62.4%,
                            52.4% 68.1%,
                            47.5% 58.3%,
                            45.2% 34.5%,
                            27.5% 76.7%,
                            0.1% 64.9%,
                            17.9% 100%,
                            27.6% 76.8%,
                            76.1% 97.7%,
                            74.1% 44.1%
                        );
                    " />
            </div>
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-4xl lg:mx-0">
                    <h2 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                        ZapFlow es una empresa líder en el mercado de la instalación y gestión de puntos de carga para
                        vehículos eléctricos. Nuestro equipo de ingenieros e instaladores altamente capacitados se dedica a
                        proporcionar soluciones de carga personalizadas y de alta calidad para empresas, particulares y
                        administraciones públicas.
                    </h2>

                </div>
                <div class="mx-auto mt-10 max-w-2xl lg:mx-0 lg:max-w-none">
                    <dl class="mt-16 grid grid-cols-1 gap-8 sm:mt-20 sm:grid-cols-2 lg:grid-cols-4">
                        <div v-for="stat in stats" :key="stat.name" class="flex flex-col-reverse">
                            <dt class="text-base leading-7 text-gray-300">
                                {{ stat.name }}
                            </dt>
                            <dd class="text-2xl font-bold leading-9 tracking-tight text-white">
                                {{ stat.value }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <div class="mx-auto max-w-2xl lg:max-w-4xl">
            <section class="relative isolate overflow-hidden px-6 py-24 sm:py-32 lg:px-8">
                <figure>
                    <p
                        class="text-center text-xl font-semibold leading-8 text-gray-900 sm:text-4xl sm:leading-9 dark:text-white">
                        Nuestra Mision y valores
                    </p>
                    <blockquote
                        class="text-center text-xl font-semibold leading-8 mt-4 text-gray-900 sm:text-xl sm:leading-9 dark:text-white">
                        <p>
                            “Nuestra misión es facilitar la transición hacia una
                            movilidad más sostenible y proporcionar una red de
                            puntos de carga accesible, eficiente y fiable para
                            los vehículos eléctricos. Nuestro objetivo es
                            eliminar las barreras para la adopción de vehículos
                            eléctricos y contribuir a un futuro más verde y
                            limpio.”
                        </p>
                    </blockquote>
                </figure>
            </section>
        </div>

        <div class="py-24 sm:py-32">
            <div class="mx-auto grid max-w-7xl gap-x-8 gap-y-20 px-6 lg:px-8 xl:grid-cols-3">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl dark:text-white">
                        Conócenos
                    </h2>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Conoce a la gente que hace posible cumplir nuestra
                        misión
                    </p>
                </div>
                <ul role="list" class="grid gap-x-8 gap-y-12 sm:grid-cols-2 sm:gap-y-16 xl:col-span-2">
                    <li v-for="person in people" :key="person.name">
                        <div class="flex items-center gap-x-6">
                            <a :href="person.ipop">
                            <img class="h-16 w-16 rounded-full" :src="person.imageUrl" alt="" />
                            </a>
                            <div>
                                <h3 class="text-base font-semibold leading-7 tracking-tight text-gray-900 dark:text-white">
                                    {{ person.name }}
                                </h3>
                                <p class="text-sm font-semibold leading-6 text-blue-600">
                                    {{ person.role }}
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </GuestLayout></template>
