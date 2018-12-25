import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
export const store = new Vuex.Store({

    state:{
        name:'Parth',

        component: 'SetupComponent',

        Loader_addsite :'addSiteComponent'



    },


    mutations : {

        increment (state, n) {
            state.component = n
        },

        setupInfo(state,n){
           state.setup = n
        },


        mut_addSite(state,n){

            state.Loader_addsite = n
        }


    },



    actions:{},

    getters:{

        getComponent(state){
            return state.component
        },


        getLoader_addSite(state){

            return state.Loader_addsite
        },

        getSetupInfo(state){
            return state.setup
        },

    },







})