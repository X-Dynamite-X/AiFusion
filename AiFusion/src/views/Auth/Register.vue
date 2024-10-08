<script setup>
    import { ref } from 'vue'
    import { useAuthStore } from '../../stores/auth';
    const  authStore = useAuthStore();
    const signup = authStore.handleRegister
    const form = ref({
        name: '',
        email:'',
        password:'',
        password_confirmation:'',
    });

</script>
<template>

    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign up to your account</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" @submit.prevent="signup(form)" method="POST">
            <div>
            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">User Name</label>
            <div class="mt-2">
              <input id="username"  name="username" type="text" v-model="form.name" autocomplete="username"  placeholder="User Name" class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
            <div v-if="authStore.erroes.name"  >
                <span class="text-red-700 text-sm m-2 p-2"> {{ authStore.erroes.name[0] }}</span>
            </div>
          </div>
          <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
            <div class="mt-2">
              <input id="email" name="email" type="email"  v-model="form.email" autocomplete="email"  placeholder="Email Address"  class="block  p-2  w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
            <div v-if="authStore.erroes.email"  >
                <span class="text-red-700 text-sm m-2 p-2"> {{ authStore.erroes.email[0] }}</span>
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            </div>
            <div class="mt-2">
              <input id="password" name="password"  v-model="form.password" type="password" placeholder="password" autocomplete="current-password"  class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
            <div v-if="authStore.erroes.password"  >
                <span  class="text-red-700 text-sm m-2 p-2"> {{ authStore.erroes.password[0] }}</span>
            </div>
          </div>
          <div>
            <div class="flex items-center justify-between">
              <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Password Confirmation</label>
            </div>
            <div class="mt-2">
              <input id="password_confirmation" v-model="form.password_confirmation" name="password_confirmation" placeholder="password confirmation" type="password" autocomplete="current-password"  class=" p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
          </div>

          <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
          </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
          Are you alredy register?
          {{ ' ' }}
          <router-link :to="{name:'login'}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Login</router-link>
        </p>
      </div>
    </div>
  </template>

