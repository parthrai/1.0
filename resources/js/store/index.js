import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
export const store = new Vuex.Store({

    state:{
        name:'Parth',

        component: 'SetupComponent',

      

    },


    mutations : {

        increment (state, n) {
            state.component = n
        },

        setupInfo(state,n){
           state.setup = n
        },


    },



    actions:{},

    getters:{

        getComponent(state){
            return state.component
        },

        getSetupInfo(state){
            return state.setup
        },

    },







})