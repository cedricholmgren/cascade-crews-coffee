<template>
    <button
        :class="buttonClasses"
        class="w-full text-left"
        @click="handleButtonClick()"
    >
        {{ buttonText }}
    </button>
</template>

<script setup>
import { computed, ref } from "vue";
import { usePage, Head, Link, router, useForm } from "@inertiajs/vue3";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import NavLink from "@/Components/NavLink.vue";

const page = usePage();

const userOrdering = computed(() => {
    return page.props.userOrdering;
});

const anyActiveOrders = computed(() => {
    if (page.props.activeOrdersIds.length > 0) {
        return true;
    } else {
        return false;
    }
});

const orderForm = useForm({
    _method: "POST",
    user_id: page.props.auth.user.id,
    cost: 0,
    amount: 0,
    completed: false,
});

//route function to go to order show page

console.log(anyActiveOrders.value);
console.log(userOrdering.value);

const props = defineProps({});

const buttonText = computed(() => {
    if (anyActiveOrders.value && userOrdering.value) {
        return "Complete Order";
    } else if (anyActiveOrders.value && !userOrdering.value) {
        return "Add to Order";
    } else if (!anyActiveOrders.value && !userOrdering.value) {
        return "Start New Order";
    }
});

const buttonClasses = computed(() => {
    return "block w-full px-4 py-2 text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 active:bg-blue-700 transition duration-150 ease-in-out";
});

//function to send store order request to api
const newOrder = () => {
    //show modal to confirm new order
    orderForm.post(route("orders.store"));
};

//function to route to coffee.create page with order id as prop
const addToOrder = () => {
    //route to coffee.create page with order id as prop
    router.get({
        name: "coffee.create",
        params: { order: page.props.activeOrdersIds[0] },
    });
};

//function to complete order by calling api to update order status to complete
const completeOrder = () => {};

//if anyActiveOrders is true && userOrdering is false then route to coffee.store to submit coffee to current order
//if anyActiveOrders is true && userOrdering is true then show modal to complete order

//if anyActiveOrders is false && userOrdering is false then show confirmation modal to start new order and then route to new order page
const handleButtonClick = () => {
    if (anyActiveOrders.value && userOrdering.value) {
        completeOrder();
    } else if (anyActiveOrders.value && !userOrdering.value) {
        addToOrder();
    } else if (!anyActiveOrders.value && !userOrdering.value) {
        newOrder();
    }
};
</script>
