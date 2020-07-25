<template>
  <v-dialog v-model="dialog" max-width="500px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">New Item</v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="headline">{{ formTitle }}</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="6" md="4" v-for="(field, index) in editField" :key="index">
              <v-text-field
                :ref="field.ref"
                v-model="field.val"
                :label="field.title"
                v-if="field.type == 'text'"
                :required="field.required"
                :rules="field.rules"
              ></v-text-field>
              <v-switch
                :ref="field.ref"
                v-model="field.val"
                :label="`${field.title}: ${field.val.toString()}`"
                v-if="field.type == 'switch'"
              ></v-switch>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
        <v-btn color="blue darken-1" text @click="save">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "DialogFormInput",
  props: {
    openDialog: {
      type: Boolean,
      default: () => false
    },
    fields: {
      type: Array,
      default: () => [
        {
          val: "",
          title: "",
          type: "",
          required: "",
          rules: "",
          ref: ""
        }
      ]
    },
    formTitle: {
      type: String,
      default: () => "New Item"
    },
    editIndex: {
      type: Number,
      default: () => -1
    }
  },
  data() {
    return {};
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
    editField: {
      get() {
        return this.fields;
      },
      set(updateFields) {
        this.$emit("update:fields", updateFields);
      }
    }
  },
  methods: {
    close() {
      this.dialog = false;
      this.$emit("update:editIndex", -1);
      this.editField.map(field => (field.val = ""));
    },
    save() {
      const item = {};
      this.editField.forEach(field => {
        item[field.ref] = field.val;
      });
      this.$emit("save", item);
    }
  }
};
</script>

<style>
</style>
