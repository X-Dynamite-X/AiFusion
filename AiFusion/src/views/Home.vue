<script setup>
    import { useAuthStore } from '../stores/auth';
    const authStore = useAuthStore();

</script>

<template>
                <!-- Welcome, {{ authStore.user }}! -->

    <template v-if="authStore.user">
        <p class="text-3xl text-blue-700 text-center ">
            Welcome, {{ authStore.user.name }}!

        </p>
    </template>
    <template v-else>
        <p class="text-red-500 text-2xl"> test vue page and twleindcss</p>
    </template>

</template>

