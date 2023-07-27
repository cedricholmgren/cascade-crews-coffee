<template>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <!-- Define table headers -->
                    <th
                        v-for="header in headers"
                        :key="header.key"
                        class="px-4 py-2 font-semibold text-left border-b-2 border-gray-300"
                    >
                        {{ header.label }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(item, index) in data"
                    :key="item.id"
                    class="hover:bg-gray-300"
                >
                    <!-- Display the order in the first column -->
                    <td class="px-4 py-2 border-b border-gray-300">
                        {{ index + 1 }}
                    </td>
                    <!-- Loop through data and display each item in subsequent columns -->
                    <td
                        v-for="header in headers.slice(1)"
                        :key="header.key"
                        class="px-4 py-2 border-b border-gray-300"
                    >
                        {{ item[header.key] }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
    data: {
        type: Array,
        required: true,
    },
    headers: {
        type: Array,
        required: true,
    },
});
</script>

<style>
/* Add any additional table styles here */
.table-container {
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    text-align: left;
}

/* Optional hover effect */
.hover\:bg-gray-100:hover {
    background-color: #f7fafc;
}
</style>
