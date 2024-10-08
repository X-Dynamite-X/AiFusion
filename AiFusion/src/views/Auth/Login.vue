<script setup>
    import { ref } from "vue";
    import { useAuthStore } from '../../stores/auth';
    const  authStore = useAuthStore();
    const login = authStore.handleLogin
    const form = ref({
        email: "",
        password: "",
    });
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

        <p class="mt-10 text-center text-sm text-gray-500">
            Are you don't have account?
            {{ ' ' }}
            <router-link :to="{name:'register'}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register</router-link>
        </p>
      </div>
    </div>
  </template>
