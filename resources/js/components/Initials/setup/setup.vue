<template>
    <div>

        <transition name="bounce">
            <div class="alert alert-danger" v-if="!this.isValidated">
                <strong>Error!</strong> Please enter valid information!
            </div>
        </transition>

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
                licenseKey:'',
                isValidated : true,

            }



        },


        methods:{

            next(){
                console.log(this.companyName);

                if(this.validate()) {
                    this.updateCompanyName();
                    store.commit("increment", "UserComponent")
                }
            },


            updateCompanyName(){


                const info = {
                    companyName : this.companyName,
                    licenseKey : this.licenseKey
                }


                console.log(info)



                    axios.post('/updateCompanyName', info)
                        .then(response => {
                            console.log(response);
                        });


            },

            validate(){
                if(this.companyName=="" || this.licenseKey==""){
                   this.isValidated=false;
                   return false
                }

                else
                    return true;
            }

        }

    }
</script>


<style>
    .bounce-enter-active {
        animation: bounce-in .5s;
    }
    .bounce-leave-active {
        animation: bounce-in .5s reverse;
    }
    @keyframes bounce-in {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(1);
        }
    }
</style>