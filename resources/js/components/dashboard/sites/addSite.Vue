<template>
    <div class="col-md-6">

        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title">Add new website</h4>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <label for="siteName" class="bmd-label-floating"> Site *</label>
                    <input type="text" class="form-control" id="siteName" required="true"  v-model="data.site">
                </div>

                <div class="category form-category">* Required fields</div>
            </div>
            <div class="card-footer ml-auto mr-auto">
                <button  class="btn btn-rose" @click="addSites()">Add</button>
            </div>
        </div>






    </div>

</template>

<script>

    import {store} from '../../../store/index'

    export default{

        data(){
            return{
                data:{
                    site:'',


                }
            }
        },

        methods:{

            addSites(){

               let data ={
                   site:this.data.site
               }

                axios.post('/sites/add', data)
                    .then(response => {
                        console.log(response);


                        store.commit("mut_addSite", "siteTemplateComponent")
                    });



            },



        }
    }

</script>