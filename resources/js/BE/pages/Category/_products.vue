<template>
  <v-container>
    <base-material-card color="warning" class="px-5 py-10">
      <template v-slot:heading>
        <div class="display-2 font-weight-light">Danh mục Sản phẩm</div>
        <div class="subtitle-1 font-weight-light">Danh mục mới nhất vào ngày {{ maxDate }}</div>
        <v-spacer class="py-3" />
        <base-dialogs-form-input
          :formTitle="formTitle"
          :fields.sync="fields"
          :openDialog.sync="openDialog"
          :editIndex.sync="editIndex"
          @save="onSave"
        />
      </template>
      <v-card-text>
        <v-data-table :headers="headers" :items="categories.products">
          <template
            v-slot:item.updated_at="{ item }"
          >{{ new Date(item.updated_at).toLocaleString() }}</template>
          <template v-slot:item.publish="{ item }">{{ item.publish == 1 ? true : false}}</template>
          <template v-slot:item.actions="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">fal fa-pencil</v-icon>
            <v-icon small @click="deleteItem(item)">fal fa-trash-alt</v-icon>
          </template>
        </v-data-table>
      </v-card-text>
    </base-material-card>
    <base-bottom-sheet :opentSheet.sync="sheet.opentSheet" :message="sheet.message" />
  </v-container>
</template>

<script>
import CategoryProductService from "./../../services/CategoryService/Product";
import { mapState, mapMutations } from "vuex";

export default {
  name: "CategoryProducts",
  data() {
    return {
      headers: [
        {
          sortable: false,
          text: "ID",
          value: "id"
        },
        {
          sortable: true,
          text: "Name",
          value: "name"
        },
        {
          sortable: false,
          text: "Param",
          value: "param",
          align: "right"
        },
        {
          sortable: false,
          text: "Publish",
          value: "publish",
          align: "right"
        },
        {
          sortable: false,
          text: "Updated at",
          value: "updated_at",
          align: "right"
        },
        {
          text: "Actions",
          value: "actions",
          sortable: false,
          align: "right"
        }
      ],
      fields: [
        {
          ref: "name",
          title: "Name",
          val: "",
          rules: [],
          required: true,
          type: "text"
        },
        {
          ref: "description",
          title: "Description",
          val: "",
          rules: [],
          required: true,
          type: "text"
        },
        {
          ref: "param",
          title: "Param",
          val: "",
          rules: [],
          required: true,
          type: "text"
        },
        {
          ref: "meta_description",
          title: "Meta description",
          val: "",
          rules: [],
          required: false,
          type: "text"
        },
        {
          ref: "meta_keywords",
          title: "Meta keywords",
          val: "",
          rules: [],
          required: false,
          type: "text"
        },
        {
          ref: "meta_title",
          title: "Meta title",
          val: "",
          rules: [],
          required: false,
          type: "text"
        },
        {
          ref: "publish",
          title: "Publish",
          val: false,
          rules: [],
          required: false,
          type: "switch"
        },
        {
          ref: "id",
          title: "id",
          val: "",
          rules: [],
          required: false,
          type: "hidden"
        }
      ],
      openDialog: false,
      editIndex: -1,
      maxDate: null,
      sheet: {
        opentSheet: false,
        message: ""
      }
    };
  },
  watch: {},
  methods: {
    ...mapMutations({
      setCategories: "SET_CATEGORIES"
    }),
    editItem(item) {
      this.openDialog = true;
      this.editIndex = this.categories.products.findIndex(
        data => data.name == item.name
      );
      this.fields.forEach(field => {
        field.val = item[field.ref];
      });
    },
    async deleteItem(item) {
      const index = await this.categories.products.findIndex(
        i => i.name == item.name
      );
      if (index > -1) {
        await CategoryProductService.destroy(item.id).then(
          ({ data: { message } }) => {
            this.categories.products.splice(index, 1);
            this.sheet.opentSheet = true;
            this.sheet.message = message;
          }
        );
      }
    },
    async onSave(item) {
      if (this.editIndex > -1) {
        await CategoryProductService.update(item)
          .then(({ data: { data } }) => {
            Object.assign(this.categories.products[this.editIndex], data);
            this.$store.commit("SET_CATEGORIES", {
              ...this.categories,
              products: this.categories.products
            });
          })
      } else {
        await CategoryProductService.create(item).then(({ data: { data } }) => {
          this.categories.products.push(data);
        });
      }
      this.openDialog = false;
      this.editIndex = -1;
    },
    getMaxDate() {
      const maxDate = this.categories.products.reduce((a, b) => {
        return new Date(a.created_at) > new Date(b.created_at) ? a : b;
      });
      this.maxDate = new Date(maxDate.created_at).toDateString();
    }
  },
  computed: {
    ...mapState(["categories"]),
    formTitle() {
      return this.editIndex === -1 ? "New Item" : "Edit Item";
    }
  },
  async mounted() {
    if (!this.categories.products) {
      const { data } = await CategoryProductService.index();
      this.setCategories({
        ...this.categories,
        products: data.data
      });
    }
    this.getMaxDate();
  }
};
</script>
