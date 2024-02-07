<template>
  <div class="container">
    <div class="row">
      <h1 class="my-2">Mon panier d'achats: </h1>
      <div v-if="getCartItems.length ==0">
        <p>Votre panier est vide!</p>
        <a href="/articles" class="btn btn-primary">Voir nos Articles disponibles</a>
      </div>
      <div v-else class="row">
        <div class="">
          <div v-for="article in getCartItems" :key="article.id">
            <div class="cart-item border my-2 p-2">
              <div class="row align-items-center">
                <div class="col-md-2">
                  <div class="article-image img-thumbnail w-100">Img</div>
                </div>
                <div class="col-md-2 col-lg-3">
                  <h4 class="fw-bold text-center h4">{{  article.label }}</h4>
                </div>
                <div class="col-md-2">
                  <h6>Quantité choisie: {{ article.pivot.quantity }}</h6>
                </div>
                <div class="col-md-2">
                  <h6 class="h4 fw-bold">{{ article.price }}€</h6>
                </div>
                <div class="col-md-1">
                  <button class="btn btn-danger w-100" @click="handleClick(article)">X</button>
                </div>
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
    ...mapActions(['getCurrentCart', 'removeItem', 'fetchCartItems', 'createCommande', 'fetchTotalPrice']),
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
   // this.fetchTotalPrice();

  }
}
</script>

<style lang="scss">
.article-image {
  width: 150px;
  min-height: 100px;

}
.cart-item {
  transition: all 200ms ease-in-out;
  border-radius: 10px;
}
</style>