<script setup>
import { ref, defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const { order } = defineProps({
    order: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    _method: "PUT",
    cost: "0",
    amount: order.coffees.length.toString(),
    user_id: order.user_id,
    completed: true,
});

const completeOrder = () => {
    form.put(route("orders.update", order.id));
};
</script>

<template>
    <FormSection @submitted="completeOrder">
        <template #form>
            <div class="sm:col-span-4">
                <InputLabel for="cost" value="Cost" class="ml-3" />
                $
                <TextInput
                    id="cost"
                    ref="costInput"
                    v-model="form.cost"
                    type="number"
                    class="mt-1"
                    autocomplete="cost"
                />
                <div class="ml-4">
                    Estimated Cost: $
                    {{ order.estimatedCost * order.coffees.length }}
                </div>
            </div>
        </template>

        <template #actions>
            <PrimaryButton :processing="form.processing">
                Complete Order
            </PrimaryButton>
        </template>
    </FormSection>
</template>
