<template>
  <v-container>
    <base-material-card color="warning" class="px-5 py-10">
      <template v-slot:heading>
        <div class="display-2 font-weight-light">{{ newItem.name }}</div>

        <div
          class="subtitle-1 font-weight-light"
        >New Block on {{ new Date(newItem.created_at).toDateString() }}</div>
        <v-spacer class="py-3" />
        <base-dialogs-form
          :heading="heading"
          :openDialog.sync="openDialog"
          :fieldsLeft="fieldsLeft"
          :publish.sync="publish"
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
import { mapState, mapMutations, Commit } from "vuex";
import BlockService from "./../../services/BlockService";
import { sleep } from "@/js/functions/sleep";
export default {
  name: "Block",
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
          text: "Name",
          value: "name"
        },
        {
          sortable: false,
          text: "Publish",
          value: "publish",
          align: "right"
        },
        {
          sortable: false,
          text: "Created at",
          value: "created_at",
          align: "center"
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
              title: "Name",
              ref: "name",
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
        }
      ],
      publish: true,
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
    ...mapState(["blocks"]),
    heading() {
      return this.editIndex === -1 ? "New Block" : "Edit Block";
    }
  },
  methods: {
    ...mapMutations({
      setBlocks: "SET_BLOCKS"
    }),
    editItem(item) {
      this.openDialog = true;
      this.editIndex = this.items.findIndex(data => data.name == item.name);
      this.fieldsLeft.forEach(group => {
        group.items.forEach(field => {
          field.value = item[field.ref];
        });
      });
      console.log(item);
      this.publish = item.publish === 1 ? true : false;
    },
    async onSave(item) {
      if (this.editIndex > -1) {
        await BlockService.update(item).then(({ data: { data } }) => {
          Object.assign(this.items[this.editIndex], data);
          this.setBlocks(this.items);
        });
      } else {
        await BlockService.create(item).then(({ data: { data } }) => {
          this.items.unshift(data);
          this.setBlocks(this.items);
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
      const index = await this.items.findIndex(i => i.name == item.name);
      if (index > -1) {
        await BlockService.destroy(item).then(({ data: { message } }) => {
          this.items.splice(index, 1);
          this.sheet.opentSheet = true;
          this.sheet.message = message;
          this.setBlocks(this.items);
        });
      }
    }
  },
  async mounted() {
    await BlockService.index()
      .then(({ data: { data } }) => {
        this.items = data;
        this.isLoading = false;
        this.setBlocks(data);
        console.log(this.blocks);
        if (data.length) this.getMaxDate();
      })
      .catch(err => {
        this.isLoading = true;
        console.log(err);
      });
  }
};
</script>

<style lang="scss" scope></style>
