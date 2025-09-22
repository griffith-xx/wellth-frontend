<script setup>
import { Head } from "@inertiajs/vue3";
import { useFlash } from "@/Composables/useFlash";
import Toast from "primevue/toast";
import { router } from "@inertiajs/vue3";
defineProps({
    title: {
        type: String,
        required: true,
    },
});

const logout = () => {
    router.post(route("logout"));
};

useFlash();
</script>

<template>
    <Head :title="title" />
    <Toast />
    <div>
        <slot />
        <button @click="logout">Log out</button>
    </div>
</template>
