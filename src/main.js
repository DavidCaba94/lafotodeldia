import { createApp } from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import InfiniteLoading from "v3-infinite-loading";

createApp(App).use(store).use(router).component("infinite-loading", InfiniteLoading).mount('#app')
