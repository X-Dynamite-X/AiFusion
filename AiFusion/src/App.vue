
<script setup>
    import NavPage from "./components/layouts/NavPage.vue";
    import { useRoute } from "vue-router";
    const route = useRoute();


</script>

<template>
    <main class="min-h-screen max-h-screen">

        <nav-page></nav-page>
        <router-view></router-view>

    </main>
</template>


<style>
.loader {
  border: 4px solid #f3f3f3; /* Light grey */
  border-top: 4px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
