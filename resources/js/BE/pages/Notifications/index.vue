<template>
  <div>
    <v-progress-linear
      v-if="isLoading"
      color="light-blue lighten-2"
      indeterminate
      rounded
      height="4"
    ></v-progress-linear>
  </div>
</template>

<script>
export default {
  name: "Notifications",
  data: () => {
    return {
      isLoading: true
    };
  }
};
</script>
