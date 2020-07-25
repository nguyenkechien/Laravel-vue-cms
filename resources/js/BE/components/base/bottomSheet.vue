<template>
  <div class="text-center">
    <v-bottom-sheet v-model="sheet">
      <v-sheet class="text-center" height="200px">
        <v-btn class="mt-6" dark color="red" @click="sheet = !sheet">close</v-btn>
        <div class="py-3">{{ message }}</div>
      </v-sheet>
    </v-bottom-sheet>
  </div>
</template>

<script>
export default {
  name: "bootomSheet",
  props: {
    opentSheet: {
      type: Boolean,
      default: () => false
    },
    message: {
      type: String,
      default: ""
    }
  },
  computed: {
    sheet: {
      get() {
        return this.opentSheet;
      },
      set(value) {
        this.$emit("update:opentSheet", value);
      }
    }
  }
};
</script>
