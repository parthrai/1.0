<template>
    <div class="col-md-6">

        <Loading :active.sync="isLoading"
                 :can-cancel="true"
                 :on-cancel="onCancel"
                 :is-full-page="fullPage"></Loading>




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
            <div class="card-footer ml-auto mr-auto" >
                <button  class="btn btn-rose" @click="addSites()"> Add
                </button>
            </div>
        </div>






    </div>

</template>

<script>

    import {store} from '../../../store/index'
    import Loading from 'vue-loading-overlay';

    import 'vue-loading-overlay/dist/vue-loading.css';



    export default{

        data(){
            return{
                data:{
                    site:'',

                },
                isLoading: false,
                fullPage: true
            }
        },
        components: {
            Loading
        },


        methods:{

            addSites(){
                this.isLoading=true;


                let data ={
                   site:this.data.site
               }

               let newData = {
                   component:'siteTemplateComponent',
                   site_name:this.data.site
               }

                axios.post('/sites/add', data)
                    .then(response => {
                        console.log(response);


                        store.commit("mut_addSite_component",'siteTemplateComponent')
                        store.commit("mut_addSite_site_name",this.data.site)
                        store.commit("mut_addSite_site_id",response.data.site.id)


                        this.isLoading=false;

                    });



            },



        }
    }

</script>