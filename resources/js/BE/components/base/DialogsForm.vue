<template>
  <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="primary" dark v-bind="attrs" v-on="on">New item</v-btn>
    </template>
    <v-card>
      <v-toolbar dark color="primary">
        <v-btn icon dark @click="close">
          <v-icon>fal fa-times</v-icon>
        </v-btn>
        <v-toolbar-title>{{heading}}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
          <v-btn dark text @click="save">Save</v-btn>
        </v-toolbar-items>
      </v-toolbar>
      <!-- <v-divider></v-divider> -->
      <v-list three-line subheader>
        <v-container>
          <v-row>
            <v-col cols="12" sm="6" md="8">
              <v-list>
                <v-list-group
                  v-for="item in fieldsLeft"
                  :key="item.title"
                  v-model="item.active"
                  :prepend-icon="item.icon"
                  no-action
                >
                  <template v-slot:activator>
                    <v-list-item-content>
                      <v-list-item-title v-text="item.title"></v-list-item-title>
                    </v-list-item-content>
                  </template>

                  <v-list-item v-for="subItem in item.items" :key="subItem.title">
                    <v-list-item-content v-if="subItem.isEditor">
                      <v-list-item-title v-text="subItem.title" class="py-3"></v-list-item-title>
                      <base-editor :content.sync="subItem.value"></base-editor>
                    </v-list-item-content>
                    <v-list-item-content v-else>
                      <v-text-field
                        v-if="subItem.ref != 'id'"
                        :label="subItem.title"
                        :required="subItem.required"
                        :ref="subItem.ref"
                        :rules="subItem.rules"
                        v-model="subItem.value"
                      ></v-text-field>
                    </v-list-item-content>
                  </v-list-item>
                </v-list-group>
              </v-list>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-card>
                <v-card-actions>
                  <v-spacer />
                  <v-switch v-model="isPublish" :label="`Publish: ${isPublish.toString()}`"></v-switch>
                </v-card-actions>
              </v-card>
              <v-divider />
              <v-card v-if="$props.category.item">
                <v-card-title>Category</v-card-title>
                <v-card-text>
                  <v-autocomplete
                    v-model="category.categorySelected"
                    :items="category.items"
                    filled
                    chips
                    color="blue-grey lighten-2"
                    label="Select"
                    item-text="id"
                    item-value="id"
                  >
                    <template v-slot:selection="data">
                      <v-chip
                        v-bind="data.attrs"
                        :input-value="data.selected"
                        close
                        @click:close="removeCategorySelected()"
                      >{{ data.item.name }},</v-chip>
                    </template>
                    <template v-slot:item="data">
                      <template v-if="typeof data.item !== 'object'">
                        <v-list-item-content v-text="data.item"></v-list-item-content>
                      </template>
                      <template v-else>
                        <v-list-item-content>
                          <v-list-item-title v-html="`<h5>Name ${data.item.name}</h5>`" />
                          <v-list-item-subtitle>Param: {{data.item.param}}</v-list-item-subtitle>
                        </v-list-item-content>
                      </template>
                    </template>
                  </v-autocomplete>
                </v-card-text>
              </v-card>
              <v-divider></v-divider>
              <v-card
                v-if="fileImage && fileImage.name"
                class="thumbnail"
                max-width="80%"
                style="margin: 0 auto; text-align: center"
              >
                <img
                  :src="`/assets/${fileImage.name}`"
                  :alt="fileImage.name"
                  style="max-width:100%"
                />
                <v-card-title>Thumbnail</v-card-title>
              </v-card>
              <br />
              <dialogs-images v-show="$props.thumbnail" @selected-image="selectedImage" />
            </v-col>
          </v-row>
        </v-container>
      </v-list>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "DialogsForm",
  props: {
    openDialog: {
      type: Boolean,
      default: () => false
    },
    fieldsLeft: {
      type: Array,
      default: () => [
        {
          action: undefined,
          title: undefined,
          items: [
            {
              title: undefined,
              ref: undefined,
              rules: [],
              required: true,
              value: undefined,
              isEditor: false
            }
          ]
        }
      ]
    },
    heading: {
      type: String,
      default: "Settings"
    },
    category: {
      type: Object,
      default: () => ({
        categorySelected: {},
        items: []
      })
    },
    thumbnail: {
      type: Object,
      default: () => null
    },
    publish: {
      type: Boolean,
      default: true
    },
    editIndex: {
      type: Number,
      default: () => -1,
    }
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  computed: {
    dialog: {
      get() {
        return this.openDialog;
      },
      set(updateDialog) {
        this.$emit("update:openDialog", updateDialog);
      }
    },
    fileImage: {
      get() {
        return this.thumbnail;
      },
      set(updateThumbnail) {
        this.$emit("update:thumbnail", updateThumbnail);
      }
    },
    isPublish: {
      get() {
        return this.publish;
      },
      set(value) {
        this.$emit("update:publish", value);
      }
    }
  },
  data() {
    return {};
  },
  methods: {
    save() {
      let item = {};
      this.fieldsLeft.forEach(group => {
        group.items.forEach(field => {
          item[field.ref] = field.value;
        });
      });
      item = {
        ...item,
        category:
          this.category || this.category.categorySelected
            ? this.category.categorySelected
            : null,
        thumbnail: this.fileImage ? this.fileImage : null,
        publish: this.isPublish
      };
      this.$emit("save", item);
    },
    close() {
      this.dialog = false;
      this.removeCategorySelected();
      this.fileImage = {};
      this.isPublish = true;
      this.$emit("update:editIndex", -1);
      this.fieldsLeft.map(group => {
        group.items.map(field => {
          field.value = "";
        });
      });
    },
    removeCategorySelected() {
      this.$props.category.categorySelected = {};
    },

    selectedImage(file) {
      this.fileImage = file;
    }
  },
  components: {
    DialogsImages: () => import("@/js/BE/components/DialogsImages")
  }
};
</script>


<style lang="scss" scope>
.ql-snow .ql-editor {
  min-height: 45vh;
  blockquote {
    margin-bottom: 0 !important;
    margin-top: 0 !important;
  }
}
.v-list--three-line .v-list-item,
.v-list-item--three-line {
  min-height: auto !important;
}
</style>
