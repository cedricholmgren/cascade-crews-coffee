<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";

// Define props with defineProps and access them directly
const { order } = defineProps({
    order: {
        type: Object,
        required: true,
    },
});

// Grab all the order data from the props and console.log it
console.log(order);
</script>

<template>
    <AppLayout title="Coffee">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Order
            </h2>
        </template>
        <!-- Display order amount and cost -->
        <div>{{ order.amount }} - {{ order.cost }}</div>
    </AppLayout>
</template>
