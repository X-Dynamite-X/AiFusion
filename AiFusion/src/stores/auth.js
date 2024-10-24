import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore('auth', {
  state: () => ({
    authUser: null,
    authErrors: [],
    authStatus: null,
  }),
  getters: {
    user: (state) => state.authUser,
    erroes: (state) => state.authErrors,
    status: (state) => state.authStatus,
  },
  actions: {
    async getToken() {
      const { data }= await axios.get('/sanctum/csrf-cookie');
      console.log(data);

    },
    async getUser() {
      await this.getToken();
      try {
        const { data } = await axios.get("/api/user");
        this.authUser = data;
      } catch {
        this.authUser = null;
      }
    },
    async handleLogin(data) {
      await this.authenticate("/login", data, "/");
    },
    async handleRegister(data) {
      await this.authenticate("/register", data, "/login");
    },
    async authenticate(endpoint, data, redirectPath) {
      this.authErrors = [];
      await this.getToken();
      try {
        await axios.post(endpoint, data);
        if(endpoint === "/register"){
            await this.handleLogout();
        }
        this.router.push(redirectPath);
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.authErrors = error.response.data.errors;
        }
      }
    },
    async handleLogout() {
      await axios.post('/logout');
      this.router.push("/login");
      this.authUser = null;
    },
    async handleForgotPassword(data) {
      await this.processRequest('/forgot-password', { email: data });
    },
    async handleResetPassword(resetData) {
      await this.processRequest('/reset-password', resetData, '/login');
    },
    async processRequest(endpoint, data, redirectPath = null) {
      this.authErrors = [];
      await this.getToken();
      try {
        const response = await axios.post(endpoint, data);
        if (redirectPath) {
          this.router.push(redirectPath);
        } else {
          this.authStatus = response.data.status;
        }
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.authErrors = error.response.data.errors;
        }
      }
    },
    async updateProfile(data) {
      try {
        const { data: profileData } = await axios.put(`/api/v1/user/update`, data);
        this.router.push('/profile');
        this.authUser = profileData.profile;
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.authErrors = error.response.data.errors;
        }
      }
    },
    async handleGitHubLogin(provider) {
        try {
            const { data } = await axios.get(`http://192.168.1.204:8000/api/${provider}/login`);
            console.log(data);
            if (data) {
                window.location.href = data;
            }
        } catch (error) {
            console.error(`Error during ${provider} login:`, error);
        }

    },
    async handleGitHubCallback(provider,code) {
        try {
          const { data } = await axios.get(`http://192.168.1.204:8000/api/${provider}/callback?code=${code}`);
          console.log(data);
          this.authUser = data.user;
        } catch (error) {
          console.error("Error during GitHub callback:", error);
        }
      },
      async test() {
        try {
          const { data } = await axios.get(`http://192.168.1.204:8000/api/test`);
          console.log(data);
        } catch (error) {
          console.error("Error during GitHub callback:", error);
        }
      },
  }
});
