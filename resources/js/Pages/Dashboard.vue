<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import Index from "@/Pages/Coffees/Index.vue";
import Table from "@/Components/Table.vue";
import { ref } from "vue";
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import CoffeeActionButton from "@/Components/CoffeeActionButton.vue";

// Define props with defineProps and access them directly\
const page = usePage();

const popularCoffees = page.props.popularCoffees;

const popularCoffeesHeaders = [
    {
        //key is the order of the column in descending order from 1-10
        key: "",
        label: "",
    },
    {
        key: "name",
        label: "Name",
    },
    {
        key: "total",
        label: "total",
    },
];

const topUsers = page.props.topUsers;

const topUsersHeaders = [
    {
        //key is the order of the column in descending order from 1-10
        key: "",
        label: "",
    },
    {
        key: "name",
        label: "Name",
    },
    {
        key: "orders_sum_amount",
        label: "Total Coffees Bought",
    },
    {
        key: "email",
        label: "Email",
    },
];
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- coffee action button -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- Display table with coffees -->
                    <div class="flex flex-row">
                        <Table
                            :data="popularCoffees"
                            :headers="popularCoffeesHeaders"
                            class="w-1/2"
                        />
                        <Table
                            :data="topUsers"
                            :headers="topUsersHeaders"
                            class="w-1/2"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
