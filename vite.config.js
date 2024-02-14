import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig(({ mode }) => {
  const envPrefix = ["APP_ENV"];
  const env = loadEnv(mode, ".", envPrefix);
  return {
    plugins: [
      laravel({
        input: ["resources/css/app.css", "resources/js/app.js"],
        refresh: true,
      }),
      vue(),
    ],
    server: {
      host: true,
      hmr: {
        host: "localhost",
      },
      watch: {
        usePolling: true,
      },
    },
    esbuild: {
      drop: env["APP_ENV"] === "production" ? ["console", "debugger"] : [],
    },
    // router: {
    //     middleware: ['auth'],
    //   }
  };
});
