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
    // AI Room Route
    {
        path: "/:apiProviderName/:aiModelName/:aiRoomName",
        component: Home,
        name: "aiRoom",
        props: (route) => ({
            apiProviderName: route.params.apiProviderName,
            aiModelName: route.params.aiModelName,
            aiRoomName: route.params.aiRoomName,
            aiRoomId: route.query.aiRoomId,
        }),

        beforeEnter: (to, from, next) => {
            // Ensure aiRoomId exists in the query before entering the route
            if (!to.query.aiRoomId) {
                return next({ name: "home" });
            }
            next();
        },
    },
    // Route for creating a new chat room
    {
        path: "/:apiProviderName/:aiModelName/newChat",
        component: Home,
        name: "aiNewRoom",
        props: (route) => ({
            apiProviderName: route.params.apiProviderName,
            aiModelName: route.params.aiModelName,
        }),
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
