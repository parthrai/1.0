<template>
    <div v-if="this.sites!=0">

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
                        <a href="#/sites/add" class="btn btn-primary">Add Site</a>


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

                            <th @click="sort('site_name')">Site </th>
                            <th @click="sort('username')">User </th>


                            <th >SSL </th>

                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(site, index) in (sortedActivity, filteredList)" :key="index">



                            <td class="text-center">{{site.site_id}}</td>


                            <td>{{site.site_name}}</td>
                            <td>{{site.username}}</td>


                            <td>
                                <span v-if="sslStatus[site.site_id]=='undef'">
                                    <img src="../../../images/loading_dots.gif" height="40" width="50">
                                </span>
                                <span v-else>
                                    {{sslStatus[site.site_id]}}
                                </span>

                            </td>


                            <td class="td-actions text-right">

                                <button type="button" rel="tooltip" class="btn btn-warning">
                                    <i class="material-icons" @click="enableSSL(site)">security</i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-success">
                                    <i class="material-icons">remove_red_eye</i>
                                </button>

                                <button type="button" rel="tooltip" class="btn btn-danger" @click="deleteSite(site)">
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
                sslStatus:[],



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
            this.fetchSitesSSL()
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
                    let name = data.site_name.toLowerCase().match(this.search.toLowerCase());
                    let user = data.username.toLowerCase().match(this.search.toLowerCase());

                    return name || user ;
                }).filter((row, index) => {
                    let start = (this.currentPage-1)*this.pageSize;
                    let end = this.currentPage*this.pageSize;
                    if(index >= start && index < end) return true;
                });
            }
        },
        methods:{

            /*********************** DATA TABLE FUNCTIONS ******************************/
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

            /*********************** END DATA TABLE FUNCTIONS ******************************/


            /*********************** SITES FUNCTIONS ******************************/

            addSites(){

                let data ={
                    site: this.site
                }

                axios.post('/sites/add', data)
                    .then(response => {
                        console.log(response);


                        this.fetchSites();
                        this.fetchSitesSSL();
                    });

            },

            fetchSites(){
                console.log("heeeeree")

                axios.get('/api/sites').then(response => {

                    this.sites=response.data
                });

            },

            deleteSite(site){


                let data={
                    site_id:site.site_id
                }
                let ref = this


                Vue.dialog.confirm('Are you sure you want to delete '+site.site_name +' ?  ')
                    .then(function (dialog) {
                        axios.post('/api/sites/delete',data).then(response => {

                            //  console.log(response.data)

                            console.log("deleted")
                            ref.fetchSites();


                        })

                        console.log("in dialog");
                    })
                    .catch(function () {
                        console.log('Clicked on cancel')
                    });
            },


            /*********************** END SITES FUNCTIONS ******************************/


            /*********************** SSL FUNCTIONS ******************************/

            fetchSitesSSL(){

                axios.get('/api/sites/ssl/sites').then(response => {

                    this.sslStatus=response.data;

                    this.sslCheck()
                })

            },


            sslCheck(){
                for(let site in this.sslStatus){



                    console.log("id = " + site)



                    let data={
                        site:site
                    }

                    axios.post('/api/sites/ssl/check',data).then(response => {

                        this.sslStatus[site]=response.data
                    })

                }
            },


            enableSSL(site){
                console.log("hello")

                let data={
                    site_id:site.site_id,
                    site_name:site.site_name
                }

                let ref= this




                Vue.dialog.confirm('Would you like to enable SSL for  '+site.site_name +' ?  ')
                    .then(function (dialog) {
                        axios.post('/api/sites/ssl/enable',data).then(response => {

                            console.log(response.data)

                            ref.fetchSitesSSL();
                        })
                    })
                    .catch(function () {
                        console.log('Clicked on cancel')
                    });




            },



            /*********************** END SSL FUNCTIONS ******************************/







        }


    }

</script>