<script setup>
import { ref, computed, onMounted,watch  } from "vue";
import { useAuthStore } from "../stores/auth";
import { useAiStore } from "../stores/aiChat";
import { useRoute, useRouter } from "vue-router";
import AsideBare from "./AiRoom/AsideBare.vue";
import ChatPage from "./AiRoom/ChatPage.vue";
import NewChatPage from "./AiRoom/NewChatPage.vue";
import spinner from "@/components/layouts/spinner.vue";

const router = useRouter(); // نحتاج استخدام useRouter للتنقل بين الغرف بدون تحديث الصفحة
const route = useRoute();
const authStore = useAuthStore();
const aiStore = useAiStore();
const isLoading = ref(false)

const userAvatar = computed(() => {
    return authStore.user?.avatar ? authStore.user.avatar : "";
});
const initials = computed(() => {
    return authStore.user?.name
        ? authStore.user.name.charAt(0).toUpperCase()
        : "";
});
const AI_initials = "AI".toUpperCase();

const loadRoomChats = async (roomId) => {
  isLoading.value = true;
  await aiStore.getChatsRoom(roomId);
  isLoading.value = false;
};

onMounted(async () => {
    isLoading.value=true
    aiStore.getAllRooms();
    if(route.name =='aiRoom'){
        aiStore.getChatsRoom(route.query.aiRoomId); // جلب محادثات الغرفة الحالية بناءً على المعرف
        await loadRoomChats(route.query.aiRoomId)
    }
    isLoading.value=false

});

watch( () => route.query.aiRoomId,
    (newRoomId) => {
        if (newRoomId) {
            aiStore.getChatsRoom(newRoomId); // تحديث المحادثات عند تغير المعرف
            loadRoomChats(newRoomId)

        }
    }
);
const changeRoom = (roomId) => {
    router.push({ query: { aiRoomId: roomId } });
};






</script>
<template>
    <div class="flex h-[94vh]">
        <!-- <aside-bare
            :rooms="aiStore.chatRooms"></aside-bare> -->
            <aside-bare
            :rooms="aiStore.chatRooms"
            @change-room="changeRoom"
        ></aside-bare>
        <chat-page v-if="route.name =='aiRoom' && !isLoading"
            :chatInRoom="aiStore.chatInRoom"
            :userAvatar = userAvatar
            :initials= initials
            :AI_initials= AI_initials
        ></chat-page>
        <spinner v-if="isLoading"></spinner>

        <new-chat-page v-if="route.name =='aiNewRoom' && !isLoading"
            :chatInRoom="aiStore.chatInRoom"
            :userAvatar = userAvatar
            :initials= initials
            :AI_initials= AI_initials
        ></new-chat-page>


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
