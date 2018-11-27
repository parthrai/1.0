<template>

    <div v-if="this.users!=0">
        <div class="card">
        <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
                <i class="material-icons">account_box</i>
            </div>
            <h4 class="card-title">Users ({{this.users.length}})</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>email</th>

                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr  v-for="user in users">
                        <td class="text-center">{{user.id}}</td>
                        <td ><img src="https://www.pngarts.com/files/3/Avatar-PNG-Photo.png" height="70" width="70"/></td>

                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>


                        <td class="td-actions text-right">
                            <button type="button" rel="tooltip" class="btn btn-info">
                                <i class="material-icons">person</i>
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-success">
                                <i class="material-icons">edit</i>
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-danger">
                                <i class="material-icons">close</i>
                            </button>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <div v-else>
        <img src="../../../loading.gif" height="70" width="70"/>
    </div>

</template>

<script>

    export default{

        data(){

            return{
                users:''

            }
        },

        created(){
            this.fetchUsers();
        },
        methods:{

            fetchUsers(){
                axios.get('/api/users').then(response => {
                    console.log(response.data.length);
                    this.users=response.data
                });

            }
        }


    }

</script>