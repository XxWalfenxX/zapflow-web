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
            class=" "
        >
            <BonoCard v-for="bono in bonos" :key="bono.id" :nombre="bono.nombre" :descripcion="bono.descripcion" :precio="bono.precio" :id="bono.id"/>

        </div>
    </GuestLayout>
</template>
