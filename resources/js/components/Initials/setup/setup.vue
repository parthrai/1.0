<template>
    <div>


        <form>
            <div class="form-group">
                <label for="c_name">Company name</label>
                <input type="text" class="form-control" id="c_name" placeholder="Company Name">
            </div>
            <div class="form-group">
                <label for="l_key">License Key:</label>
                <input type="text" class="form-control" id="l_key" placeholder="License Key">
            </div>


        </form>

        <button  class="btn btn-primary" v-on:click="next()">Next</button>
    </div>
</template>

<script>
    import {store} from '../../../store/index'
    export default{



        methods:{

            next(){

              store.commit("increment","UserComponent")
            }

        }

    }
</script>