<script setup>
    import { ref } from "vue";
    import { useAuthStore } from '../../stores/auth';
    const  authStore = useAuthStore();
    const login = authStore.handleLogin
    const form = ref({
        email: "",
        password: "",
    });
    const loginWithGitHub = () => {
  authStore.handleGitHubLogin('github');
};
</script>


<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" @submit.prevent="login(form)" method="POST">
          <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
              <input id="email" placeholder="Email Address : " v-model="form.email" name="email" type="email" autocomplete="email" class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
            <div v-if="authStore.erroes.email"  >

                <span class="text-red-700 text-sm m-2 p-2"> {{ authStore.erroes.email[0] }}</span>
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
              <div class="text-sm">
                <router-link :to="{name:'ForgotPassword'}" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</router-link>
              </div>
            </div>
            <div class="mt-2">
              <input id="password" placeholder="Password: "  v-model="form.password" name="password" type="password" autocomplete="current-password"  class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
            <div v-if="authStore.erroes.password"  >
                <span  class="text-red-700 text-sm m-2 p-2"> {{ authStore.erroes.password[0] }}</span>
            </div>
          </div>

          <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
          </div>
        </form>
        <div>
            <button type="submit" @click="loginWithGitHub" class="flex w-full justify-center items-center gap-2 rounded-md bg-black px-4 py-2 my-4 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="white">
                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.799 8.207 11.387.6.111.793-.261.793-.58v-2.044c-3.338.726-4.042-1.61-4.042-1.61-.546-1.387-1.334-1.757-1.334-1.757-1.091-.746.083-.73.083-.73 1.207.084 1.843 1.24 1.843 1.24 1.07 1.834 2.809 1.303 3.493.997.107-.776.419-1.303.762-1.602-2.665-.3-5.466-1.334-5.466-5.933 0-1.312.469-2.387 1.238-3.23-.124-.302-.536-1.52.117-3.164 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.004-.404 1.02.005 2.047.138 3.005.404 2.291-1.552 3.297-1.23 3.297-1.23.655 1.643.242 2.862.118 3.164.77.843 1.238 1.918 1.238 3.23 0 4.61-2.805 5.63-5.476 5.922.432.374.816 1.106.816 2.229v3.305c0 .322.192.695.8.579C20.566 21.795 24 17.298 24 12 24 5.37 18.63 0 12 0z"/>
                </svg>
                Login With GitHub
            </button>
        </div>

        <p class="mt-10 text-center text-sm text-gray-500">
            Are you don't have account?
            {{ ' ' }}
            <router-link :to="{name:'register'}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register</router-link>
        </p>
      </div>

    </div>
  </template>
