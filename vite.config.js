import { defineConfig, loadEnv } from "vite";
import Components from "unplugin-vue-components/vite";
import { PrimeVueResolver } from "@primevue/auto-import-resolver";
import tailwindcss from "@tailwindcss/vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), "");

    return {
        plugins: [
            laravel({
                input: "resources/js/app.js",
                ssr: "resources/js/ssr.js",
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
            Components({
                resolvers: [PrimeVueResolver()],
            }),
            tailwindcss(),
        ],
        server: {
            host: env.PRIVATE_IP || "localhost",
            port: parseInt(env.VITE_PORT) || 5173,
            hmr: {
                host: env.PRIVATE_IP || "localhost",
            },
        },
    };
});
