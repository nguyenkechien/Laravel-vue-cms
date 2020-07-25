<template>
  <v-container>
    <base-material-card color="warning" class="px-5 py-10">
      <template v-slot:heading>
        <div class="display-2 font-weight-light">{{ newItem.name }}</div>

        <div
          class="subtitle-1 font-weight-light"
        >New Pages on {{ new Date(newItem.created_at).toDateString() }}</div>
        <v-spacer class="py-3" />
        <base-dialogs-form
          :heading="heading"
          :openDialog.sync="openDialog"
          :fieldsLeft="fieldsLeft"
          :publish.sync="publish"
          :thumbnail.sync="thumbnail"
          :editIndex.sync="editIndex"
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
          <template
            v-slot:item.publish="{ item }"
          >{{ item.publish && item.publish == 1 ? true : false}}</template>
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
import PageService from "./../../services/PageService";
import BlockService from "./../../services/BlockService";
export default {
  name: "Pages",
  data() {
    return {
      headers: [
        {
          sortable: false,
          text: "ID",
          value: "id",
        },
        {
          sortable: false,
          text: "Name",
          value: "name",
        },
        {
          sortable: false,
          text: "Param",
          value: "param",
          align: "right",
        },
        {
          sortable: false,
          text: "Publish",
          value: "publish",
          align: "right",
        },
        {
          sortable: false,
          text: "Updated at",
          value: "updated_at",
          align: "right",
        },
        {
          text: "Actions",
          value: "actions",
          sortable: false,
          align: "right",
        },
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
              value: "",
            },
            {
              title: "Name",
              ref: "name",
              rules: [],
              required: true,
              value: "",
            },
            {
              title: "Content",
              isEditor: true,
              ref: "content",
              value: "",
            },
          ],
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
              value: "",
            },
            {
              title: "Meta description",
              ref: "meta_description",
              rules: [],
              required: true,
              value: "",
            },
            {
              title: "Meta keywords",
              ref: "meta_keywords",
              rules: [],
              required: true,
              value: "",
            },
            {
              title: "Param",
              ref: "param",
              rules: [],
              required: true,
              value: "",
            },
          ],
        },
      ],
      thumbnail: {},
      publish: true,
      items: [],
      isLoading: true,
      openDialog: false,
      editIndex: -1,
      newItem: {},
      sheet: {
        opentSheet: false,
        message: "",
      },
    };
  },
  computed: {
    ...mapState(["blocks", "pages"]),
    heading() {
      return this.editIndex === -1 ? "New page" : "Edit page";
    }
  },
  methods: {
    ...mapMutations({
      setBlocks: "SET_BLOCKS",
      setPages: "SET_PAGES",
    }),
    editItem(item) {
      this.openDialog = true;
      this.editIndex = this.items.findIndex((data) => data.name == item.name);
      this.fieldsLeft.forEach((group) => {
        group.items.forEach((field) => {
          field.value = item[field.ref];
        });
      });
      this.thumbnail = { ...item.meta_thumbnail };
      this.publish = item.publish === 1 ? true : false;
    },
    async onSave(item) {
      item["meta_thumbnail_id"] = item.thumbnail.id;
      if (this.editIndex > -1) {
        await PageService.update(item).then(({ data: { data } }) => {
          Object.assign(this.items[this.editIndex], data);
        });
      } else {
        await PageService.create(item).then(({ data: { data } }) => {
          this.items.unshift(data);
        });
      }
      this.openDialog = false;
      this.editIndex = -1;
    },
    getMaxDate() {
      this.newItem = this.items.reduce((a, b) =>
        new Date(a.created_at) > new Date(b.created_at) ? a : b
      );
    },
    async deleteItem(item) {
      const index = await this.items.findIndex((i) => i.name == item.name);
      if (index > -1) {
        await PageService.destroy(item).then(({ data: { message } }) => {
          this.items.splice(index, 1);
          this.sheet.opentSheet = true;
          this.sheet.message = message;
        });
      }
    },
  },
  async mounted() {
    if (!this.pages.length) {
      await PageService.index()
        .then(({ data: { data } }) => {
          this.items = data;
          this.isLoading = false;
          if (data.length) this.getMaxDate();
          this.setPages(data);
        })
        .catch((err) => {
          this.isLoading = true;
          console.log(err);
        });
    }

    if (!this.blocks.length) {
      await BlockService.index()
        .then(({ data: { data } }) => {
          this.setBlocks(data);
        })
        .catch((err) => {
          this.isLoading = true;
          console.log(err);
        });
    }

    this.items = this.pages;
    this.isLoading = false;
  },
};
</script>
