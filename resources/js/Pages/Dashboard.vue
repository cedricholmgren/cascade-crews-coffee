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
        label: "Total Ordered",
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
        label: "Coffees Bought",
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
                <!-- Display table with coffees -->
                <div class="flex flex-col items-center justify-center mb-4">
                    <p
                        class="text-gray-600 text-lg mt-8 text-center max-h-40 overflow-hidden"
                    >
                        Many people think fences and decks are made with timber
                        and nails. Wrong. Quality fences and decks are made with
                        great people and lots of coffee. Grab something for the
                        crew when you go for a coffee run, they’ll tell you
                        their order here!
                    </p>
                    <CoffeeActionButton class="mt-3" />
                    <div class="flex flex-row gap-96">
                        <div class="mr-2 font-bold">
                            Popular Coffees Leaderboard
                        </div>
                        <div class="ml-2 font-bold">
                            Most Coffees Ordered Leaderboard
                        </div>
                    </div>
                </div>
                <div class="flex flex-row gap-10">
                    <Table
                        :data="popularCoffees"
                        :headers="popularCoffeesHeaders"
                        class="w-1/2 bg-white"
                    />
                    <Table
                        :data="topUsers"
                        :headers="topUsersHeaders"
                        class="w-1/2 bg-white"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
.line-clamp-5 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 5; /* Number of lines to show */
}
</style>
