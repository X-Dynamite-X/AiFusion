<script setup>
import { ref, computed, onMounted,watch  } from "vue";
import { useAuthStore } from "../stores/auth";
import { useAiStore } from "../stores/aiChat";
import { useRoute, useRouter } from "vue-router";
import AsideBare from "./AiRoom/AsideBare.vue";
import ChatPage from "./AiRoom/ChatPage.vue";
import NewChatPage from "./AiRoom/NewChatPage.vue";


const router = useRouter(); // نحتاج استخدام useRouter للتنقل بين الغرف بدون تحديث الصفحة
const route = useRoute();
const authStore = useAuthStore();
const aiStore = useAiStore();
const userAvatar = computed(() => {
    return authStore.user?.avatar ? authStore.user.avatar : "";
});
const initials = computed(() => {
    return authStore.user?.name
        ? authStore.user.name.charAt(0).toUpperCase()
        : "";
});
const AI_initials = "AI".toUpperCase();

onMounted(() => {
    aiStore.getAllRooms();
    aiStore.getChatsRoom(route.query.aiRoomId); // جلب محادثات الغرفة الحالية بناءً على المعرف
});
watch(
    () => route.query.aiRoomId,
    (newRoomId) => {
        if (newRoomId) {
            aiStore.getChatsRoom(newRoomId); // تحديث المحادثات عند تغير المعرف
        }
    }
);

// دالة لتغيير الغرفة دون تحديث الصفحة
const changeRoom = (roomId) => {
    router.push({ query: { aiRoomId: roomId } });
};
console.log(route.path);
console.log(route.name);
console.log( route.name =='aiRoom');
console.log( route.name =='aiNewRoom');





</script>
<template>
    <div class="flex h-[94vh]">
        <!-- <aside-bare
            :rooms="aiStore.chatRooms"></aside-bare> -->
            <aside-bare
            :rooms="aiStore.chatRooms"
            @change-room="changeRoom"
        ></aside-bare>

        <chat-page v-if="route.name =='aiRoom'"
            :chatInRoom="aiStore.chatInRoom"
            :userAvatar = userAvatar
            :initials= initials
            :AI_initials= AI_initials
        ></chat-page>

        <new-chat-page v-if="route.name =='aiNewRoom'"
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
