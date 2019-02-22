<template>
    <div>

        <!--------------- TOP REFERRS CHART -------------------------->

        <div class="card bg-light text-dark">

            <div class="card-header">Top Referrers</div>

            <div class="card-body">

              <div v-if="this.referrers.chartData.length != 0">
                  <GChart
                          type="ColumnChart"
                          :data="referrers.chartData"
                          :options="referrers.chartOptions"
                  />

              </div>
              <div v-else class="text-center">
                    <img src="../../../images/graph_loading.gif" height="70" width="70"/>
              </div>

            </div>
        </div>

        <!---------------END  TOP REFERRS CHART --------------------------->

        <!--------------- BROWSERS & USER TYPES CHARTS -------------------->

        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-light text-dark">

                    <div class="card-header">Top Browsers</div>

                    <div class="card-body">

                        <div v-if="this.browsers.chartData.length != 0">

                            <GChart
                                    type="PieChart"
                                    :data="browsers.chartData"
                                    :options="browsers.chartOptions"
                            />
                        </div>
                        <div v-else class="text-center">

                            <img src="../../../images/graph_loading.gif" height="70" width="70"/>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card bg-light text-dark">

                    <div class="card-header">User Types</div>

                    <div class="card-body">

                        <div v-if="this.userTypes.chartData.length != 0">

                            <GChart
                                    type="PieChart"
                                    :data="userTypes.chartData"
                                    :options="userTypes.chartOptions"
                            />
                        </div>

                        <div v-else class="text-center">

                            <img src="../../../images/graph_loading.gif" height="70" width="70"/>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!--------------- END BROWSERS & USER TYPES CHARTS -------------------->



    </div>
</template>

<script>

    import { GChart } from 'vue-google-charts'


    export default {

        data(){
            return{

                /************************** DATA FOR CHARTS ***************************/
                referrers : {
                    chartData: [],
                    chartOptions: {
                        chart: {
                            title: 'Company Performance',
                            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                        }
                    },

                    isLoaded: false,
                },

                browsers : {
                    chartData: [],
                    chartOptions: {
                        chart: {
                            title: 'Company Performance',
                            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                        }
                    },

                    isLoaded: false,
                },

                userTypes : {
                    chartData: [],
                    chartOptions: {
                        chart: {
                            title: 'Company Performance',
                            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                        }
                    },

                    isLoaded: false,
                }

                /************************** END DATA FOR CHARTS ************************/

            }
        },

        components: {
            GChart
        },

        created(){



            this.fetchReferrers();
            this.fetchBrowsers();
            this.fetchUserTypes();
        },



        methods:{

            /************************** FETCH DATA FOR CHARTS ***************************/

            fetchReferrers(){

                axios.get('/api/analytics/referrers').then(response => {




                  var dd = [
                        ["url","pageViews"]
                  ]

                    for(let i =0 ; i < response.data.length ; i++){


                      dd.push([response.data[i]["url"],response.data[i]["pageViews"]])
                    }

                    this.referrers.chartData = dd;



                })
            },

            fetchBrowsers(){

                axios.get('/api/analytics/browsers').then(response => {




                    var data = [
                        ["Browser","Sessions"]
                    ]

                    for(let i =0 ; i < response.data.length ; i++){


                        data.push([response.data[i]["browser"],response.data[i]["sessions"]])
                    }

                    this.browsers.chartData = data;



                })
            },
            fetchUserTypes(){

                axios.get('/api/analytics/userTypes').then(response => {


                    var data = [
                        ["Type","Sessions"]
                    ]

                    for(let i =0 ; i < response.data.length ; i++){


                        data.push([response.data[i]["type"],response.data[i]["sessions"]])
                    }

                    this.userTypes.chartData = data;







                })
            },


            /************************** END FETCH DATA FOR CHARTS **************************/

        }


    }






</script>