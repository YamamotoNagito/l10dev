import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

export default createVuetify({
  components,
  directives,
  theme: {
    options: {
      customProperties: true,
    },
    defaultTheme: "light",
    themes: {
      light: {
        dark: false,
        colors: {
          background: "#ECEFF1",
        },
      },
    },
  },
});
