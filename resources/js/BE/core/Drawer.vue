<template>
  <v-navigation-drawer
    id="core-navigation-drawer"
    v-model="drawer"
    :dark="barColor !== 'rgba(228, 226, 226, 1), rgba(255, 255, 255, 0.7)'"
    :expand-on-hover="expandOnHover"
    :right="$vuetify.rtl"
    :src="barImage"
    mobile-break-point="960"
    app
    width="260"
    v-bind="$attrs"
  >
    <template v-slot:img="props">
      <v-img :gradient="`to bottom, ${barColor}`" v-bind="props" />
    </template>

    <v-divider class="mb-1" />

    <v-list dense nav>
      <v-list-item>
        <v-list-item-avatar class="align-self-center" color="white" contain>
          <!-- <v-img src="/assets/jU9w6rjBNOx68oaC727mW9YjeNRgCh7Cq3OhI1Z9" max-height="30" /> -->
          <div v-html="logo"></div>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title class="display-1" v-text="profile.title" />
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <v-divider class="m-2" />

    <v-list expand nav>
      <template v-for="(item, i) in computedItems">
        <base-item-group v-if="item.children" :key="`group-${i}`" :item="item">
          <!--  -->
        </base-item-group>

        <base-item v-else :key="`item-${i}`" :item="item" />
      </template>
    </v-list>

    <template v-slot:append>
      <base-item
        :item="{
          title: 'Logout',
          icon: 'fal fa-sign-out-alt',
          to: '/logout'
        }"
      />
    </template>
  </v-navigation-drawer>
</template>

<script>
// Utilities
import { mapState } from "vuex";
import http from './../http/http-common';

export default {
  name: "DashboardCoreDrawer",

  props: {
    expandOnHover: {
      type: Boolean,
      default: false
    }
  },

  data: () => ({
    items: [
      {
        icon: "fal fa-analytics",
        title: "Dashboard",
        to: "/"
      },
      {
        icon: "fal fa-user",
        title: "User Profile",
        to: "/user-profile"
      },
      {
        title: "Tables",
        icon: "fal fa-tablet-rugged",
        to: "tables",
        group: "tables",
        children: [
          {
            // icon: "fal fa-dice-d6",
            title: "Category",
            group: "tables",
            to: "category-tables"
          },
          {
            title: "Products",
            to: "product-tables",
            group: "tables"
          },
          {
            title: "Blog",
            to: "blog-tables",
            group: "tables"
          }
        ]
      },
      {
        title: "Content",
        icon: "fal fa-dice-d6",
        to: "content",
        group: "content",
        children: [
          {
            title: "Pages",
            group: "content",
            to: "pages"
          },
          {
            title: "Blocks",
            group: "content",
            to: "blocks",
          },
        ]
      },
      {
        title: "Notifications",
        icon: "fal fa-bell",
        to: "/notifications"
      }
    ],
    avatar: ''
  }),

  computed: {
    ...mapState(["barColor", "barImage"]),
    drawer: {
      get() {
        return this.$store.state.drawer;
      },
      set(val) {
        this.$store.commit("SET_DRAWER", val);
      }
    },
    computedItems() {
      return this.items.map(this.mapItem);
    },
    profile() {
      return {
        avatar: true,
        title: "MSWE"
      };
    },
    logo() {
      return this.avatar;
    }
  },

  methods: {
    mapItem(item) {
      return {
        ...item,
        children: item.children ? item.children.map(this.mapItem) : undefined,
        title: item.title
      };
    }
  },
  async mounted() {
    const {data} = await http.get('/blocks/2');
    this.avatar = data.data.content
  }
};
</script>

<style lang="scss">
#core-navigation-drawer {
  .v-list-item__avatar:first-child {
    margin-right: 11px;
  }
  .v-list-group__header.v-list-item--active:before {
    opacity: 0.24;
  }
  .v-list-item {
    &__icon--text,
    &__icon:first-child {
      justify-content: center;
      text-align: center;
      width: 20px;
    }
  }
  .v-list--nav {
    padding-left: 15px;
    padding-right: 15px;
    .v-list-item {
      padding: 0 8px;
    }
  }
}
</style>
