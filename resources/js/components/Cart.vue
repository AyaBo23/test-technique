<template>
  <div class="container">
    <div class="row">
      <div class="col-md-10" v-for="article in articles" :key="article.id">
        <div class="cart-item">
          <!-- Display article details -->
          <p>{{ article.label }}</p>
          <p>{{ article.price }}</p>
          <p>{{ article.pivot.quantity }}</p>
        </div>
      </div>
      <pre>{{ articles }}</pre>
    </div>
  </div>
</template>

<script>
import store from '../store';
import { mapGetters, mapActions } from 'vuex';
export default {
  props: ['articles'],
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

</style>