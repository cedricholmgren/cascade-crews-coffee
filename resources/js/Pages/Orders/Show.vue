<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import Table from "@/Components/Table.vue";
import { defineProps } from "vue";
import CompleteOrderForm from "@/Pages/Orders/Partials/CompleteOrderForm.vue";

// Define props with defineProps and access them directly
const { order } = defineProps({
    order: {
        type: Object,
        required: true,
    },
});

// Table headers
const headers = [
    {
        key: "",
        label: "",
    },
    {
        key: "name",
        label: "Coffee Name",
    },
    {
        key: "size",
        label: "Size",
    },
    {
        key: "note",
        label: "Note",
    },
];

//put coffees in array
const coffees = order.coffees;
</script>

<template>
    <AppLayout title="Coffee">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Order
            </h2>
        </template>

        <!-- Display table with coffees -->
        <div class="mt-8 max-w-7xl mx-auto">
            <Table :data="coffees" :headers="headers" />
        </div>

        <!-- Complete Order Form -->
        <div class="mt-8 flex -ml-18">
            <CompleteOrderForm :order="order" :estimatedCost="estimatedCost" />
        </div>
    </AppLayout>
</template>

<style scoped>
.-ml-18 {
    margin-left: -4.5rem;
}
</style>
