import Axios from "axios";
import {config} from "../config.js";

const xToken = document.head.querySelector('meta[name="x-token"]');

export default Axios.create({
  baseURL: `${config.DOMAIN_API}/api`,
  headers: {
    "Content-type": "application/json",
    "Authorization": `Bearer ${xToken.content}`
  }
});
