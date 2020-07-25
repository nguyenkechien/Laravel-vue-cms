<template>
  <v-container>
    <categories-blog />
    <categories-products />
  </v-container>
</template>

<script>
export default {
  name: "Category",
  components: {
    "categories-blog": () => import("./_blog"),
    "categories-products": () => import("./_products")
  }
};
</script>
