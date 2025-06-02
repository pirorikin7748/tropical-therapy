<template>
  <div>
    <div v-if="loading">読み込み中...</div>

    <div v-else-if="products.length === 0">
      該当する商品が見つかりませんでした。
    </div>

    <div v-else>
      <!-- 商品一覧 -->
      <div class="grid products-grid">
        <div
          v-for="product in products"
          :key="product.id"
          class="product-card"
        >
          <img :src="product.image_url" :alt="product.name" />
          <h3>{{ product.name }}</h3>
          <p>{{ Number(product.price).toLocaleString() }}円</p>
          <a :href="`/products/${product.id}`" class="text-purple-600 underline text-sm block my-2">詳細</a>

          <!-- お気に入りボタン -->
          <div v-if="isLoggedIn">
            <button
              v-if="product.is_favorite"
              disabled
              class="bg-gray-300 text-gray-800 font-bold px-4 py-2 rounded"
            >
              ♥ お気に入り登録済み
            </button>
            <button
              v-else
              @click="addToFavorites(product)"
              class="bg-teal-700 text-white font-bold py-2 px-4 rounded hover:bg-teal-800"
            >
              ♥ お気に入り登録
            </button>
          </div>
          <p v-else class="text-gray-400 text-sm text-center">
            ログインでお気に入り追加
          </p>
        </div>
      </div>

      <!-- ページネーション -->
      <div class="mt-8 text-center text-sm text-gray-600">
          {{ pagination.total }}件中
          {{ pagination.from }}~{{ pagination.to }}件目を表示
      </div>

      <div class="pagination mt-2 flex gap-2 justify-center">
        <!-- ≪ 戻る（1ページ目以外で表示） -->
        <button
          v-if="pagination.current_page > 1"
          @click="fetchProducts(pagination.current_page - 1)"
          class="px-3 py-1 rounded bg-gray-100 text-teal-700 border-gray-300 hover:bg-gray-200"
        >
          ≪
        </button>

        <button
          v-for="page in pagination.last_page"
          :key="page"
          @click="fetchProducts(page)"
          :class="[
            'px-3 py-1 rounded border',
            page === pagination.current_page
              ? 'bg-teal-700 text-white font-bold'
              : 'bg-gray-100 text-teal-700 border-gray-300 hover:bg-gray-200'
          ]"
        >
          {{ page }}
        </button>

         <!-- ≫ 次へ（最終ページ以外で表示） -->
        <button
          v-if="pagination.current_page < pagination.last_page"
          @click="fetchProducts(pagination.current_page + 1)"
          class="px-3 py-1 rounded bg-gray-100 text-teal-700 border border-gray-300 hover:bg-gray-200"
        >
          ≫
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    keyword: {
      type: String,
      default: '',
    },
    categoryId: {
      type: [String, Number],
      default: '',
    },
    gender: {
      type: String,
      default: '',
    },
    isLoggedIn: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      products: [],
      pagination: {
        current_page: 1,
        last_page: 1,
        total: 0,
        from: 0,
        to: 0,
      },
      loading: false,
    };
  },
  watch: {
    keyword() {
      this.fetchProducts(1);
    },
    categoryId() {
      this.fetchProducts(1);
    },
    gender() {
      this.fetchProducts(1);
    },
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts(page = 1) {
      this.loading = true;
      try {
        const res = await axios.get('/api/products', {
          params: {
            keyword: this.keyword,
            category_id: this.categoryId,
            gender: this.gender,
            page: page,
          },
        });

        this.products = res.data.data;
        this.pagination = {
          current_page: res.data.current_page,
          last_page: res.data.last_page,
          total: res.data.total,
          from: res.data.from,
          to: res.data.to,
        };
      } catch (err) {
        console.error('商品取得エラー:', err);
      } finally {
        this.loading = false;
      }
    },

    async addToFavorites(product) {
      try {
        await axios.post('/api/favorite', {
          product_id: product.id,
        });
        product.is_favorite = true;
      } catch (err) {
        console.error('お気に入り登録エラー:', err);
        alert('お気に入り登録に失敗しました。');
      }
    },
  },
};
</script>
