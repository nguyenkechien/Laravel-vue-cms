import Vue from "vue";
import Axios from "axios";


Axios.interceptors.response.use(
  response => response,
  function({response}) {
    return response
  }
);

Vue.use(Axios)
