<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">

             <div class="alert alert-danger mt-4" v-if="errors.length">
                    <ul class="mb-0">
                           <li v-for="(error, index) in errors" :key="index">
                                   {{ error }}  
                           </li>
                    </ul>
             </div>

                <form @submit.prevent="updateArticle" novalidate>
                    <fieldset>
                       
                          <div class="form-group">
                            <label class="form-label mt-4">Category</label>
                            <input type="text" class="form-control"  v-model="newArticle.idcategoria"
                            placeholder="Enter Article Name">
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Article</label>
                            <input type="text" class="form-control"  v-model="newArticle.nombre"
                            placeholder="Enter Article Name">
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Price</label>
                            <input type="text" class="form-control" v-model="newArticle.precio"
                            placeholder="Enter Price">
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Description</label>
                            <input type="text" class="form-control" v-model="newArticle.descripcion"
                            placeholder="Enter Description">
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-4">Imagen</label>
                            <input type="text" class="form-control" v-model="newArticle.imagen"
                            placeholder="Enter Imagen">
                        </div>

                        <button class="btn btn-primary mt-4">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name:'editContact',
    data(){

        return{
             categorys:Array,
             newArticle:{},
             idcategoria:'',
             nombre:'',
             precio:'',
             descripcion:'',
             imagen:'',
             errors:[]
        }
          
    },
       created(){
         this.getContactById();
       },
    methods:{
          
          async getContactById(){
               let url=`http://127.0.0.1:8000/api/articles/${this.
               $route.params.idarticulo}`;
               await axios.get(url).then(response=>{
                   console.log(response);
                   this.newArticle=response.data;
               });
          },

         async updateArticle(){
            this.errors=[];
              if(!this.newArticle.idcategoria){
                this.errors.push('Category is required')
            }
            if(!this.newArticle.nombre){
                this.errors.push('Name is required')
            }
             if(!this.newArticle.precio){
                this.errors.push('Price is required')
            }
             if(!this.newArticle.descripcion){
                this.errors.push('Description is required')
            }
            if (!this.errors.length) {
                let formData = new FormData();
                formData.append('idcategoria',this.newArticle.idcategoria);
                formData.append('nombre',this.newArticle.nombre);
                formData.append('precio',this.newArticle.precio);
                formData.append('descripcion',this.newArticle.descripcion);
             let url =`http://127.0.0.1:8000/api/updatearticles/${this.
               $route.params.idarticulo}`;
             await axios.post(url, formData).then((response)=>{
                console.log(response);
                if(response.status==200){
                  
    
                   Swal.fire({
                        title: response.data.messages,
                        text: 'Do you want to continue',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })

        
                   }else{
                        console.log('error');
                   }
             }).catch(error=>{
                 this.errors.push(error.response);
             });
            }
          },

    mounted: function(){
        console.log('Edit component form component loaded....');
    }
}
}
</script>