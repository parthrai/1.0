<template>

    <div>

        <div v-if="!this.isSubmitted">
            <h1>Admin User</h1>
            <transition name="bounce">
                <div class="alert alert-danger" v-if="!this.isValidated">
                    <strong>Error!</strong> Please enter valid information!
                </div>
            </transition>

            <form>
                <div class="form-group">
                    <label for="u_name">Name</label>
                    <input type="text" class="form-control" id="u_name" placeholder="Admin user's name" v-model="data.name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="email address" v-model="data.email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" placeholder="password" v-model="data.password">

                    <label class="btn btn-primary" @click="randomPassword()">Generate Password</label>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" placeholder="confirm password " v-model="data.confirmPassword">


                </div>


            </form>

            <button class="btn btn-primary" v-on:click="back()">Back</button>
            <button  class="btn btn-primary" @click="add()">Add</button>
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
                console.log("clicked");
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

                console.log("success");
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