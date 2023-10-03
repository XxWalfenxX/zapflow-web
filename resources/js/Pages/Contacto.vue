<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});

</script>
<template>
    <Head title="Sobre Nosotros" />
    <GuestLayout :canLogin="canLogin" :canRegister="canRegister" :propUser=$page.props.auth.user>

    </GuestLayout>
</template>
