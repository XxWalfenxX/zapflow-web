<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-4 py-3 text-white bg-blue-700 rounded-lg active w-full dark:bg-blue-600 shadow'
        : 'inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-200 hover:bg-gray-400 shadow w-full dark:bg-gray-900 dark:hover:bg-gray-700 dark:hover:text-white'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
