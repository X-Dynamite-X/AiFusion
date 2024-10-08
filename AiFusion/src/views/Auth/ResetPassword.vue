<script setup>
    import { ref } from "vue";
    import { useAuthStore } from '../../stores/auth';
    import { useRoute } from 'vue-router';
    const route = useRoute();
    const  authStore = useAuthStore();
    const resetPassword = authStore.handleResetPassword

    const form = ref({

        password:'',
        password_confirmation:'',
        token:route.params.token,
        email:route.query.email
    });
</script>


<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Reset Password</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" @submit.prevent="resetPassword(form)" method="POST">
            <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            </div>
            <div class="mt-2">
              <input id="password" name="password"  v-model="form.password" type="password" placeholder="password" autocomplete="current-password"  class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
            <div v-if="authStore.authErrors.password"  >
                <span  class="text-red-700 text-sm m-2 p-2"> {{ authStore.authErrors.password[0] }}</span>
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
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Reset Password
            </button>
          </div>
        </form>


      </div>
    </div>
  </template>
