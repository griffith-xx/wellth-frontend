<script setup>
import { Head } from "@inertiajs/vue3";
import { useFlash } from "@/Composables/useFlash";
import Toast from "primevue/toast";

defineProps({
    title: {
        type: String,
        required: true,
    },
});

useFlash();
</script>

<template>
    <Head :title="title" />
    <Toast />
    <div class="">
        <slot />
    </div>
</template>
