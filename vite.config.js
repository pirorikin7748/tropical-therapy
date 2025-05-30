import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    publicDir: 'public', // ← ✅ この1行を追加！

    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                //管理者トップページ
                'resources/css/admin/dashboard.css',
                //管理者
                'resources/css/admin/members.css',
                'resources/css/admin/edit.css',
                'resources/css/admin/inquiries.css',
                'resources/css/admin/reply_form.css',
                'resources/css/admin/sales.css',
                'resources/css/admin/products.css',
                'resources/css/admin/products-edit.css',
                'resources/css/admin/products-create.css',

                // 商品ページ
                'resources/css/products/index.css',
                'resources/js/products/index.js',
                'resources/css/products/show.css',
                'resources/js/products/show.js',

                // マイページ
                'resources/css/mypage/index.css',
                'resources/js/mypage/index.js',
                'resources/css/mypage/favorites.css',
                'resources/js/mypage/favorites.js',
            ],
            refresh: true,
        }),
        vue(),
    ],
});