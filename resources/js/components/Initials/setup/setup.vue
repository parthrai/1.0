<template>
    <div>

            <span class="login100-form-title">
						CMS Setup
            </span>

        <transition name="bounce">
            <div class="alert alert-danger" v-if="!this.isValidated">
                <strong>Error!</strong> Please enter valid information!
            </div>
        </transition>

        <form class="login100-form validate-form">


            <div class="wrap-input100 validate-input">

                <input class="input100" type="text" id="c_name" placeholder="Company's name" v-model="companyName">
                <span class="focus-input100"></span>

                <span class="symbol-input100">
							<i class="fa fa-institution" aria-hidden="true"></i>
                </span>
            </div>

            <div class="wrap-input100 validate-input">

                <input class="input100" type="text" id="l_key" placeholder="License Key" v-model="licenseKey">
                <span class="focus-input100"></span>

                <span class="symbol-input100">
							<i class="fa fa-shield" aria-hidden="true"></i>
                </span>
            </div>




        </form>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" v-on:click="next()">
                Next
            </button>
        </div>

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