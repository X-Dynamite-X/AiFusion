<!-- App.vue -->
<script setup>
import { onMounted, computed, ref } from "vue";
import { useAuthStore } from "../../../stores/auth";
// import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
//    import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'

const authStore = useAuthStore();
   const logout = authStore.handleLogout
   const initials = computed(() => {

return authStore.user?.name
 ? authStore.user.name.charAt(0).toUpperCase()
 : "";
});
   const isSidebarOpen = ref(false);
   const toggleSidebar =()=>{
       isSidebarOpen.value = !isSidebarOpen.value;
   }


 </script>

<template>
   <div class="flex h-screen bg-gray-100">
     <!-- Sidebar -->
     <aside class="w-64 bg-gray-800" :class="{'block': isSidebarOpen, 'hidden': !isSidebarOpen}">
       <div class="p-4">
         <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Logo">
       </div>
       <nav class="mt-5 px-2">
         <ul class="space-y-2 font-medium">
           <li>
             <router-link :to="{ name: 'home' }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                   <path fill-rule="evenodd" d="M17 4.25A2.25 2.25 0 0 0 14.75 2h-5.5A2.25 2.25 0 0 0 7 4.25v2a.75.75 0 0 0 1.5 0v-2a.75.75 0 0 1 .75-.75h5.5a.75.75 0 0 1 .75.75v11.5a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 0-1.5 0v2A2.25 2.25 0 0 0 9.25 18h5.5A2.25 2.25 0 0 0 17 15.75V4.25Z" clip-rule="evenodd" />
                   <path fill-rule="evenodd" d="M1 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H1.75A.75.75 0 0 1 1 10Z" clip-rule="evenodd" />
               </svg>
               <span class="ms-3">App</span>
             </router-link>
           </li>
           <li>
             <router-link :to="{ name: 'adminHome' }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
               </svg>
               <span class="ms-3">User</span>
             </router-link>
           </li>
           <li>
             <router-link :to="{ name: 'adminPostUser' }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
               </svg>
               <span class="ms-3">Posts</span>
             </router-link>
           </li>
           <li>
             <router-link :to="{ name: 'roles' }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
               </svg>
               <span class="ms-3">Roles</span>
             </router-link>
           </li>

         </ul>
       </nav>
     </aside>

     <!-- Main content -->
     <div class="flex flex-col flex-1 w-0">
       <!-- Top Navbar -->
       <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow items-center justify-between px-4">
         <button @click="toggleSidebar" class="border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
           <span class="sr-only">Open sidebar</span>
           <!-- استخدم أيقونات Tailwind أو أي مكتبة أيقونات -->
           <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
           </svg>
         </button>

         <!-- إضافة flex-grow لـ navbar items حتى تكون المساحة في الوسط مرنة -->
         <div class="flex-grow flex items-center justify-end space-x-4">
           <!-- الأيقونات -->
           <router-link :to="{name:'profile'}">
                   <p class='text-gray-800 hover:bg-gray-200 hover:text-black rounded-md px-3 py-2 text-sm font-medium'> {{authStore.user?.name}}</p>
               </router-link>
               <button type="button" class="relative rounded-full bg-gray-100 p-1 text-gray-600 hover:text-black focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                   <span class="absolute -inset-1.5" />
               <span class="sr-only">View notifications</span>
               <BellIcon class="h-6 w-6" aria-hidden="true" />
               </button>

           <!-- Profile dropdown -->
           <Menu as="div" class="relative ml-3">
             <div>
               <MenuButton class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                 <span class="absolute -inset-1.5" />
                 <span class="sr-only">Open user menu</span>
                 <span class="h-8 w-8 bg-gray-800 text-white rounded-full flex items-center justify-center font-bold" >{{ initials }}</span>
               </MenuButton>
             </div>
             <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
               <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                 <MenuItem v-slot="{ active }">
                   <router-link :to="{name:'profile'}"
                   :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Your Profile</router-link>
                 </MenuItem>
                 <MenuItem v-slot="{ active }">
                   <a href="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Settings</a>
                 </MenuItem>
                 <MenuItem v-slot="{ active }" v-if="authStore.user">
                   <button @click="logout" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Sign out</button>

                 </MenuItem>
               </MenuItems>
             </transition>
           </Menu>

         </div>
       </div>

       <main class="flex-1 relative overflow-y-auto focus:outline-none">
        <slot></slot>
       </main>
     </div>
   </div>
 </template>
<!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
   <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
 </svg> -->
