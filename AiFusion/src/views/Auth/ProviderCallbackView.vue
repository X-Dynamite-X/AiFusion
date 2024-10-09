<script setup>
import { onMounted ,ref} from 'vue';
import { useAuthStore } from '../../stores/auth';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();

// const  provider = 'github';
onMounted(async () => {
  const code = route.query.code;
  const provider = route.params.provider; // استقبال الموفر من المسار
  if (code) {
    try {
      await authStore.handleGitHubCallback(provider,code);
      router.push('/');
    } catch (error) {
      console.error("Error during GitHub callback:", error);
    }
  } else {
    console.error("No GitHub code found in URL");
  }
});
</script>

<template>
  <h1 class="text-4xl text-red-700"> Login with {{ route.params.provider }} page</h1>
</template>
