import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue';

import HeaderSearch from './components/HeaderSearch.vue';
import ProductList from './components/ProductList.vue';
import App from './components/App.vue';
import emitter from './eventBus';

window.Alpine = Alpine;
Alpine.start();

// ✅ 商品一覧ページに Vue をマウント（#app-products）
if (document.getElementById('app-products')) {
    const app = createApp(App);
    app.config.globalProperties.$emitter = emitter;
    app.component('header-search', HeaderSearch);
    app.component('product-list', ProductList);
    app.mount('#app-products');
}

// ✅ ヘッダーの検索フォームだけマウント（#header-search）
if (document.getElementById('header-search')) {
    const headerApp = createApp({});
    headerApp.config.globalProperties.$emitter = emitter;
    headerApp.component('header-search', HeaderSearch);
    headerApp.mount('#header-search');
}
