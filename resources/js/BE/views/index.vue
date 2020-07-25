<template>
  <v-app>
    <dashboard-core-app-bar />
    <dashboard-core-drawer />
    <dashboard-core-view />
  </v-app>
</template>

<script>
export default {
  name: "DashboardIndex",
  components: {
    DashboardCoreAppBar: () => import("./../core/AppBar.vue"),
    DashboardCoreDrawer: () => import("./../core/Drawer.vue"),
    DashboardCoreView: () => import("./../core/View.vue")
  }
};
</script>

<style>
</style>
