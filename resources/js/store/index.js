import { createStore } from "vuex"
import axios from 'axios'

const store = new createStore({
  state: {
    commandes : [],
    articles : [],
    cart: {}
  }, 
  getters: {
    getCommandes(state) {
      return state.commandes
    },
    getArticles(state) {
      return state.articles
    },
    getCart(state) {
      return state.cart
    }
  },
  actions: {
    // Obtenir les commandes de la base de données
    fetchCommandes({commit}) {
      axios.get('/commandes')
      .then( res => {
        commit('setCommandes', res.data)
      }).catch( err => {
        console.log(err.message)
      })
    },

    //Obtenir les articles de la base de données

    fetchArticles({commit}) {
      axios.get('/articles')
      .then( res => {
        commit('setArticles', res.data)
      }).catch( err => {
        console.log(err.message)
      })
    },
    getCurrentCart({commit}) {
      axios.get('/currentCart')
      .then( res => {
        console.log(res.data)
        commit('setCart', res.data)
      }).catch( err => {
        console.log( err.message)
      })
    },
    addToCart({ commit, getters }, article) {
      const cartId = getters.getCart.id;
      
      const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
      axios.put(`/cart/${cartId}`, article, {
        headers: {
          'X-CSRF-TOKEN': csrfToken,
        },
      })
      .then(res => {
        console.log(res.data);
      })
      .catch(err => {
        console.log(err.message);
      });
    }
    
  },
  mutations: {
    setCart(state, payload) {
      state.cart = payload
    },
    setCommandes(state, payload) {
      state.commandes = payload
    },
    setArticles(state, payload) {
      state.articles = payload
    }
  }
})

export default store