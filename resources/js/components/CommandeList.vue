<template>
  <div>
    <h1 class="mb-5">Mes commandes:</h1>
    <div v-if="getCommandes != 0">
    <div class="accordion">
      <div class="accordion" id="commandeAccordion">
          <div class="accordion-item" v-for="commande in getCommandes" :key="commande.id">
            <div class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="`#Commande${commande.id}`" aria-expanded="false" :aria-controls="`Commande${commande.id}`">
                <div>
                  <h5>Commande n° {{ commande.id }}</h5>
                  <p class="fw-bold">{{ commande.price }}€</p>
                </div>
              </button>
            </div>
            <div :id="`Commande${commande.id}`" class="accordion-collapse collapse" data-bs-parent="#commandeAccordion">
              <div class="accordion-body">
                <div class="article border p-4 my-2" v-for="article in commande.articles" :key="article.id">
                  <div class="row align-items-center">
                    <div class="col-sm-2">
                      <div class="article-image img-thumbnail">Img</div>
                    </div>
                    <div class="col-sm-2 col-md-3">
                      <h4 class="fw-bold text-center h4">{{  article.label }}</h4>
                    </div>
                    <div class="col-sm-3">
                      <h6 class="fw-bold">{{ article.price }}€</h6>
                    </div>
                    <div class="col-sm-4">
                      <h6>Quantité commandée: {{ article.pivot.quantity }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <p>Vous n'avez pas encore passé de commandes. Voir nos article disponibles: </p>
    </div>
    <a class="btn btn-primary mt-4" href="/articles">Magasin</a>
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