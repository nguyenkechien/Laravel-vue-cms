<template>
  <v-row justify="center" class="v-dialog-image">
    <v-dialog v-model="dialogImage.openDialog" scrollable hide-overlay>
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" dark v-bind="attrs" v-on="on">Choose The Picture</v-btn>
      </template>
      <v-card height="90vh">
        <v-card-title>
          <v-toolbar dark color="primary">
            <v-toolbar-title>Images</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon dark @click="close">
              <v-icon>fal fa-times</v-icon>
            </v-btn>
          </v-toolbar>
        </v-card-title>
        <v-divider></v-divider>
        <v-container>
          <div v-if="currentFile">
            <v-progress-linear :value="progress" color="light-blue" height="25" reactive>
              <strong>{{ progress }} %</strong>
            </v-progress-linear>
          </div>
          <v-row no-gutters justify="start" align="center" class="pb-4">
            <v-col cols="4">
              <v-file-input
                :rules="rules"
                show-size
                accept="image/png, image/jpeg, image/bmp"
                label="File input"
                multiple
                @change="selectFile"
                v-model="currentFile"
              ></v-file-input>
            </v-col>

            <v-col cols="2" class="pl-2">
              <v-btn color="success" dark small @click="upload">
                Upload
                <v-icon right dark>fal fa-cloud-upload-alt</v-icon>
              </v-btn>
            </v-col>
          </v-row>
        </v-container>
        <v-card-text>
          <v-container>
            <v-alert v-if="message" border="left" color="blue-grey" dark>{{ message }}</v-alert>
            <template v-if="fileInfos.length > 0">
              <v-subheader>List of Files</v-subheader>
              <div class="text-center" v-show="looadImage">
                <v-progress-circular :size="70" :width="7" color="primary" indeterminate></v-progress-circular>
              </div>
              <v-row align="start" justify="start" v-show="!looadImage">
                <v-col v-for="(file, index) in fileInfos" :key="index" cols="2" class="list-image">
                  <v-card style="text-align: center">
                    <img :src="`/assets/${file.name}`" :alt="file.name" />
                    <v-divider></v-divider>
                    <v-card-text v-html="file.name" />
                    <v-divider></v-divider>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="primary" dark small @click="onSelectedImage(file)" icon>
                        <v-icon right dark>fal fa-check</v-icon>
                      </v-btn>
                      <v-btn color="red darken-2" dark small @click="onDelete(file)" icon>
                        <v-icon right dark>fal fa-trash-alt</v-icon>
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-col>
              </v-row>
            </template>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import UploadService from "../services/UploadFilesService";
import { mapState, mapMutations } from "vuex";

export default {
  name: "upload-files",
  data() {
    return {
      grid: ["--large", "--medium", "--large", "--full"],
      currentFile: undefined,
      progress: 0,
      message: "",
      fileInfos: [],
      rules: [
        files =>
          !files ||
          !files.some(file => file.size > 2e6) ||
          "Image size should be less than 2 MB!"
      ],
      currentImageName: null,
      looadImage: true
    };
  },
  methods: {
    ...mapMutations({
      setCategories: "SET_CATEGORIES"
    }),
    selectFile(files) {
      if (files.length) {
        this.progress = 0;
        this.currentFile = files;
      } else {
        this.currentFile = undefined;
      }
    },
    onSelectedImage(file) {
      if (this.dialogImage.cursorLocation === "Editor") {
        this.$store.commit("SET_DIALOGIMAGE", {
          openDialog: false,
          image: file,
          cursorLocation: ""
        });
      } else {
        this.$store.commit("SET_DIALOGIMAGE", {
          openDialog: false
        });
        this.$emit("selected-image", file);
      }
    },
    async upload() {
      if (!this.currentFile) return (this.message = "Please select a file!");
      this.message = "";
      this.looadImage = true;
      await Promise.all([
        await UploadService.upload(this.currentFile, event => {
          this.progress = Math.round((100 * event.loaded) / event.total);
        }),
        await UploadService.getFiles()
      ]).then(val => {
        val.forEach(o => {
          if (["GET", "Get", "get"].includes(o.config.method)) {
            this.fileInfos = o.data.data;
          } else {
            this.message = o.data.message;
          }
        });
      });

      try {
        await this.resetData();
      } catch (error) {
        this.progress = 0;
        this.message = "Could not upload the file!";
        this.currentFile = undefined;
      }
    },
    async onDelete(file) {
      this.message = "";
      this.looadImage = true;
      const {
        data: { message }
      } = await UploadService.deleteFile(file.name, event => {
        this.progress = Math.round((100 * event.loaded) / event.total);
      });
      try {
        this.message = message;
        const index = this.fileInfos.indexOf(file);
        this.fileInfos.splice(index, 1);
        await this.resetData();
      } catch (error) {
        this.progress = 0;
        this.message = "Could not upload the file!";
        this.currentFile = undefined;
      }
    },
    resetData() {
      return new Promise(resolve =>
        setTimeout(() => {
          this.message = "";
          this.progress = 0;
          this.currentFile = undefined;
          this.looadImage = false;
          resolve();
        }, (Math.random() * (2 - 0) + 0) * 1000)
      );
    },
    close() {
      this.$store.commit("SET_DIALOGIMAGE", {
        openDialog: false,
        image: {},
        cursorLocation: ""
      });
    }
  },
  async mounted() {
    if (this.fileInfos.length) return true;
    const {
      data: { data }
    } = await UploadService.getFiles();
    try {
      this.fileInfos = data;
      await this.resetData();
    } catch (error) {
      this.message = "Not Files";
      console.log(error);
    }
  },
  computed: {
    ...mapState(["dialogImage"])
  }
};
</script>

<style lang="scss">
.list-image {
  img {
    max-width: 100%;
    width: auto;
  }
}
</style>
