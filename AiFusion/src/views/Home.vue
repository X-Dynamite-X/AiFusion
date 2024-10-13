<script setup>
import { ref, computed } from 'vue';
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();
const userAvatar = computed(() => {
  return authStore.user?.avatar ? authStore.user.avatar : "";
});
const initials = computed(() => {
  return authStore.user?.name
    ? authStore.user.name.charAt(0).toUpperCase()
    : "";
});
const AI_initials =  "ai".toUpperCase()

const chatRooms = ref([
  { name: 'Room 1' },
  { name: 'Room 2' },
  { name: 'Room 3' },
]);

const messages = ref([
  { sender: 'user', text: 'Hello, how can I help you?' },
  { sender: 'bot', text: 'I need some information about your services.' },
]);

const newMessage = ref('');

const sendMessage = () => {
  if (newMessage.value.trim() !== '') {
    messages.value.push({ sender: 'user', text: newMessage.value });
    newMessage.value = '';
  }
};
</script>

<template>
  <div class="flex h-[94vh]">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white p-4 hidden lg:block">
      <h2 class="text-xl font-bold mb-4">Previous Chats</h2>
      <!-- Dynamic Chat Rooms List -->
      <ul class="space-y-2">
        <li v-for="(room, index) in chatRooms" :key="index">
          <a href="#" class="block p-2 bg-gray-800 rounded hover:bg-gray-700">{{ room.name }}</a>
        </li>
      </ul>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow flex flex-col">
      <div class="flex-grow p-4 bg-gray-100 overflow-y-auto">
        <!-- Loop through messages -->
        <div v-for="(message, index) in messages" :key="index" class="flex items-start mb-4" :class="{'justify-end': message.sender === 'user'}">
          <!-- Avatar and Message -->
          <div v-if="message.sender === 'user'" class="flex items-center space-x-2 ml-auto">
            <div class="text-right">
              <div class="bg-blue-500 text-white p-3 rounded-lg max-w-xs">
                {{ message.text }}
              </div>
            </div>
            <img class="h-8 w-8 rounded-full ring-1 ring-white" :src="userAvatar" v-if="userAvatar" alt="User Avatar" />
            <span class="h-8 w-8 bg-blue-200 rounded-full flex items-center justify-center font-bold" v-else>{{ initials }}</span>
          </div>
          <div v-else class="flex items-center space-x-2">
            <span class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center font-bold" >{{ AI_initials }}</span>
            <div class="bg-gray-200 text-black p-3 rounded-lg max-w-xs">
              {{ message.text }}
            </div>
          </div>
        </div>
        
      </div>

      <!-- Input Section -->
      <div class="p-4 bg-gray-300 border-t">
        <form @submit.prevent="sendMessage" class="flex">
          <input
            v-model="newMessage"
            type="text"
            placeholder="Type your message..."
            class="flex-grow border border-gray-300 rounded-l-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <button
            type="submit"
            class="bg-blue-500 text-white p-2 rounded-r-lg hover:bg-blue-600 transition">
            Send
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Scrollbar style */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.2);
  border-radius: 8px;
}
</style>
