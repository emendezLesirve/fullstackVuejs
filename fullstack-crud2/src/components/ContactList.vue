<template>
    <div class="container">
        <table class="table table-hover">
           <thead>
               <tr>
                   <th scope="col">IdArticulo</th>
                   <th scope="col">Categoria</th>
                   <th scope="col">Articulo</th>
                   <th scope="col">Precio</th>
                   <th scope="col">Descripcion</th>
                   <th scope="col">Action</th>
               </tr>
           </thead>
           <tbody v-for="article in articles" :key="article.idarticulo">
                        <tr class="table-secondary">
                             <th scope="row">{{article.idarticulo}}</th>
                             <th scope="row">{{article.categoria}}</th>
                             <th scope="row">{{article.nombre}}</th>
                             <th scope="row">{{article.precio}}</th>
                             <th scope="row">{{article.descripcion}}</th>
                             <th scope="row"><router-link :to="{ name:'EditContact', params:{ idarticulo: article.idarticulo }}" class="btn btn-primary btn-sm" >Edit</router-link></th>
                             <th scope="row"><button class="btn btn-danger btn-sm" @click.prevent="deleteArticle(article.idarticulo)">X</button></th>
                             <!--th scope="row"><button class="btn btn-danger btn-sm" v-on:click="deleteUser(article.idarticulo)">X</button></th-->
                        </tr>
           </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default{
   name:'ContactList',

    data(){
            return{
                  articles:Array    
            }
      },
      created(){
         this.getContacts();
      },

      methods:{   
          
          async getContacts(){
                  let url='http://127.0.0.1:8000/api/articles'
                  await axios.get(url).then(response=>{
                      this.articles =response.data;
                      console.log(this.articles);
                  }).catch(error=>{
                      console.log(error);
                  });
            },
               async deleteArticle(idarticulo){
                //  this.articles.splice(this.articles.indexOf(idarticulo),1);
                  let url=`http://127.0.0.1:8000/api/articles/${idarticulo}`;
                  await axios.delete(url).then(response=>{
                      if (response.data.code==200) {
                     //     alert(response.data.messages);
                     Swal.fire({
                        title: response.data.messages,
                        text: 'Do you want to continue',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })
                          this.getContacts();
                      }
                  }).catch(error=>{
                      console.log(error);
                  })
           
            }
      }
}
      

</script>