import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    barColor: "rgba(0, 0, 0, .8), rgba(0, 0, 0, .8)",
    barImage:
      "https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-1.jpg",
    drawer: null,
    categories: {},
    dialogImage: {
      openDialog: false,
      cursorLocation: '',
      image: {}
    },
    blocks: [],
    pages: [],
    products: [],
    blogs: [],
  },
  mutations: {
    SET_BAR_IMAGE(state, payload) {
      state.barImage = payload;
    },
    SET_DRAWER(state, payload) {
      state.drawer = payload;
    },
    SET_CATEGORIES(state, payload) {
      state.categories = payload;
    },
    SET_DIALOGIMAGE(state, {openDialog, image, cursorLocation}){
      state.dialogImage.openDialog = openDialog;
      state.dialogImage.image = image;
      state.dialogImage.cursorLocation = cursorLocation;
    },
    SET_BLOCKS(state, payload) {
      state.blocks = payload;
    },
    SET_BLOGS(state, payload) {
      state.blocks = payload;
    },
    SET_PRODUCTS(state, payload) {
      state.blocks = payload;
    },
    SET_PAGES(state, payload) {
      state.pages = payload;
    }
  },
  actions: {},
  getters:  {
    dialogImage: state => state.dialogImage.image,
  },
});
