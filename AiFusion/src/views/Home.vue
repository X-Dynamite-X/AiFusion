<script setup>
import { ref, computed, onMounted, watch } from "vue";
import { useAuthStore } from "../stores/auth";
import { useAiStore } from "../stores/aiChat";
import { useRoute, useRouter } from "vue-router";
import AsideBare from "./AiRoom/AsideBare.vue";
import ChatPage from "./AiRoom/ChatPage.vue";
import NewChatPage from "./AiRoom/NewChatPage.vue";
import Spinner from "@/components/layouts/spinner.vue";

const router = useRouter(); // نحتاج استخدام useRouter للتنقل بين الغرف بدون تحديث الصفحة
const route = useRoute();
const authStore = useAuthStore();
const aiStore = useAiStore();
const isLoading = ref(false);
const apiProviderName = route.params.apiProviderName;
const aiModelName = route.params.aiModelName;
const aiRoomId = route.query.aiRoomId
// const roomId = ref("") ;

const userAvatar = computed(() => {
    return authStore.user?.avatar ? authStore.user.avatar : "";
});
const initials = computed(() => {
    return authStore.user?.name
        ? authStore.user.name.charAt(0).toUpperCase()
        : "";
});
const AI_initials = "AI".toUpperCase();

const loadRoomChats = async (apiProviderName,aiModelName,roomId) => {
    isLoading.value = true;
    await aiStore.getChatsRoom( apiProviderName
        , aiModelName,roomId);
    isLoading.value = false;
};

onMounted(async () => {
    isLoading.value = true;
    aiStore.fetchProvidersWithModels();
    if (route.name === "aiRoom") {
        await loadRoomChats(apiProviderName,aiModelName,aiRoomId);
    }
    isLoading.value = false;
});

watch(
    () => route.query.aiRoomId,
    (newRoomId) => {
        if (newRoomId) {
            loadRoomChats(apiProviderName,aiModelName,newRoomId);
        }
    }
);
const changeRoom = (apiProviderName,model,roomId) => {
    console.log(apiProviderName);
    console.log(model);
    console.log(roomId);
    router.push({ query: {aiRoomId: roomId } });


//     // loadRoomChats(apiProviderName,model,roomId);
};


    // console.log(provider.name);

</script>

<template>
    <div class="flex h-[94vh]">
        <aside-bare
            :rooms="aiStore.chatRooms"
            :providers = aiStore.providers

        ></aside-bare>

        <chat-page v-if="route.name === 'aiRoom' && !isLoading"
            :chatInRoom="aiStore.chatInRoom"
            :userAvatar="userAvatar"
            :initials="initials"
            :AI_initials="AI_initials"
            :apiProviderName="apiProviderName"
            :aiModelName="aiModelName"

        ></chat-page>

        <spinner v-if="isLoading"></spinner>

        <new-chat-page v-if="route.name === 'aiNewRoom' && !isLoading"
            :chatInRoom="aiStore.chatInRoom"
            :userAvatar="userAvatar"
            :initials="initials"
            :AI_initials="AI_initials"
            :apiProviderName="apiProviderName"
            :aiModelName="aiModelName"

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
