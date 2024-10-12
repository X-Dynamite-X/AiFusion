<script setup>
import { ref } from 'vue';

// قائمة غرف الدردشة
const chatRooms = ref([]);

// الرسائل الحالية
const messages = ref([]);

// الرسالة الجديدة المدخلة
const newMessage = ref('');

// دالة لإرسال الرسالة
const sendMessage = () => {
  if (newMessage.value.trim() !== '') {
    // إضافة الرسالة الجديدة من المستخدم
    messages.value.push({ text: newMessage.value, sender: 'user' });

    // محاكاة رد من البوت
    setTimeout(() => {
      messages.value.push({ text: 'This is a simulated response.', sender: 'bot' });
    }, 1000);

    // إضافة غرفة دردشة جديدة عند إرسال رسالة
    addChatRoom();

    // مسح حقل الإدخال بعد الإرسال
    newMessage.value = '';
  }
};

// دالة لإضافة غرفة دردشة جديدة
const addChatRoom = () => {
  const newRoom = {
    name: `Chat Room #${chatRooms.value.length + 1} - ${new Date().toLocaleString()}`
  };
  // إضافة الغرفة الجديدة إلى بداية قائمة غرف الدردشة
  chatRooms.value.unshift(newRoom);
};
</script>

<template>
  <div class="flex h-[92.9vh] h-max-[92.9vh]">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white p-4">
      <h2 class="text-xl font-bold mb-4">Previous Chats</h2>
      <!-- Dynamic Chat Rooms List -->
      <ul class="space-y-2">
        <li v-for="(room, index) in chatRooms" :key="index">
          <a href="#" class="block p-2 bg-gray-800 rounded hover:bg-gray-700">{{ room.name }}</a>
        </li>
      </ul>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow flex flex-col ">
      <!-- Header -->


      <!-- Messages Section -->
      <div class="flex-grow p-4 bg-gray-100 overflow-y-auto">
        <!-- Loop through messages -->
        <div v-for="(message, index) in messages" :key="index" class="flex items-start mb-4">
          <div v-if="message.sender === 'user'" class="ml-auto bg-blue-500 text-white p-3 rounded-lg max-w-xs">
            {{ message.text }}
          </div>
          <div v-else class="bg-gray-200 p-3 rounded-lg max-w-xs">
            {{ message.text }}
          </div>
        </div>
      </div>

      <!-- Input Section -->
      <div class="p-4 bg-white border-t">
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
