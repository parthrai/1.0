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
                <div class="form-group">
                    <input type="text" class="form-control" v-model="search" placeholder="Search">
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Avatar</th>
                        <th @click="sort('name')">Name </th>
                        <th @click="sort('email')">email </th>

                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(user, index) in (sortedActivity, filteredList)" :key="index">


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
                <button @click="prevPage" class="float-left btn btn-outline-info btn-sm"><i class="fas fa-arrow-left"></i> Previous</button>
                <button @click="nextPage" class="float-right btn btn-outline-info btn-sm">Next <i class="fas fa-arrow-right"></i></button>
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
                users:[],
                currentSort:'name',
                currentSortDir:'asc',
                search: '',
                searchSelection: '',
                pageSize: 5,
                currentPage: 1

            }
        },

        created(){
            this.fetchUsers();
        },

        computed:{
            sortedActivity:function() {
                return this.users.sort((a,b) => {
                    let modifier = 1;
                    if(this.currentSortDir === 'desc') modifier = -1;
                    if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                    if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                    return 0;
                }).filter((row, index) => {
                    let start = (this.currentPage-1)*this.pageSize;
                    let end = this.currentPage*this.pageSize;
                    if(index >= start && index < end) return true;
                });
            },

            filteredList () {
                return this.users.filter((data) => {
                    let email = data.email.toLowerCase().match(this.search.toLowerCase());
                    let name = data.name.toLowerCase().match(this.search.toLowerCase());

                    return email || name ;
                }).filter((row, index) => {
                    let start = (this.currentPage-1)*this.pageSize;
                    let end = this.currentPage*this.pageSize;
                    if(index >= start && index < end) return true;
                });
            }
        },
        methods:{
            sort:function(s) {

                console.log("here")

                if(s === this.currentSort) {
                    this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
                }
                this.currentSort = s;
            },
            nextPage:function() {
                if((this.currentPage*this.pageSize) < this.users.length) this.currentPage++;
            },
            prevPage:function() {
                if(this.currentPage > 1) this.currentPage--;
            },

            fetchUsers(){
                axios.get('/api/users').then(response => {
                    console.log(response.data.length);
                    this.users=response.data
                });

            }
        }


    }

</script>