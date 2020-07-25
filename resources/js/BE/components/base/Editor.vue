<template>
  <div class="editor-wrapper">
    <v-card>
      <v-tabs v-model="tab" background-color="primary" dark>
        <v-tab @click="tabText">Text</v-tab>
        <v-tab @click="tabCode">Show code</v-tab>
        <v-btn class="ma-2" @click="openTabImage" tile>Add Image</v-btn>
      </v-tabs>

      <v-tabs-items v-model="tab">
        <v-tab-item>
          <vue-editor
            ref="editor"
            v-model="editorContent"
            id="editor"
            useCustomImageHandler
            :customModules="customModulesForEditor"
            :editor-options="editorSettings"
            :editor-toolbar="customToolbar"
          />
        </v-tab-item>
        <v-tab-item>
          <v-textarea solo v-model="htmlText" height="45vh"></v-textarea>
        </v-tab-item>
      </v-tabs-items>
    </v-card>
  </div>
</template>

<script>
// :editor-toolbar="customToolbar"
import { VueEditor, Quill } from "vue2-editor";
import { ImageDrop } from "quill-image-drop-module";
import ImageResize from "quill-image-resize-module";
import { mapState, mapMutations } from "vuex";
import "quill/dist/quill.snow.css";

var Block = Quill.import("blots/block");
class Div extends Block {}
Div.tagName = "div";
Div.blotName = "div";
Div.allowedChildren = Block.allowedChildren;
Div.allowedChildren.push(Block);
Quill.register(Div);

export default {
  name: "Editor",
  props: {
    content: String,
  },
  data() {
    return {
      tab: null,
      customModulesForEditor: [
        { alias: "imageDrop", module: ImageDrop },
        { alias: "imageResize", module: ImageResize },
      ],
      editorSettings: {
        modules: {
          imageDrop: false,
          imageResize: true,
        },
        theme: "snow",
      },
      customToolbar: [
        [{ header: [1, 2, 3, 4, 5, 6, false] }],
        [{ size: ["small", false, "large", "huge"] }], // custom dropdown
        [{ font: [] }],

        ["bold", "italic", "underline", "strike"], // toggled buttons
        ["blockquote", "code-block"],
        ["link", "video", "formula"],

        [{ list: "ordered" }, { list: "bullet" }],
        [{ script: "sub" }, { script: "super" }], // superscript/subscript
        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
        [{ direction: "rtl" }], // text direction

        [{ color: [] }, { background: [] }], // dropdown with defaults from theme
        [{ align: [] }],
        ["clean"],
      ],
      editorContent: "",
      htmlText: "",
      isTabCode: false,
    };
  },
  computed: {
    ...mapState(["dialogImage"]),
    value: {
      get() {
        return this.content;
      },
      set(updatedContent) {
        this.$emit(
          "update:content",
          this.isTabCode ? this.htmlText : this.editorContent
        );
      },
    },
    editor() {
      return this.$refs.editor.quill;
    },
  },
  watch: {
    editorContent(value) {
      this.value = value;
    },
    htmlText(value) {
      this.value = value;
    },
    value(val) {
      this.htmlText = this.htmlText && val ? this.htmlText : val;
      this.editorContent = val;
    }
  },
  methods: {
    ...mapMutations({
      setCategories: "SET_CATEGORIES",
    }),
    openTabImage() {
      const editder = "Editor";
      this.$store.commit("SET_DIALOGIMAGE", {
        openDialog: true,
        image: {},
        cursorLocation: editder,
      });
    },
    tabText() {
      this.isTabCode = false;
      this.value = this.editorContent;
    },
    tabCode() {
      this.isTabCode = true;
      this.value = this.htmlText;
    },
  },
  components: {
    VueEditor,
  },
  created() {
    this.unwatch = this.$store.watch(
      (state, getters) => getters.dialogImage,
      (newValue, oldValue) => {
        if (newValue && newValue.name) {
          if (this.isTabCode) {
            const img = `<img src="{{ route('assets.show', '${newValue.name}') }}" alt="${newValue.name}" />`;
            this.htmlText += img;
          } else {
            const selection = this.editor.getSelection();
            const cursorLocation = selection ? selection.index : 0;
            this.editor.insertEmbed(
              cursorLocation,
              "image",
              `/assets/${newValue.name}`
            );
          }
        }
      }
    );
  },
  beforeDestroy() {
    this.unwatch();
  },
  mounted() {
    this.htmlText = this.content;
    this.editorContent = this.content;
  },
};
</script>
