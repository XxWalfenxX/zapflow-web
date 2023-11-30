<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import AdminDashboard from '../../Layouts/AdminDashboard.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

onMounted(() => {
    initFlowbite();
})

</script>

<template>
    <Head title="Gestión Usuarios" />

    <AdminDashboard>
        <div class="flex flex-col self-center justify-center items-center min-h-[65vh]">
            <ApplicationLogo class="h-48"></ApplicationLogo>
            <h1 class="text-3xl font-bold">Administración de ZapFlow</h1>
            <span>Pulse una opción para emepezar</span>
        </div>
    </AdminDashboard>
</template>
