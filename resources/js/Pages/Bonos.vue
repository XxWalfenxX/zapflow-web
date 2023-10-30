<script>
export default {
    data() {
        return {
            bonos: null,
        };
    },
    async created() {
        const response = await fetch("/api/bono");
        this.bonos = await response.json();
    },
};
</script>
<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import BonoCard from "@/Components/BonoCard.vue";

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
    <Head title="Bonos" />
    <GuestLayout
        :canLogin="canLogin"
        :canRegister="canRegister"
        :propUser="$page.props.auth.user"
    >
        <div
            class="min-h-[80vh] grid grid-cols-3 gap-5 place-items-center sm:grid-cols-3 mt-5 ml-5"
        >
            <BonoCard v-for="bono in bonos" :nombre="bono.nombre" :descripcion="bono.descripcion" :precio="bono.precio"/>

        </div>
    </GuestLayout>
</template>
