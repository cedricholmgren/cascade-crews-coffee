<template>
    <div>
        <AppLayout title="Create Coffee">
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Create Coffee
                </h2>
            </template>
            <div class="max-w-lg mx-auto">
                <form @submit.prevent="submitCoffee">
                    <!-- Coffee Name -->
                    <div class="mt-4">
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Coffee Name
                        </label>
                        <input
                            v-model="form.name"
                            type="text"
                            name="name"
                            id="name"
                            required
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                    </div>

                    <!-- Coffee Size -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Size:</label>

                        <!-- 3 options for size small, medium, and large -->
                        <div class="flex items-center">
                            <input
                                v-model="form.size"
                                type="radio"
                                name="size"
                                id="small"
                                value="Small"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 ml-2"
                            />
                            <label
                                for="small"
                                class="ml-3 block text-sm font-medium text-gray-700"
                            >
                                Small
                            </label>
                            <input
                                v-model="form.size"
                                type="radio"
                                name="size"
                                id="medium"
                                value="Medium"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 ml-2"
                            />
                            <label
                                for="medium"
                                class="ml-3 block text-sm font-medium text-gray-700"
                            >
                                Medium
                            </label>
                            <input
                                v-model="form.size"
                                type="radio"
                                name="size"
                                id="large"
                                value="Large"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 ml-2"
                            />
                            <label
                                for="large"
                                class="ml-3 block text-sm font-medium text-gray-700"
                            >
                                Large
                            </label>
                        </div>
                    </div>

                    <!-- Coffee Note -->
                    <div class="mt-4">
                        <label
                            for="note"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Coffee Note
                        </label>
                        <input
                            v-model="form.note"
                            type="text"
                            name="note"
                            id="note"
                            required
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500"
                        >
                            Create Coffee
                        </button>
                    </div>
                </form>
            </div>
        </AppLayout>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";
import { usePage, Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Dropdown from "@/Components/Dropdown.vue";

const page = usePage();

const form = useForm({
    _method: "POST",
    order_id: page.props.activeOrdersIds[0],
    user_id: page.props.auth.user.id,
    name: "",
    size: "",
    note: "",
});

// Function to submit coffee
const submitCoffee = () => {
    form.post(route("coffees.store"));
};
</script>
