<template>

    <div>

        <transition name="fade" mode="out-in">
            <keep-alive>
                <component v-bind:is="component"> </component>
            </keep-alive>
        </transition>



    </div>

</template>


<script>

   import addSite from './addSite'
   import siteTemplate from './siteTemplate'

    export default {
        components:{
            'addSiteComponent':addSite,
            'siteTemplateComponent' :siteTemplate

        },

        computed:{



            component:{
                get(){


                    return this.$store.getters.getLoader_addSite;
                }


            }

        },

    }

</script>



<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }

</style>