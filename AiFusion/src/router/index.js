import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../stores/auth";

// استيراد المكونات
import Home from "../views/Home.vue"
import Login from "../views/Auth/Login.vue"
import Register from "../views/Auth/Register.vue"
import ForgotPsasword from "../views/Auth/ForgotPsasword.vue"
// import ResetPassword from "../views/Auth/ResetPassword.vue"
// import NotFound from "../views/NotFound.vue";  // استيراد صفحة 404

const routes = [
  // المسارات المسجلة
  {
    path: "/",
    component: Home,
    name: "home"
  },
  {
    path: "/login",
    component: Login,
    name: "login"
  },
  {
    path: "/register",
    component: Register,
    name: "register"
  },
  {
    path: "/forgot-psasword",
    component: ForgotPsasword,
    name: "ForgotPsasword"
  },
//   {
//     path: "/password-reset/:token",
//     component: ResetPassword,
//     name: "ResetPassword"
//   },

  // المسار لمطابقة أي مسار غير مسجل - صفحة 404
//   {
//     path: "/:catchAll(.*)",  // يلتقط أي مسار غير مسجل
//     component: NotFound,
//     name: "NotFound",
//   }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore();

  // التحقق من وجود بيانات المستخدم
  if (!authStore.user) {
    try {
      await authStore.getUser();
    } catch (error) {
      return next({ name: 'login' });
    }
  }

  const isAuthenticated = authStore.user;

  // التحقق من الصلاحيات
 if (
    isAuthenticated &&
    (to.name === 'login' || to.name === 'register' || to.name === 'ForgotPsasword' || to.name === 'ResetPassword'))
    {
    next({ name: 'adminHome' });
  } else if (!isAuthenticated && to.name !== 'login' && to.name !== 'register' && to.name !== 'ForgotPsasword' && to.name !== 'ResetPassword') {
    next({ name: 'login' });
  } else {
    next();
  }
});

export default router;
