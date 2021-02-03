import Vue from 'vue'
import Vuex from 'vuex'
import Company from './modules/Company'
import Layout from './modules/Layout'
import Purchase from './modules/Purchase'
import ForeignPurchase from './modules/ForeignPurchase'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules:{
        Company,
        Layout,
        Purchase,
        ForeignPurchase,
    },
    plugins: [createPersistedState()]
})

export default store 
