import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
export const store = new Vuex.Store({

    state:{
        name:'Parth',

        component: 'SetupComponent',

        Loader_addsite :{
            component:'addSiteComponent',
            site_name:'',
            site_id:''
        }



    },


    mutations : {

        increment (state, n) {
            state.component = n
        },

        setupInfo(state,n){
           state.setup = n
        },


        mut_addSite_component(state,n){

            state.Loader_addsite.component = n
        },

        mut_addSite_site_name(state,n){
            state.Loader_addsite.site_name=n
        },

        mut_addSite_site_id(state,n){
            state.Loader_addsite.site_id=n
        }



    },



    actions:{},

    getters:{




        getLoader_addSite(state){

            return state.Loader_addsite
        },

        getSetupInfo(state){
            return state.setup
        },

    },







})