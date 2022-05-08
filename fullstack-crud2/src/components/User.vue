<template>
<div>

      <div class="users">
     <h1>
         COMPONENTE USER CICLO FOR PARA LISTAR LOS DATOS Y UN 
         FORMULARIO PARA CREAR UN USUARIO NUEVO 
     </h1>
     
      <ul>
           <li v-for="user in users " v-bind:key="user.id" v-bind:task="user">
                 {{user.name}} - {{user.email}}
           </li>  
      </ul>
      
      <form v-on:submit.prevent="addUser">
            <input type="text" v-model="newUser.name" placeholder="Name">
            <input type="email" v-model="newUser.email" placeholder="Email">
            <button type="submit">
                  Add
            </button>
      </form>

      
     </div>
     <hr>
     <div class="users">

     
     <h1>
         LISTA DE DATOS PERO CON UN BOTON DE ELIMINAR
     </h1>
     
      <ul>
           <li v-for="user in users " v-bind:key="user.id" v-bind:task="user">
                 {{user.name}} - {{user.email}} 
                 <button v-on:click="deleteUser(user)">X</button>
           </li>  
      </ul>
      
     </div>


</div>
 
   
 
</template>

<script>
export default {
      data(){
            return{
                  users:[
                        {
                         name:'Edwin',
                         email:'edmendez@gmail.com',
                         contacted:false
                        },
                         {
                         name:'Lina',
                         email:'lina12@gmail.com',
                         contacted:true
                        },
                         {
                         name:'Mary',
                         email:'mary24@gmail.com',
                         contacted:false
                        }   
                  ],
                  newUser:{}
            }
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
                  alert('Eliminando');
            }
      }
    
}
</script>

<style lang="css">

    .users{
          background: #333;
          color:#fff;
          padding:20px;
    }

</style>