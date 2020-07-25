import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
  mode: "history",
  base: "/admin",
  routes: [
    {
      path: "/",
      component: () => import("@/js/BE/views/index.vue"),
      children: [
        {
          name: "Dashboard",
          path: "",
          component: () => import("@/js/BE/pages/Dashboard/index.vue")
        },
        {
          name: "Notifications",
          path: "notifications",
          component: () => import("@/js/BE/pages/Notifications/index.vue")
        },
        {
          name: "Tables",
          path: "tables",
          component: () => import("@/js/BE/views/Tables.vue"),
          children: [
            {
              name: "Products",
              path: "product-tables",
              component: () => import("@/js/BE/pages/Products/index.vue")
            },
            {
              name: "Blog",
              path: "blog-tables",
              component: () => import("@/js/BE/pages/Blog/index.vue")
            },
            {
              name: "Category",
              path: "category-tables",
              component: () => import("@/js/BE/pages/Category/index.vue")
            },
          ]
        },
        {
          name: "Content",
          path: "content",
          component: () => import("@/js/BE/views/Tables.vue"),
          children: [
            {
              name: "Pages",
              path: "pages",
              component: () => import("@/js/BE/pages/Pages/index.vue")
            },
            {
              name: "Blocks",
              path: "blocks",
              component: () => import("@/js/BE/pages/Blocks/index.vue")
            },
          ]
        },
        {
          name: "User",
          path: "user-profile",
          component: () => import("@/js/BE/pages/User/index.vue")
        },
        {
          path: "logout",
          name: "Logout",
          component: () => import("@/js/BE/components/Logout.vue")
        },
      ],
    },
    {
      path: "*",
      name: "Not Found",
      component: () => import("@/js/BE/components/NotFound.vue")
    }
  ]
});
