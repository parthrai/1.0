<template>
    <div class="col-md-6">

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
                        <input type="text" class="form-control" id="siteName" required="true" name="emailadress" v-model="data.site">
                    </div>

                    <div class="category form-category">* Required fields</div>
                </div>
                <div class="card-footer ml-auto mr-auto">
                    <button  class="btn btn-rose" @click="addSites()">Add</button>
                </div>
            </div>



            <input type="file" @change="fileSelected">

            <input type="button" @click="uploadFile">


    </div>

</template>

<script>

    export default{

        data(){
            return{
                data:{
                    site:'',

                    files:null,

                }
            }
        },

        methods:{

            addSites(){

                console.log(this.data.site);

                axios.post('/sites/add', this.data)
                    .then(response => {
                        console.log(response);
                    });

            },

            fileSelected(event){
                this.files = event.target.files[0]

            },

            uploadFile(){

                const fd = new FormData();
                fd.append('excel',this.files,this.files.name)
                axios.post('../sites/import',fd)
                    .then(res=>{
                        console.log(res)
                    })
                }


        }
    }

</script>