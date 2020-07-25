<template>
  <div>
    <v-progress-linear
      v-if="isLoading"
      color="light-blue lighten-2"
      indeterminate
      rounded
      height="4"
    ></v-progress-linear>
    <template v-else>
      <v-container>
        <v-row>
          <v-col>
            <base-bar-chart />
          </v-col>
        </v-row>
      </v-container>
    </template>
  </div>
</template>

<script>
import { mapState, mapMutations } from "vuex";
import PageService from "./../../services/PageService";

export default {
  name: "Dashboard",
  components: {},
  computed: {
    ...mapState(["pages"]),
  },
  methods: {
    ...mapMutations({
      setPages: "SET_PAGES",
    }),
  },
  data: () => {
    return {
      isLoading: true,
    };
  },
  async mounted() {
    if (!this.pages.length) {
      await PageService.index()
        .then(({ data: { data } }) => {
          this.setPages(data);
        })
        .catch((err) => {
          this.isLoading = true;
          console.log(err);
        });
    }
    this.isLoading = false;
  },
};
</script>
