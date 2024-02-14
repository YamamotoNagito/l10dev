import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

export default createVuetify({
  components,
  directives,
  defaults: {
    VCard: {
      VBtn: { variant: "outlined" },
    },
  },
  theme: {
    options: {
      customProperties: true,
    },
    defaultTheme: "light",
    themes: {
      light: {
        dark: false,
        colors: {
          primary: "#FB8C00",
          background: "#ECEFF1",
        },
      },
    },
  },
});
