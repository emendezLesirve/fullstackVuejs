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

                <form @submit.prevent="saveArticle" novalidate>
                    <fieldset>
                       
                         <div class="form-group"  >
                            <label class="form-label mt-4">Category</label>
                            <select name="" id="" v-model="newArticle.idcategoria" >
                                <option class="form-control" v-for="category in categorys " v-bind:key="category.id" v-bind:task="category">
                                       {{category.idcategoria}}
                                </option>
                            </select>
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
    name:'Add',
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
         this.getContacts();
       },
    methods:{
       async saveArticle(){
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
             let url ='http://127.0.0.1:8000/api/articles';
             await axios.post(url, formData).then((response)=>{
                console.log(response);
                if(response.status==200){
                    //alert(response.data.message);
                    this.newArticle.idcategoria='',
                    this.newArticle.categoria='',
                    this.newArticle.nombre='';
                    this.newArticle.precio='',
                    this.newArticle.descripcion='',
                    this.newArticle.imagen='';
                   // alert(response.data.messages);

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
         async getContacts(){
                  let url='http://127.0.0.1:8000/api/categorias'
                  await axios.get(url).then(response=>{
                      this.categorys =response.data;
                      console.log(this.articles);
                  }).catch(error=>{
                      console.log(error);
                  });
            },
    }
}
</script>