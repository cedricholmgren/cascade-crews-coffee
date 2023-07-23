<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";

// Define props with defineProps and access them directly
const { coffees } = defineProps({
    coffees: {
        type: Object,
        required: true,
    },
});

// Pagination data from Laravel
const pagination = ref(coffees);

// Grab all the coffee data from the props and console.log it
console.log(coffees);
</script>

<template>
    <AppLayout title="Coffee">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Coffee
            </h2>
        </template>
        <!-- Display coffees -->
        <div v-if="coffees && coffees.data.length > 0">
            <ul>
                <li v-for="coffee in coffees.data" :key="coffee.id">
                    <!-- Display individual coffee details here -->
                    {{ coffee.name }} - {{ coffee.size }}
                </li>
            </ul>
        </div>
        <div v-else>
            <p>No coffees found.</p>
        </div>

        <!-- Pagination links -->
        <div v-if="pagination.links.length > 1">
            <ul class="pagination">
                <li
                    v-for="link in pagination.links"
                    :key="link.url"
                    class="page-item"
                >
                    <Link :href="link.url" class="page-link">{{
                        link.label
                    }}</Link>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
