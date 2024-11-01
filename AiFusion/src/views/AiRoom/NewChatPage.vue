<script setup>
import { ref, onMounted, defineProps } from "vue";
import { useAiStore } from "../../stores/aiChat";

const aiStore = useAiStore();
const props = defineProps({
  chatInRoom: Array,
  userAvatar: String,
  AI_initials: String,
  initials: String
});

const newMessage = ref("");
const messageTextarea = ref(null);

const adjustTextareaHeight = () => {
  messageTextarea.value.style.height = "2.5rem";
  messageTextarea.value.style.height = `${messageTextarea.value.scrollHeight}px`;
};

const sendAndCreateNewRoom = () => {
  if (newMessage.value.trim()) {
    aiStore.sendMessageinNewRoom(newMessage);
    newMessage.value = "";
  }
};

</script>

<template>
  <div class="flex-grow flex flex-col">
    <div class="flex-grow p-4 bg-gray-100 overflow-y-auto">
      <!-- Loop through messages and replies -->
    </div>

    <!-- Input Section -->
    <div class="p-4 bg-gray-300 border-t">
      <form @submit.prevent="sendAndCreateNewRoom" class="flex items-end gap-1.5 pl-4 md:gap-2">
        <!-- Attach Files Button -->
        <div class="-ml-2.5 mb-1 flex h-8">
          <button
            aria-disabled="true"
            aria-label="Attach files"
            class="flex items-center justify-center h-8 w-8 rounded-full text-token-text-primary dark:text-white focus-visible:outline-black dark:focus-visible:outline-white"
          >
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M9 7C9 4.23858 11.2386 2 14 2C16.7614 2 19 4.23858 19 7V15C19 18.866 15.866 22 12 22C8.13401 22 5 18.866 5 15V9C5 8.44772 5.44772 8 6 8C6.55228 8 7 8.44772 7 9V15C7 17.7614 9.23858 20 12 20C14.7614 20 17 17.7614 17 15V7C17 5.34315 15.6569 4 14 4C12.3431 4 11 5.34315 11 7V15C11 15.5523 11.4477 16 12 16C12.5523 16 13 15.5523 13 15V9C13 8.44772 13.4477 8 14 8C14.5523 8 15 8.44772 15 9V15C15 16.6569 13.6569 18 12 18C10.3431 18 9 16.6569 9 15V7Z"
                fill="currentColor"
              />
            </svg>
          </button>
        </div>

        <!-- Textarea for New Message -->
        <div class="flex min-w-0 flex-1 flex-col">
          <textarea
            v-model="newMessage"
            @input="adjustTextareaHeight"
            ref="messageTextarea"
            class="block h-10 w-full resize-none border border-gray-300 rounded-l-lg px-3 py-2 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            placeholder="Message ChatGPT"
          ></textarea>
        </div>

        <!-- Send Button -->
        <div class="mb-1 me-1">
          <button
            type="submit"
            aria-label="Send prompt"
            data-testid="send-button"
            class="flex h-8 w-8 items-center justify-center rounded-full transition-colors hover:opacity-70 focus-visible:outline-none focus-visible:outline-black disabled:text-[#f4f4f4] disabled:hover:opacity-100 dark:focus-visible:outline-white bg-black text-white dark:bg-white dark:text-black bg-[#D7D7D7]"
          >
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-2xl">
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M15.1918 8.90615C15.6381 8.45983 16.3618 8.45983 16.8081 8.90615L21.9509 14.049C22.3972 14.4953 22.3972 15.2189 21.9509 15.6652C21.5046 16.1116 20.781 16.1116 20.3347 15.6652L17.1428 12.4734V22.2857C17.1428 22.9169 16.6311 23.4286 15.9999 23.4286C15.3688 23.4286 14.8571 22.9169 14.8571 22.2857V12.4734L11.6652 15.6652C11.2189 16.1116 10.4953 16.1116 10.049 15.6652C9.60265 15.2189 9.60265 14.4953 10.049 14.049L15.1918 8.90615Z"
                fill="currentColor"
              />
            </svg>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
