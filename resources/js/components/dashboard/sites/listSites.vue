<template>
    <div v-if="this.sites!=0">
        <!-- Modal -->

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
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
                                    <input type="text" class="form-control" id="siteName" required="true"  v-model="site">
                                </div>

                                <div class="category form-category">* Required fields</div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button  class="btn btn-rose" @click="addSites()">Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- End Modal -->

        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card-icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <h4 class="card-title">Sites ({{this.sites.length}})</h4>

                    </div>
                    <div class="col-lg-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Site</button>
                    </div>
                </div>

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

                            <th @click="sort('name')">Site </th>
                            <th @click="sort('user')">User </th>
                            <th>Site_ID </th>
                            <th>Server_ID </th>
                            <th >SSL </th>

                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(site, index) in (sortedActivity, filteredList)" :key="index">


                            <td class="text-center">{{site.id}}</td>


                            <td>{{site.name}}</td>
                            <td>{{site.user.name}}</td>
                            <td>{{site.site_id}}</td>
                            <td>{{site.server_id}}</td>
                            <td><input type="checkbox" @change="SSLcheck(site.site_id,site.name,site.server_id,$event)"></td>


                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" class="btn btn-success">
                                    <i class="material-icons">remove_red_eye</i>
                                </button>

                                <button type="button" rel="tooltip" class="btn btn-danger" @click="deleteUser(user.id)">
                                    <i class="material-icons">close</i>
                                </button>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <button @click="prevPage" class="float-left btn btn-outline-info btn-sm"><i class="material-icons">navigate_before</i> Previous</button>
                    <button @click="nextPage" class="float-right btn btn-outline-info btn-sm">Next <i class="material-icons">navigate_next</i></button>
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
                site:'',

                sites:[],
                currentSort:'name',
                currentSortDir:'asc',
                search: '',
                searchSelection: '',
                pageSize: 5,
                currentPage: 1

            }
        },

        created(){
            this.fetchSites();
        },

        computed:{



            sortedActivity:function() {

                return this.sites.sort((a,b) => {
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
                return this.sites.filter((data) => {
                    let name = data.name.toLowerCase().match(this.search.toLowerCase());
                    let user = data.user.name.toLowerCase().match(this.search.toLowerCase());

                    return name || user ;
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
                if((this.currentPage*this.pageSize) < this.sites.length) this.currentPage++;
            },
            prevPage:function() {
                if(this.currentPage > 1) this.currentPage--;
            },

            addSites(){

                console.log(this.site);

                axios.post('/sites/add', this.data)
                    .then(response => {
                        console.log(response);
                    });

            },




            SSLcheck(site_id,site_name,server_id,event){

                var status = event.target.checked

                console.log(event.target.checked)

                var site_details = {
                    site_id:site_id,
                    site_name:site_name,
                    server_id : server_id

                }

                if(status){

                    console.log("here");

                    axios.post('/api/sites/ssl/enable', site_details)
                        .then(response => {
                            console.log(response);
                        });

                }
                else{
                    console.log("theress" + status);
                }
            },

            fetchSites(){
                axios.get('/api/sites').then(response => {
                    console.log("the length 9si "+response.data.length);
                    this.sites=response.data
                });

            },

            deleteUser(user_id){

                let user ={
                    user_id : user_id
                }



                console.log("the user is id " + user_id);

                axios.post('/api/users/delete',user).then(response => {

                    console.log(response.data);
                    this.fetchUsers();
                });


            }



        }


    }

</script>