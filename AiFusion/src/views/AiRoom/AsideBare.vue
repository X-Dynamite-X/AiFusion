<script setup>
import { defineProps, computed } from "vue";
import { useRoute } from "vue-router";
import { useAiStore } from "../../stores/aiChat"; // استيراد aiStore
const aiStore = useAiStore(); // تعريف aiStore هنا

const props = defineProps({
  rooms: Array,
});

// جلب المعرف الحالي للغرفة من المسار
const route = useRoute();
const currentRoomId = computed(() => Number(route.query.aiRoomId));
</script>

<template>
  <aside class="w-64 bg-gray-900 text-white p-4 hidden lg:block overflow-y-auto h-full">
    <!-- شعار أو عنوان القائمة -->
    <h2 class="text-xl font-bold mb-4">Previous Chats</h2>

    <div class="mb-4">
        <router-link :to="{name:'aiNewRoom'}">
        <button
      class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition mb-4"
    >
      Start New Chat Room
    </button>
</router-link>

    <!-- قسم الغرف -->
      <ul class="space-y-2">
        <li v-for="(room, index) in rooms" :key="index">
          <router-link
            v-if="room.id !== currentRoomId"
            :to="{
              name: 'aiRoom',
              params: { aiRoomName: room.name },
              query: { aiRoomId: room.id },
            }"
            class="p-2 bg-gray-800 rounded hover:bg-gray-700 flex items-center space-x-2"
          >
            <span class="w-2.5 h-2.5 bg-blue-500 rounded-full"></span>
            <span>{{ room.name }}</span>
          </router-link>

          <!-- عنصر للغرفة الحالية ليظهر بلون مختلف ويكون غير تفاعلي -->
          <div
            v-else
            class="p-2 bg-blue-700 rounded flex items-center space-x-2 cursor-default"
          >
            <span class="w-2.5 h-2.5 bg-blue-500 rounded-full"></span>
            <span>{{ room.name }}</span>
          </div>
        </li>
      </ul>
    </div>

    <!-- خيار الترقية -->
    <div class="mt-auto">
      <button class="bg-blue-600 text-white w-full p-2 rounded-lg hover:bg-blue-700 transition">
        Upgrade Plan
      </button>
    </div>
  </aside>
</template>
