<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import LogoutOtherBrowserSessionsForm from "@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue";
import SectionBorder from "@/Components/SectionBorder.vue";
import TwoFactorAuthenticationForm from "@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Total coffees given -->
                <div class="flex flex-row">
                    <div class="flex flex-row mb-10 gap-10 ml-40">
                        <div class="text-2xl">Total Coffees Given:</div>
                        <div class="text-2xl">
                            {{ $page.props.orderAmount }}
                        </div>
                    </div>
                    <div class="flex flex-row mb-10 gap-10 ml-80">
                        <div class="text-2xl">Total Coffees Ordered:</div>
                        <div class="text-2xl">
                            {{ $page.props.totalCoffees }}
                        </div>
                    </div>
                </div>
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <UpdateProfileInformationForm
                        :user="$page.props.auth.user"
                    />

                    <SectionBorder />
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <UpdatePasswordForm class="mt-10 sm:mt-0" />

                    <SectionBorder />
                </div>

                <template
                    v-if="$page.props.jetstream.hasAccountDeletionFeatures"
                >
                    <SectionBorder />

                    <DeleteUserForm class="mt-10 sm:mt-0" />
                </template>
            </div>
        </div>
    </AppLayout>
</template>
