<template>
  <v-container>
    <base-material-card color="warning" class="px-5 py-10">
      <template v-slot:heading>
        <div class="display-2 font-weight-light">{{ newItem.title }}</div>

        <div
          class="subtitle-1 font-weight-light"
        >New item on {{ new Date(newItem.created_at).toDateString() }}</div>
        <v-spacer class="py-3" />
        <base-dialogs-form
          :heading="heading"
          :openDialog.sync="openDialog"
          :fieldsLeft="fieldsLeft"
          :category="category"
          :thumbnail.sync="thumbnail"
          @save="onSave"
        />
      </template>
      <v-card-text>
        <v-data-table :loading="isLoading" :headers="headers" :items="items">
          <template
            v-slot:item.updated_at="{ item }"
          >{{ new Date(item.updated_at).toLocaleString() }}</template>
          <template v-slot:item.thumbnail="{item}">
            <v-img :src="`/assets/${item.thumbnail.name}`" width="100" class="m-auto" />
          </template>
          <template v-slot:item.category="{item}">{{ item.category ? item.category.name : ''}}</template>
          <template v-slot:item.publish="{ item }">{{ item.publish === 1 ? true : false}}</template>
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
import { mapState, mapMutations } from "vuex";
export default {
  name: "Blog",
  data() {
    return {
      headers: [
        {
          sortable: false,
          text: "ID",
          value: "id"
        },
        {
          sortable: false,
          text: "Title",
          value: "title"
        },
        {
          sortable: false,
          text: "Category",
          value: "category"
        },
        {
          sortable: false,
          text: "Param",
          value: "param",
          align: "right"
        },
        {
          sortable: false,
          text: "Thumbnail",
          value: "thumbnail",
          align: "center"
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
      fieldsLeft: [
        {
          icon: "fal fa-pen",
          title: "Contents",
          active: true,
          items: [
            {
              title: "id",
              ref: "id",
              rules: [],
              required: true,
              value: ""
            },
            {
              title: "Titile",
              ref: "title",
              rules: [],
              required: true,
              value: ""
            },
            {
              title: "Content",
              isEditor: true,
              ref: "content",
              value: ""
            }
          ]
        },
        {
          icon: "fal fa-book-reader",
          title: "Meta Seo",
          items: [
            {
              title: "Meta title",
              ref: "meta_title",
              rules: [],
              required: true,
              value: ""
            },
            {
              title: "Meta description",
              ref: "meta_description",
              rules: [],
              required: true,
              value: ""
            },
            {
              title: "Meta keywords",
              ref: "meta_keywords",
              rules: [],
              required: true,
              value: ""
            },
            {
              title: "Param",
              ref: "param",
              rules: [],
              required: true,
              value: ""
            }
          ]
        }
      ],
      category: {
        categorySelected: {},
        items: []
      },
      thumbnail: null,
      items: [],
      isLoading: true,
      openDialog: false,
      editIndex: -1,
      newItem: {},
      sheet: {
        opentSheet: false,
        message: ""
      }
    };
  },
  computed: {
    ...mapState(["categories"]),
    heading() {
      return this.editIndex === -1 ? "New Blog" : "Edit Blog";
    }
  },
  methods: {
    ...mapMutations({
      setCategories: "SET_CATEGORIES"
    }),
    editItem(item) {
      this.openDialog = true;
      this.editIndex = this.items.findIndex(data => data.title == item.title);
      this.fieldsLeft.forEach(group => {
        group.items.forEach(field => {
          field.value = item[field.ref];
        });
      });
      this.category.categorySelected = item.category;
      this.thumbnail = { ...item.thumbnail };
    },
    async onSave(item) {
      item["thumbnail_id"] = item.thumbnail.id;
      item["category_id"] =
        typeof item.category === "number" ? item.category : item.category.id;
      if (this.editIndex > -1) {
        await BlogService.update(item).then(({ data: { data } }) => {
          Object.assign(this.items[this.editIndex], data);
        });
      } else {
        await BlogService.create(item).then(({ data: { data } }) => {
          this.items.unshift(data);
        });
      }
    },
    getMaxDate() {
      this.newItem = this.items.reduce((a, b) =>
        new Date(a.created_at) > new Date(b.created_at) ? a : b
      );
    },
    async deleteItem(item) {
      const index = await this.items.findIndex(i => i.name == item.name);
      if (index > -1) {
        await BlogService.destroy(item).then(({ data: { message } }) => {
          this.items.splice(index, 1);
          this.sheet.opentSheet = true;
          this.sheet.message = message;
        });
      }
    }
  },
  async mounted() {
    await BlogService.index().then(({ data: { data } }) => {
      this.items = data;
      this.isLoading = false;
    });
    if (!this.categories.blog) {
      await CategoryBlogService.index().then(({ data: { data } }) => {
        this.setCategories({
          ...this.categories,
          blog: data
        });
        this.category.items = [...data];
      });
    } else {
      this.category.items = [...this.categories.blog];
    }
    this.getMaxDate();
  }
};
</script>
