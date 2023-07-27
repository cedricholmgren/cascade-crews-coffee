<template>
    <button :class="buttonClasses" class="w-full" @click="handleButtonClick()">
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

const lastUserCoffee = page.props.lastUserCoffee;

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
        return "View Order";
    } else if (
        anyActiveOrders.value &&
        !userOrdering.value &&
        lastUserCoffee.order_id == page.props.activeOrdersIds[0]
    ) {
        return "Edit Coffee";
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

const addToOrder = () => {
    router.get(route("coffees.create"));
};

const editCoffee = () => {
    router.get(route("coffees.edit", lastUserCoffee.id));
};

const viewOrder = () => {
    router.get(route("orders.show", page.props.activeOrdersIds[0]));
};
//function to complete order by calling api to update order status to complete

const handleButtonClick = () => {
    if (anyActiveOrders.value && userOrdering.value) {
        viewOrder();
    } else if (
        anyActiveOrders.value &&
        !userOrdering.value &&
        lastUserCoffee.order_id == page.props.activeOrdersIds[0]
    ) {
        editCoffee();
    } else if (anyActiveOrders.value && !userOrdering.value) {
        addToOrder();
    } else if (!anyActiveOrders.value && !userOrdering.value) {
        newOrder();
    }
};
</script>
