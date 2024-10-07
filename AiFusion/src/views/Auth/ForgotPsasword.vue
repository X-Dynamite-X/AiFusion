<script setup>
    import { ref } from "vue";
    import { useAuthStore } from '../../stores/auth';
    const  authStore = useAuthStore();

    const forgotPsasword =authStore.handelForgotPsasword
    const email = ref('');
</script>

<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" @submit.prevent="forgotPsasword(email)">
          <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Your email</label>
            <div class="mt-2">
              <input id="email" v-model="email" placeholder="email@example.com " name="email" type="email" autocomplete="email" required="" class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
            <div v-if="authStore.erroes.email"  >
                <span  class="text-red-700 text-sm m-2 p-2"> {{ authStore.authErrors.email[0] }}</span>
            </div>
          </div>
          <div v-if="authStore.status" class="m-2 p-2 text-green-900 font-semibold bg-green-300 rounded-md">
        {{  authStore.status }}
      </div>
          <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" >Submit</button>
          </div>
        </form>


      </div>
    </div>
  </template>
