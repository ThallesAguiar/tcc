import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Login",
    component: () => import("../views/auth/Login.vue"),
  },
  {
    path: "/registerCompany",
    name: "registerCompany",
    component: () => import("../views/company/registerCompany.vue"),
  },
  {
    path: "/home",
    name: "Home",
    component: () => import("../views/Home.vue"),
    children: [
      {
        path: "/feed",
        name: "Feed",
        component: () => import("../views/Feed.vue"),
      },
      {
        path: "/map",
        name: "Map",
        component: () => import("../views/Map.vue"),
      },
      {
        path: "/friend/:id",
        name: "Friend",
        component: () => import("../views/Friend.vue"),
      },
      {
        path: "/config",
        name: "Config",
        component: () => import("../views/Config.vue"),
      },
    ],
  },
  // {
  //   path: '/map',
  //   name: 'Map',
  //   component: () => import('../views/Map.vue')
  // },
  // {
  //   path: '/config',
  //   name: 'Config',
  //   component: () => import('../views/Config.vue')
  // },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
