<template>
    <div>

        <Loading :active.sync="isLoading"
                 :can-cancel="true"
                 :on-cancel="onCancel"
                 :is-full-page="fullPage"></Loading>

        <notifications group="foo"   />



        <h1>Select site template for {{getSite.site_name}} </h1>

        <button class="btn btn-primary" @click="deploy">Deploy <i v-if="btnLoading" class="fa fa-spinner fa-spin" style="font-size:24px"></i></button>

        <div class="row">
            <div class="col-lg-3">
                <img src="../../../images/templates/temp1.png" width="100%" > <br>
                <button class="btn btn-primary" @click="select" id="yelp"> select </button>
            </div>

            <div class="col-lg-3">

                    <img src="../../../images/templates/temp2.png" width="100%" > <br>
                    <button class="btn btn-primary" @click="select" id="temp2"> select </button>

            </div>


        </div>
    </div>
</template>


<script>

    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';



    export default{



        data(){
            return{

                    site_name:'',
                    site_id:'',


                isLoading: false,
                btnLoading: false,
                fullPage: true



            }
        },

        components: {
            Loading
        },

    computed:{
        getSite:{
            get(){


                let site=  this.$store.getters.getLoader_addSite;

                this.site_name=site.site_name
                this.site_id=site.site_id

                return site
            }


        }

    },


        methods:{


            select(event){

                this.isLoading=true

                let data={

                    site_id : this.site_id,
                    site_name : this.site_name,
                    template: event.target.id
                }

                console.log(data)

                axios.post('/api/sites/git', data)
                    .then(response => {
                        console.log(response);

                        this.isLoading=false
                        this.deploy();



                    });

                console.log("clicked "+event.target.id)

            },


            deploy(){

                this.btnLoading=true

                let data={
                    site_id : this.site_id,
                    site_name : this.site_name,
                    template: event.target.id
                }

                console.log(data)

                axios.post('/api/sites/deploy', data)
                    .then(response => {
                        console.log(response);




                        this.btnLoading=false

                        this.$notify({
                            group: 'foo',
                            title: 'Important message',
                            type:'success',
                            text: 'Template Deployed !'
                        });


                    });

            }
        }

    }



</script>