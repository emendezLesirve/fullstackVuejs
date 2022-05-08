<template>
    <div>

     <div class="users">
   <hr>
     <h1>
         LISTA DE DATOS APIREST
     </h1>
     
      <ul>
           <li v-for="user in users " v-bind:key="user.id" v-bind:task="user">
                 {{user.nombre}} - {{user.precio}} 
                 <button v-on:click="deleteUser(user)">X</button>
           </li>  
      </ul>
      <hr>
      <h1>AGREGAR A LA API</h1>
         <form v-on:submit.prevent="addUser">
            <input type="text" v-model="newUser.nombre" placeholder="Name">
            <input type="text" v-model="newUser.precio" placeholder="Email">
            <button type="submit">
                  Add
            </button>
      </form>
      
     </div>
</div>
</template>

<script>


import axios from 'axios';
import Swal from 'sweetalert2';

export default {
      data(){
            return{
                  users:Array,
                  newUser:{}
            }
      },
      created(){
         this.getContacts();
      },

      methods:{
            addUser(e){
                  //e.preventDefault();
                  this.users.push(this.newUser);
                  this.newUser={}
                  console.log(this.users);
            },
            
            deleteUser(user){
                  this.users.splice(this.users.indexOf(user),1);
                //  alert('Eliminando');

                   Swal.fire({
                    title: 'Muy Bien!',
                    text: 'User Eliminado',
                    icon: 'success',
                    confirmButtonText: 'Confirmar'
    });
                  
            },

            async getContacts(){
                  let url='https://unico.jacs3dpruebas.shop/api/articulos'
                  await axios.get(url).then(response=>{
                      this.users =response.data;
                      console.log(this.users);
                  }).catch(error=>{
                      console.log(error);
                  });
            }
      }
}
</script>