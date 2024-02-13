// Composables
import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    component: () => import("@/layouts/Init.vue"),
    children: [
      {
        path: "/",
        name: "Home",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
          import( "@/layouts/main/company/list/list.vue"),
      },
      {
        path: "/company/list",
        name: "CompanyList",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
          import( "@/layouts/main/company/list/list.vue"),
      },
      {
        path: "/company/record",
        name: "CompanyRecord",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        props: { mode: 'new' },
        component: () =>
          import( "@/layouts/main/company/record/record.vue"),
      },
      {
        path: "/company/record/:id",
        name: "CompanyEdit",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        props: true,
        component: () =>
          import( "@/layouts/main/company/record/record.vue"),
      },
      {
        path: "/customer/list",
        name: "CustomerList",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
          import( "@/layouts/main/customer/list/list.vue"),
        },
      {
        path: "/customer/record",
        name: "CustomerRecord",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        props: { mode: 'new' },
        component: () =>
          import( "@/layouts/main/customer/record/record.vue"),
      },
      {
        path: "/customer/record/:id",
        name: "CustomerEdit",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        props: true,
        component: () =>
          import( "@/layouts/main/customer/record/record.vue"),
      },      
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
