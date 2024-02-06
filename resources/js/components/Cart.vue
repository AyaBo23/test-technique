<template>
  <div class="container">
    <div class="row">
      <h1 class="my-2">Mon panier d'achat: </h1>
      <div v-for="article in articles" :key="article.id">
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
              <button class="btn btn-danger w-100">X</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="cart-footer mt-5">
      <div class="prix-total">
        <slot></slot>
        <h6 class="h2">Prix total:  {{ totalPrice }}€</h6>
      </div>
      <button class="btn btn-primary btn-lg">
        Commander Maintenant
      </button>
    </div>

  </div>
</template>

<script>
import store from '../store';
import { mapGetters, mapActions } from 'vuex';
export default {
  props: ['articles','totalPrice'],
  computed: {
   // ...mapGetters(['getCart'])
  },
  methods :{
    ...mapActions(['getCurrentCart']),
  },
  mounted() {
    this.getCurrentCart();
  }
}
</script>

<style lang="scss" scoped>
.article-image {
  width: 150px;
  min-height: 100px;
}
.cart-footer {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: space-between;
}
</style>