<script setup>
import { defineProps, computed, ref, onMounted } from "vue";
import { useRoute } from "vue-router";

const props = defineProps({
  providers: Array,
});

const route = useRoute();
const currentRoomId = computed(() => Number(route.query.aiRoomId));

// متغير البحث
const searchQuery = ref("");

// متغيرات لفتح أو غلق مزودي الخدمة والشريط الجانبي على الشاشات الصغيرة
const openProviders = ref({});
const isSidebarOpen = ref(false);

// دالة لتصفية النماذج والغرف بناءً على البحث
const filteredProviders = computed(() => {
  return props.providers.map(provider => {
    const filteredModels = provider.ai_models.filter(model =>
      model.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
    return { ...provider, ai_models: filteredModels };
  });
});

// دالة لتبديل حالة القائمة المنسدلة لكل مزود
function toggleProvider(id) {
  openProviders.value[id] = !openProviders.value[id];
}

// دالة لتبديل عرض الشريط الجانبي
function toggleSidebar() {
  isSidebarOpen.value = !isSidebarOpen.value;
}
// دالة لإغلاق الشريط الجانبي عند تحميل الصفحة على الشاشات الكبيرة
onMounted(() => {
  if (window.innerWidth >= 1024) {
    isSidebarOpen.value = true;
  }
});
</script>
<template>
    <div>
      <!-- زر لفتح وإغلاق الشريط الجانبي على الشاشات الصغيرة -->
      <button
        @click="toggleSidebar"
        class="lg:hidden fixed top-4 left-4 z-20 bg-blue-600 text-white p-2 rounded-lg focus:outline-none"
      >
        ☰
      </button>

      <!-- الشريط الجانبي -->
      <aside
        :class="{'block': isSidebarOpen, 'hidden': !isSidebarOpen, 'lg:block': true}"
        class="w-64 bg-gray-900 text-white p-4 overflow-y-auto h-full fixed lg:relative z-10 transition-transform"
      >
        <h2 class="text-xl font-bold mb-4">AI Chat</h2>

        <input
          type="text"
          v-model="searchQuery"
          placeholder="Search models..."
          class="w-full p-2 mb-4 rounded bg-gray-800 text-white placeholder-gray-400 focus:outline-none"
        />

        <div v-for="provider in filteredProviders" :key="provider.id" class="mb-6">
          <div @click="toggleProvider(provider.id)" class="cursor-pointer flex items-center justify-between p-2 bg-gray-800 rounded hover:bg-gray-700">
            <h3 class="text-lg font-semibold text-blue-400">{{ provider.name }}</h3>
            <span :class="{'rotate-180': openProviders[provider.id]}" class="transform transition-transform">
              ▼
            </span>
          </div>
          <div v-show="openProviders[provider.id]" class="mt-2 space-y-2 pl-2">
            <div
              v-for="model in provider.ai_models"
              :key="model.id"
              class="p-2 bg-gray-700 rounded hover:bg-gray-600 transition relative"
            >
              <h4 class="text-md font-medium text-gray-300">{{ model.name }}</h4>

              <router-link :to="{ name: 'aiNewRoom', params:{apiProviderName:provider.name ,aiModelName:model.name } }">
                <button @click="$emit('new-room', {provider,model})"
                  class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 text-xs p-1 rounded hover:bg-blue-700 transition"
                >
                  New Room
                </button>
              </router-link>

              <ul v-if="model.chat_rooms && model.chat_rooms.length" class="mt-2 space-y-1 pl-4">
                <li v-for="room in model.chat_rooms" :key="room.id" @click="$emit('change-room', room.id)">
                  <router-link
                    v-if="room.id !== currentRoomId"
                    :to="{
                      name: 'aiRoom',
                      params: {
                        apiProviderName: provider.name,
                        aiModelName: model.name,
                        aiRoomName: room.name
                      },
                      query: { aiRoomId: room.id },
                    }"
                    class="p-1 text-sm bg-gray-800 rounded hover:bg-gray-700 flex items-center space-x-1"
                  >
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    <span>{{ room.name }}</span>
                  </router-link>

                  <div
                    v-else
                    class="p-1 bg-blue-700 text-sm rounded flex items-center space-x-1 cursor-default"
                  >
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    <span>{{ room.name }}</span>
                  </div>
                </li>
              </ul>

              <p v-else class="text-gray-400 text-xs italic">
                No rooms available.
              </p>
            </div>
          </div>
        </div>

        <!-- خيار الترقية في الأسفل -->
        <div class="mt-auto">
          <button class="bg-blue-600 text-white w-full p-2 rounded-lg hover:bg-blue-700 transition">
            Upgrade Plan
          </button>
        </div>
      </aside>
    </div>
  </template>

<style scoped>
@media (max-width: 1024px) {
  .fixed {
    transform: translateX(-100%);
  }
  .fixed.isSidebarOpen {
    transform: translateX(0);
  }
}
</style>
