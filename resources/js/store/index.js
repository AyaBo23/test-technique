import { createStore } from "vuex"
import axios from 'axios'

const store = new createStore({
  state: {
    commandes : [],
    articles : [],
    cart: {},
    cartItems: {}
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
    },
    getCartItems(state) {
      return state.cartItems
    }
  },
  actions: {

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
        commit('setCart', res.data)
      }).catch( err => {
        console.log( err.message)
      })
    },
    fetchCartItems({commit}) {
      axios.get('/cartItems')
      .then( res => {
        commit('setCartItems', res.data)
      }).catch( err => {
        console.log( err.message)
      })
    },
    /*
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
    },*/
    
    //Supprimer un article du panier d'achat
    removeItem({commit, getters}, article) {
      console.log('removing...')

      const cartId = getters.getCart.id;
      
      const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
      axios.delete(`/cart/${cartId}/article/${article.id}`,{
        headers: {
          'X-CSRF-TOKEN': csrfToken,
        },
      })
      .then(res => {
        console.log(res.data);
        commit('setCartItems', res.data);
      })
      .catch(err => {
        console.error(err);
      });
    },

    //Gestion de commandes :
    
    // Obtenir les commandes de la base de données
    fetchCommandes({commit}) {
      axios.get('/commandes')
      .then( res => {
        commit('setCommandes', res.data)
      }).catch( err => {
        console.log(err.message)
      })
    },

    createCommande({commit}, cart, total) {
      console.log('test action')
      const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

      axios.post('/commandes', {
        headers: {
          'X-CSRF-TOKEN': csrfToken,
        },
        data: {
          getters,
          total
        }
      })
      .then( res => {
        console.log(res.data)
      })
      .catch( err => {
        console.log(err.message)
      })
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
    },
    setCartItems(state, payload) {
      state.cartItems = payload
    }
  }
})

export default store