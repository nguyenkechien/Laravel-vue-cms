<template>
  <v-container>
    <v-progress-linear
      v-if="isLoading"
      color="light-blue lighten-2"
      indeterminate
      rounded
      height="4"
    ></v-progress-linear>
    <v-simple-table v-else :loading="isLoading">
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">Name</th>
            <th class="text-left">Email</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </v-container>
</template>

<script>
import UserService from "./../../services/UserService";

export default {
  name: "User",
  data: () => {
    return {
      user: null,
      isLoading: true
    };
  },
  async mounted() {
    if (!this.user) {
      await UserService.index()
        .then(({ data }) => {
          this.user = data;
          this.isLoading = false;
        })
        .catch(err => console.log(err));
    }
  }
};
</script>
