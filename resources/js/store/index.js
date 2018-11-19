import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
export const store = new Vuex.Store({

    state:{
        name:'Parth',

        component: 'SetupComponent'


    },


    mutations : {

        increment (state, n) {
            state.component = n
        }

    },

    actions:{},

    getters:{

        getName(state){


            return state.name
        },

        getComponent(state){
            return state.component
        },

    },







})