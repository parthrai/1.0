c<template>

    <div>

        <transition name="fade" mode="out-in">
            <keep-alive>
                <component v-bind:is="component"> </component>
            </keep-alive>
        </transition>

        <button class="btn btn-success" v-on:click="check()">check</button>

    </div>


</template>

<script>
       import SetupComponent from './setup/setup';
       import UserComponent from './users/addUsers';

    export default {
        components:{
            'SetupComponent':SetupComponent,
            'UserComponent' : UserComponent,
        },

        computed:{



            component:{
                get(){

                    console.log("hello yo yo ");
                   // this.updateCompanyName();
                    return this.$store.getters.getComponent;
                }


            }

        },

        methods:{

                check(){
                    console.log("hello");
                    console.log(this.$store.getters.getSetupInfo);
                },



        },

        mounted() {
            console.log('Component mounted.')
        }
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