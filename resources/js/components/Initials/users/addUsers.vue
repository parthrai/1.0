<template>

    <div>

        <div v-if="!this.isSubmitted">
            <h1>Admin User</h1>
            <transition name="bounce">
                <div class="alert alert-danger" v-if="!this.isValidated">
                    <strong>Error!</strong> Please enter valid information!
                </div>
            </transition>

            <form class="login100-form validate-form">

                <div class="wrap-input100 validate-input">

                    <input class="input100" type="text" id="u_name" placeholder="Admin user's name" v-model="data.name">
                    <span class="focus-input100"></span>

                    <span class="symbol-input100">
							<i class="fa fa-smile-o" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input">

                    <input class="input100" type="text" id="email" placeholder="email address" v-model="data.email">
                    <span class="focus-input100"></span>

                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input">

                    <input class="input100" type="text" id="password" placeholder="password" v-model="data.password">
                    <span class="focus-input100"></span>

                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
                    </span>


                </div>



                <div class="wrap-input100 validate-input">

                    <input class="input100" type="password" id="confirm_password" placeholder="confirm password " v-model="data.confirmPassword">
                    <span class="focus-input100"></span>

                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>








            </form>


            <div class="container-login100-form-btn">

                <div class="row">
                    <div class="col-lg-6">
                        <button class="login100-form-btn" v-on:click="back()">
                            Back
                        </button>
                    </div>

                    <div class="col-lg-6">
                        <button class="login100-form-btn" v-on:click="add()">
                            Add
                        </button>
                    </div>

                    <!---

                    <div class="col-lg-4">
                        <button class="login100-form-btn" v-on:click="randomPassword()">
                            Gen. Password
                        </button>

                    </div>

                    -->
                </div>



            </div>


        </div>
        <div v-else>

            <h1>Thank you for setting up the software</h1>

        </div>





    </div>

</template>

<script>

    import {store} from '../../../store/index'

    export default{

        data(){
            return{
                data:{
                    name:'',
                    email:'',
                    password:'',
                    confirmPassword:'',


                },

                isValidated : true,
                isSubmitted:false,



            }
        },

        methods:{

            add(){

                if(this.validate()) {
                    this.addUsers();
                  //  store.commit("increment", "UserComponent")
                }

                this.isSubmitted=true;
            },

            back(){
               store.commit("increment","SetupComponent")
            },

            validate(){

                if(this.data.name =="" || this.data.email == "" || this.data.password==""){
                    this.isValidated=false;
                    return false;
                }

                else if(this.data.password != this.data.confirmPassword){
                    this.isValidated=false;
                    return false;
                }

                else{
                    this.isValidated=true;
                    return true;
                }

            },


            addUsers(){


                axios.post('/addAdminUser', this.data)
                    .then(response => {
                        console.log(response);
                    });


            },

            randomPassword(){
                var randomstring = Math.random().toString(36).slice(-8);

                this.data.password=randomstring;
                this.data.confirmPassword=randomstring;
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