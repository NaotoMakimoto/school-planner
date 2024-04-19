// vite.config.js
import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    vue({
      template: {
        // enable runtime compilation for the template
        compilerOptions: {
          isCustomElement: (tag) => tag.startsWith('ion-')
        }
      }
    }),
    laravel({
      input: 'resources/js/app.js',
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      'vue': 'vue/dist/vue.esm-bundler.js'
    },
  },
});
