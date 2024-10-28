import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../stores/auth";

// استيراد المكونات
import Home from "../views/Home.vue";
import Login from "../views/Auth/Login.vue";
import Register from "../views/Auth/Register.vue";
import ForgotPassword from "../views/Auth/ForgotPsasword.vue";
import ResetPassword from "../views/Auth/ResetPassword.vue";
import NotFound from "../views/Errors/NotFound.vue";
import ProviderCallbackView from "../views/Auth/ProviderCallbackView.vue";

const routes = [
    { path: "/", component: Home, name: "home" },
    // Auth route
    { path: "/login", component: Login, name: "login" },
    {
        path: "/:provider/callback",
        component: ProviderCallbackView,
        name: "ProviderCallback",
    },
    { path: "/register", component: Register, name: "register" },
    {
        path: "/forgot-password",
        component: ForgotPassword,
        name: "ForgotPassword",
    },
    {
        path: "/password-reset/:token",
        component: ResetPassword,
        name: "ResetPassword",
    },
    // Ai app Room Route
    {
        path: "/:aiRoomName",
        component: Home,
        name: "aiRoom",
        props: (route) => ({
            aiRoomName: route.params.aiRoomName,
            aiRoomId: route.params.aiRoomId,
        }),
        beforeEnter: (to, from, next) => {
            to.params.aiRoomId = to.query.aiRoomId;
            next();
        },
    },
    {
        path: "/newChat",
        component: Home,
        name: "aiNewRoom",

    },
    // Errors route
    { path: "/:catchAll(.*)", component: NotFound, name: "NotFound" },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore();

    if (!authStore.user) {
        try {
            await authStore.getUser();
        } catch {
            return next({ name: "login" });
        }
    }

    const publicPages = [
        "login",
        "register",
        "ForgotPassword",
        "ResetPassword",
        "ProviderCallback",
    ];
    const authRequired = !publicPages.includes(to.name);

    if (authStore.user && publicPages.includes(to.name)) {
        return next({ name: "home" });
    } else if (!authStore.user && authRequired) {
        return next({ name: "login" });
    } else {
        next();
    }
});

export default router;
