<template>
  <form @submit.prevent="emitSearch" class="flex flex-col sm:flex-row items-stretch items-center gap-2">
    <select v-model="localCategoryId" class="border border-gray-300 rounded px-3 py-1 focus:outline-none">
      <option value="">-- カテゴリを選択 --</option>
      <option value="all">全商品</option>
      <template v-for="parent in categories" :key="parent.id">
        <option :value="parent.id">◆ {{ parent.name }}</option>
        <option v-for="child in parent.children" :key="child.id" :value="child.id">
          {{ child.name }}
        </option>
      </template>
    </select>
    
    <input
      v-model="localKeyword"
      @input="debouncedEmit"
      type="text"
      placeholder="商品名で検索"
      class="border border-gray-300 rounded px-3 py-1 focus:outline-none"
    />

    <button
      type="submit"
      class="bg-gray-800 text-white px-4 py-1 rounded-r-md hover:bg-gray-700"
    >
      検索
    </button>
  </form>
</template>

<script>
import axios from 'axios';
import debounce from 'lodash/debounce';

export default {
  props: {
    useRedirect: {
      type: Boolean,
      default: false,
    },
    keyword: String,
    categoryId: [String, Number],
  },
  data() {
    return {
      localKeyword: this.keyword || '',
      localCategoryId: this.categoryId || '',
      categories: [],
    };
  },
  mounted() {
    axios.get('/api/categories').then((res) => {
      this.categories = res.data;
    });
  },
methods: {
  emitSearch() {
    // キーワードとカテゴリIDを取得（空白trim、"all"→""に置換）
    const keyword = this.localKeyword?.trim() || '';
    const categoryId = this.localCategoryId === 'all' ? '' : this.localCategoryId;

    // 🔍 コンソール確認用ログ
    console.log('🔍 HeaderSearch emit: keyword =', keyword, ', categoryId =', categoryId);

    if (this.useRedirect) {
      // GETパラメータ形式でリダイレクト（リダイレクト検索時）
      const params = new URLSearchParams();
      if (keyword) params.append('keyword', keyword);
      if (categoryId) params.append('category_id', categoryId);
      window.location.href = `/products?${params.toString()}`;
    } else {
      // mitt を使って App.vue に検索条件を通知（非同期検索時）
      this.$emitter.emit('search-updated', {
        keyword,
        categoryId,
      });
    }
  },

  // インクリメンタルサーチ用：500ms以内に連続入力が止まったらemitSearch()を実行
  debouncedEmit: debounce(function () {
    this.emitSearch();
  }, 500),
},
};
</script>