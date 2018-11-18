<template>

    <div>

        <transition name="fade" mode="out-in">
            <component v-bind:is="component"> </component>
        </transition>

        <button v-on:click="component='SetupComponent'">Back</button>
        <button v-on:click="component='UserComponent'">Next</button>
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
        data(){
            return {
                component : 'SetupComponent'
            }
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