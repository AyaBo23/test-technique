<template>
  <div class="container">
    <div class="row">
      <div v-for="article in getArticles" :key="article.id" class="col-sm-6 col-md-4">
        <div class="article border p-4 my-2">
          <div class="article-image">( Image de l'article)</div>
          <h2>{{ article.label}}</h2>
          <p class="fw-bold">{{ article.price}} €</p>
          <label for="quantity">Quantité:</label>
          <select  v-model="article.quantity" name="quantity" class="form-control my-2" required>
            <option v-for="i in article.stock_quantity" :key="i" :value="i">{{ i }}</option>
          </select>
          <div class="error-message" v-if="article.error">{{ article.error }}</div>
          <div v-if="article.added" class="alert alert-success article-alert" role="alert">
            Article ajouté avec succès!
          </div>
          <div class="buttons">
            <button class="btn btn-primary" @click="handleAddToCart(article, $store.state.cart)">Ajouter au panier</button>
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
        myCart : this.cart,
      }
    },
    computed: {
      ...mapGetters(['getArticles']),
    },
    methods: {
      ...mapActions(['fetchArticles', 'addArticle', 'getCurrentCart', 'addToCart']),
      handleAddToCart(article) {
        if (!article.quantity) {
        article.error = "Veuillez sélectionner une quantité.";
        article.added = false;
        return;
      }

      this.addToCart(article, this.cart)
        .then(() => {
          article.error = null;
          article.added = true;
          article.quantity = 0; 
          setTimeout(() => {
            article.added = false;
          }, 3000);
        })
        .catch((error) => {
          article.error = "Erreur lors de l'ajout au panier.";
          article.added = false;
        });
      },
    },
    mounted() {
      this.fetchArticles();
      this.getCurrentCart();
    }
  }
</script>

<style lang="scss" scoped>
.article {
  &-image {
    min-height: 150px;
    width: 100%;
    background-color: rgb(248, 245, 245);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #eee;
    border-radius: 10px;
    margin-bottom: 10px;
  }
  .error-message {
    color: red;
    margin-top: 5px;
  }
  &-alert {
    position: absolute;
    top: 50px;
    right: 0;
    left: 0;
    width: 480px;
    margin: auto;
  }
}
</style>