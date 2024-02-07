<template>
  <div class="container">
    <div class="row">
      <h1 class="my-2">Mon panier d'achat: </h1>
      <div v-if="getCartItems.length ==0">
        <p>Votre panier est vide!</p>
        <a href="/articles" class="btn btn-primary">Voir nos Articles disponibles</a>
      </div>
      <div v-else>
        <div v-for="article in getCartItems" :key="article.id">
          <div class="cart-item border my-2 p-2">
            <div class="row align-items-center">
              <div class="col-sm-2">
                <div class="article-image img-thumbnail">Img</div>
              </div>
              <div class="col-sm-2 col-md-3">
                <h4 class="fw-bold text-center h4">{{  article.label }}</h4>
              </div>
              <div class="col-sm-2">
                <h6 class="fw-bold">{{ article.price }}€</h6>
              </div>
              <div class="col-sm-2">
                <h6>Quantité choisie: {{ article.pivot.quantity }}</h6>
              </div>
              <div class="col-sm-1">
                <button class="btn btn-danger w-100" @click="handleClick(article)">X</button>
              </div>
            </div>
          </div>
        </div>
        <div class="cart-footer mt-5">
          <div class="prix-total">

            <h6 class="h2">Prix total: {{ total }}€</h6>
          </div>
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from '../store';
import { mapGetters, mapActions } from 'vuex';
export default {
  props: ['total'],
  computed: {
    ...mapGetters(['getCart', 'getCartItems'])
  },
  methods :{
    ...mapActions(['getCurrentCart', 'removeItem', 'fetchCartItems', 'createCommande']),
    handleSubmit()
    {
     this.createCommande(this.getCart, this.total);
    },
    handleClick(article) {
      this.removeItem(article)
      this.fetchCartItems();
    },
  },
  mounted() {
    this.getCurrentCart();
    this.fetchCartItems();
  }
}
</script>

<style lang="scss" scoped>
.article-image {
  width: 150px;
  min-height: 100px;
}
.cart-item {
  transition: all 200ms ease-in-out;
}
</style>