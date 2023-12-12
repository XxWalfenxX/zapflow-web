<script setup>
import BonoCard from '@/Components/BonoCard.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { Head } from '@inertiajs/vue3';


const props = defineProps({
    bonosUsuario: {
        type: Array,
    },
    listaBonos: {
        type: Array,
    },

});


const estaSuscrito = (bonoId) => {
    const objetoEncontrado = props.bonosUsuario.find(objeto => objeto.id === bonoId);
    if (objetoEncontrado) {

        const fecha_final = new Date(objetoEncontrado.fecha_fin)
        const fecha_actual = new Date();
        var diferenciaEnMilisegundos = fecha_actual - fecha_final;

        // Calcular la diferencia en días
        var diferenciaEnDias = diferenciaEnMilisegundos / (1000 * 60 * 60 * 24);

        diferenciaEnDias = Math.round(diferenciaEnDias);

        if (diferenciaEnDias <= 0) {
            return true
        }

    }
};

const puedeRenovar = (bonoId) => {
    const objetoEncontrado = props.bonosUsuario.find(objeto => objeto.id === bonoId);
    if (objetoEncontrado) {
        return true
    }
}



</script>

<template>
    <Head title="Mis Bonos" />

    <DashboardLayout pagina-header="Bonos">
        <div class="bg-gray-200 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-2 text-gray-900 dark:text-gray-100">

                <div v-for="bono in listaBonos" :key="bono.id">
                    <BonoCard :nombre="bono.nombre" :descripcion="bono.descripcion" :precio="bono.precio"
                        :renovar="puedeRenovar(bono.id)" :suscrito="estaSuscrito(bono.id)" />

                </div>

            </div>
        </div>
    </DashboardLayout>
</template>
