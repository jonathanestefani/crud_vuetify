/**
 * main.ts
 *
 * Bootstraps Vuetify and other plugins then mounts the App`
 */

// Components
import App from "./App.vue";
// Composables
import { createApp } from "vue";

import { store } from "./store/Store";

import VueNumberFormat from "vue-number-format";

import VueSweetalert2 from "vue-sweetalert2";

import { VueMaskDirective } from "v-mask";

// Plugins
import { registerPlugins } from "@/plugins";

import { createVuetify } from 'vuetify'

const app = createApp(App);
app.config.globalProperties.$filters = {
  toCurrency(value) {
    if (typeof value !== "number") {
      return value;
    }
    var formatter = new Intl.NumberFormat("en-US", {
      style: "currency",
      currency: "BRL",
    });
    return formatter.format(value);
  },
};
app.use(store);
app.use(VueSweetalert2);
app.use(VueNumberFormat, { prefix: "R$ ", decimal: ",", thousand: "." });
app.directive("mask", VueMaskDirective);

registerPlugins(app);

app.mount("#app");
