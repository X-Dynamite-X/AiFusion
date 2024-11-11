import { defineStore } from "pinia";
import axios from "axios";
import { useAuthStore } from './auth';

export const useAiStore = defineStore('ai', {
    state: () => ({
        allChatRooms: [],
        allAiChats: [],
        allChatInRoom: [],
        allProvider: [],
    }),
    getters: {
        chatRooms: (state) => state.allChatRooms,
        aiChats: (state) => state.allAiChats,
        chatInRoom: (state) => state.allChatInRoom,
        providers: (state) => state.allProvider,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async fetchProvidersWithModels() {
            try {
              const response = await axios.get('/api/providers-with-models');
              this.allProvider = response.data;
              console.log(this.allProvider);
            } catch (error) {
              console.error("Error fetching providers and models:", error);
            }
          },
        async getChatsRoom(apiProviderName, aiModelName, roomId) {


            const response = await axios.get(`/api/${apiProviderName}/getChatInRoom/${roomId}`);
            this.allChatInRoom = response.data;
            console.log(response.data);
        },
        async sendMessageInNewRoom(apiProviderName, aiModelName, message) {
            console.log(message);
            const authStore = useAuthStore();
            const userId = authStore.user.id;

            try {
                const response = await axios.post(`/api/${apiProviderName}/createRooms`, {
                    prompt: message.value,

                    aiModelName:aiModelName,
                });
                console.log(`response ${response.data}`);

                if (response.data && response.data.userMessage && response.data.reply && response.data.room) {
                    const newRoom = {
                        id: response.data.room.id,
                        name: response.data.room.name,
                        created_at: response.data.room.created_at,
                        updated_at: response.data.room.updated_at,
                    };

                    const newMessage = {
                        chat_room_id: newRoom.id,
                        sender_id: userId,
                        message_text: message.value,
                        replies: [],
                    };

                    this.allChatRooms.push(newRoom);
                    this.router.push({
                        name: 'aiRoom',
                        params: {apiProviderName:apiProviderName, aiModelName:aiModelName,aiRoomName: newRoom.name },
                        query: { aiRoomId: newRoom.id }
                    });
                    this.allChatInRoom.push(newMessage);

                    const latestMessage = this.allChatInRoom.find(msg => msg.id === newMessage.id);
                    if (latestMessage) {
                        latestMessage.id = response.data.userMessage.id;
                        latestMessage.message_text = response.data.userMessage.message_text;
                        latestMessage.created_at = response.data.userMessage.created_at;
                        latestMessage.updated_at = response.data.userMessage.updated_at;
                        latestMessage.replies.push({
                            id: response.data.reply.id,
                            message_id: response.data.reply.message_id,
                            sender_id: response.data.reply.sender_id,
                            reply_text: response.data.reply.reply_text,
                            created_at: response.data.reply.created_at,
                            updated_at: response.data.reply.updated_at
                        });
                    }
                    console.log(latestMessage);
                }
            } catch (error) {
                console.error('Error sending message:', error);
            }
        },
        async sendMessage(apiProviderName, aiModelName, roomId, message) {
            const authStore = useAuthStore();
            const userId = authStore.user.id;
            const newMessage = {
                chat_room_id: roomId,
                sender_id: userId,
                message_text: message.value,
                replies: [],
            };
            this.allChatInRoom.push(newMessage);

            try {
                const response = await axios.post(`/api/${apiProviderName}/generate-text/${roomId}`, {
                    prompt: message.value,
                    aiModelName:aiModelName,
                });

                if (response.data && response.data.userMessage && response.data.reply) {
                    const latestMessage = this.allChatInRoom.find(msg => msg.id === newMessage.id);
                    if (latestMessage) {
                        latestMessage.id = response.data.userMessage.id;
                        latestMessage.message_text = response.data.userMessage.message_text;
                        latestMessage.created_at = response.data.userMessage.created_at;
                        latestMessage.updated_at = response.data.userMessage.updated_at;
                        latestMessage.replies.push({
                            id: response.data.reply.id,
                            message_id: response.data.reply.message_id,
                            sender_id: response.data.reply.sender_id,
                            reply_text: response.data.reply.reply_text,
                            created_at: response.data.reply.created_at,
                            updated_at: response.data.reply.updated_at
                        });
                    }
                    console.log(latestMessage);
                }
            } catch (error) {
                console.error('Error sending message:', error);
            }
        }
    }
});
