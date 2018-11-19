<template>

    <div>
        <h1>Admin User</h1>

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

        <button class="btn btn-primary" v-on:click="back()">Back</button>
        <button  class="btn btn-primary">Finish</button>


    </div>

</template>

<script>

    import {store} from '../../../store/index'

    export default{

        methods:{

            back(){
               store.commit("increment","SetupComponent")
            }

        }
    }
</script>