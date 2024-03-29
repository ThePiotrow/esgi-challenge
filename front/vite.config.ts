import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'
import WindiCSS from 'vite-plugin-windicss'

export default defineConfig({
  plugins: [vue(),
    WindiCSS(),],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
    },
  }
});