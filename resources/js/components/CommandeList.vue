<template>
  <div>
    <h1>Mes commande:</h1>
    <div v-if="getCommandes != 0">
      <div v-for="commande in getCommandes" :key="commande.id" class="commande">
        <p>Numéro de commande : {{commande.id}}</p>
      </div>
    </div>
    <div v-else>
      <p>Vous n'avez pas encore passé de commandes. Voir nos article disponibles: </p>
    </div>

    <a class="btn btn-primary" href="/articles">Articles</a>
  </div>
</template>

<script>
import store from '../store';
import { mapActions, mapGetters } from "vuex";
  export default {
    computed: {
      ...mapGetters(['getCommandes'])
    },
    methods: {
      ...mapActions(['fetchCommandes'])
    },
    created() {
      this.fetchCommandes();
    }
  }
</script>

<style lang="scss" scoped>

</style>