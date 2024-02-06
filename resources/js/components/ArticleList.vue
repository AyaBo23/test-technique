<template>
  <div class="container">
    <div class="row">
      <div v-for="article in getArticles" :key="article.id" class="col-sm-6 col-md-4">
        <div class="article border p-4 my-2">
          <div class="article-image">( Image de l'article)</div>
          <h2>{{ article.label}}</h2>
          <p class="fw-bold">{{ article.price}} €</p>
          <p>Quantité en stock: {{  article.stock_quantity  }}</p>
          
          <div class="buttons">
            <button class="btn btn-primary" @click="addToCart(article, $store.state.cart)">Ajouter au panier</button>
          </div>
        </div>
      </div> 
  </div>
  </div>
</template>

<script>
import store from '../store';
import { mapActions, mapGetters } from "vuex";
  export default {
    props: ["cart"],
    data() {
      return {
        myCart : this.cart
      }
    },
    computed: {
      ...mapGetters(['getArticles']),
    },
    methods: {
      ...mapActions(['fetchArticles', 'addArticle', 'getCurrentCart', 'addToCart']),
    },
    mounted() {
      this.fetchArticles();
      this.getCurrentCart();
    },
  }
</script>

<style lang="scss" scoped>
.article {
  &-image {
    min-height: 150px;
    background-color: rgb(248, 245, 245);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #eee;
    border-radius: 10px;
    margin-bottom: 10px;
  }
}
</style>