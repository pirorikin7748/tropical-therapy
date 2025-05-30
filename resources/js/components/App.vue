<template>
  <div>     
    <div class="gender-selector flex min-h-[400px]">
      <!-- WOMEN -->
      <div class="w-1/2 relative cursor-pointer" @click="updateGender('women')">
        <img src="/images/women_half.png" alt="WOMEN" class="object-cover w-full h-full" />
      </div>

      <!-- MEN -->
      <div class="w-1/2 relative cursor-pointer" @click="updateGender('men')">
        <img src="/images/men_half.png" alt="MEN" class="object-cover w-full h-full" />
      </div>
    </div>

    <div v-if="categoryName" class="text-lg font-bold text-center my-6 bg-white py-2 shadow-sm z-10 relative">
      現在のカテゴリ:
      <span class="underline decoration-teal-700">{{ categoryName }}</span>
      <span v-if="searchKeyword"> 「{{ searchKeyword }}」の検索結果</span>
    </div>

    <product-list
      :keyword="search.keyword"
      :categoryId="search.categoryId"
      :gender="search.gender"
      :is-logged-in ="isLoggedIn"
    />
  </div>
</template>


<script>
import HeaderSearch from './HeaderSearch.vue';
import ProductList from './ProductList.vue';

export default {
  components: { HeaderSearch, ProductList },
  data() {
    return {
      search: {
        keyword: '',
        categoryId: '',
        gender: '',
      },
      products: [],
      pagination: {
        current_page: 1,
        last_page: 1,
      },
      categoryName: '',
      searchKeyword: '',
      currentLabel: '',
      isLoggedIn: window.App?.isLoggedIn || false,
    };
  },
  methods: {
    updateSearch({ keyword, categoryId }) {
      this.search.keyword = keyword;
      this.search.categoryId = categoryId;
      this.fetchLabel();
      this.fetchProducts();
    },
    updateGender(gender) {
      this.search.gender = gender;
      this.fetchLabel();
      this.fetchProducts();
    },
    async fetchProducts() {
      const res = await fetch('/api/products?' + new URLSearchParams({
        keyword: this.search.keyword,
        category_id: this.search.categoryId,
        gender: this.search.gender,
      }));
      const data = await res.json();
      this.products = data.data;
      this.pagination = {
        current_page: data.current_page,
        last_page: data.last_page,
      };
    },
    async fetchLabel() {
      try {
        const res = await fetch('/api/products?' + new URLSearchParams({
          keyword: this.search.keyword,
          category_id: this.search.categoryId,
          gender: this.search.gender,
        }));
        const data = await res.json();

        let cat = data.category_label;
        
        if (!cat && this.search.gender) {
          cat = this.search.gender === 'men'
            ? 'メンズ'
            : this.search.gender === 'women'
            ? 'レディース'
            : '全商品';
        }

        const word = data.keyword;

        this.categoryName = cat || '全商品';
        this.searchKeyword = word;

      }catch (err) {
        console.error('ラベル取得失敗:', err);
      }
    },
  },
  mounted() {
    //mitt経由HeaderSearchから検索イベント受信
    this.$emitter.on('search-updated', ({ keyword, categoryId }) => {
      this.search.keyword = keyword;
      this.search.categoryId = categoryId;
      this.fetchLabel();
      this.fetchProducts();
    });
    //初期表示
    this.updateSearch({ keyword: '', categoryId: '' });
  },
};
</script>