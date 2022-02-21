import Vue from "vue"
import VueRouter from "vue-router"

// Inizio sezione import
import Home from "./pages/Home.vue"
import Search from "./pages/Search.vue"
// Fine sezione import

Vue.use(VueRouter)

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/search",
            name: "search",
            component: Search,
        }
    ],
})

export default router