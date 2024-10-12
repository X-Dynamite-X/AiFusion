<script setup>
    import {  computed } from "vue";
    import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
    import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'
    import { useAuthStore } from "../../stores/auth";

    const authStore = useAuthStore();
    const logout = authStore.handleLogout

    const userAvatar = computed(() => {
  return authStore.user?.name ? authStore.user.avatar : "";
});
    const initials = computed(() => {
    return authStore.user?.name
  ? authStore.user.name.charAt(0).toUpperCase()
  : "";
});
    // const avatar =authStore.user.avatar;
</script>

<template>
    <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
            <!-- Mobile menu button-->
            <DisclosureButton class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
              <span class="absolute -inset-0.5" />
              <span class="sr-only">Open main menu</span>
              <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
              <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
            </DisclosureButton>
          </div>
          <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
            <div class="flex flex-shrink-0 items-center">
              <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
            </div>
            <div class="hidden sm:ml-6 sm:block">
              <div class="flex space-x-4">
                <template v-if="!authStore.user">
                    <router-link class='text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium' :to="{name : 'login'}" >Login</router-link>
                    <router-link class='text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium' :to="{name : 'register'}" >Register</router-link>
                </template>
                <template v-else>
                    <router-link class='text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium' :to="{name : 'home'}" >Home</router-link>

                    <!-- <router-link v-if="authStore.user.roles[0].name === 'admin'"
                    class='text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium' :to="{name : 'adminHome'}" >Admin</router-link> -->

                </template>

              </div>
            </div>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            <template v-if="authStore.user">
                <!-- <router-link :to="{name:'profile'}">
                    <p class='text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium'> {{authStore.user?.name}}</p>
                </router-link> -->
                <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                <span class="absolute -inset-1.5" />
                <span class="sr-only">View notifications</span>
                <BellIcon class="h-6 w-6" aria-hidden="true" />
                </button>
            <Menu as="div" class="relative ml-3">
              <div>
                <MenuButton class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                  <span class="absolute -inset-1.5" />
                  <span class="sr-only">Open user menu</span>
                  <!-- <span class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center font-bold" v-if="authStore.user.avatar" ><img src="authStore.user.avatar " alt=""></span> -->
                  <img class="inline-block h-8 w-8 rounded-full ring-1  ring-white" :src="userAvatar "  v-if="userAvatar" alt="" />
                  <span class="h-8 w-8 bg-gray-200 rounded-full flex items-center ring-2 ring-white justify-center font-bold" v-else >{{ initials }}</span>
                  <!-- <img src="{{userAvatar}}" alt=""> -->

                    <!-- <p class="text-white"> {{ userAvatar }}</p> -->
                </MenuButton>
              </div>
              <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                  <!-- <MenuItem v-slot="{ active }">
                    <router-link :to="{name:'profile'}"
                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Your Profile</router-link>
                  </MenuItem> -->
                  <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Settings</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }" v-if="authStore.user">
                    <button @click="logout" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Sign out</button>

                  </MenuItem>
                </MenuItems>
              </transition>
            </Menu>

        </template>

          </div>
        </div>
      </div>

    <DisclosurePanel class="sm:hidden">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <template v-if="!authStore.user">
                <router-link class='text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium' :to="{name : 'login'}" >Login</router-link>
                <router-link class='text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium' :to="{name : 'register'}" >Register</router-link>
            </template>
            <template v-else>
                <router-link class='text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium' :to="{name : 'home'}" >Home</router-link>
                <!-- <router-link class='text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium' :to="{name : 'adminHome'}" >Admin</router-link> -->
            </template>
        </div>
      </DisclosurePanel>
    </Disclosure>
  </template>
