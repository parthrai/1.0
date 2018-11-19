<template>
    <div>


        <form>
            <div class="form-group">
                <label for="c_name">Company name</label>
                <input type="text" class="form-control" id="c_name" placeholder="Company Name" v-model="companyName">
            </div>
            <div class="form-group">
                <label for="l_key">License Key:</label>
                <input type="text" class="form-control" id="l_key" placeholder="License Key" v-model="licenseKey">
            </div>


        </form>

        <button  class="btn btn-primary" v-on:click="next()">Next</button>
    </div>
</template>

<script>
    import {store} from '../../../store/index'
    export default{

        data(){

            return{
                companyName:'',
                licenseKey:''
            }



        },


        methods:{

            next(){
                console.log(this.companyName);
                this.updateCompanyName();
              store.commit("increment","UserComponent")
            },


            updateCompanyName(){

                const info = {
                    companyName : this.companyName,
                    licenseKey : this.licenseKey
                }


                console.log(info)

                axios.post('/updateCompanyName',info)
                    .then(response => {
                        console.log(response);
                    });


            }

        }

    }
</script>