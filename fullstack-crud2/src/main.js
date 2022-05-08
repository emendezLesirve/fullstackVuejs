import { createApp } from 'vue'
import  {createRouter,createWebHashHistory} from 'vue-router'

import App from './App.vue';

//import User from './components/User.vue';
//import UserApi from './components/UserApi.vue';
import "sweetalert2/dist/sweetalert2.min.css";

import ContactList from './components/ContactList.vue';
import AddContact from './components/AddContact.vue';
import EditContact from './components/EditContact.vue';

//definir objeto rutas

const routes=[
 /*   {
      path:'/user',
      component: User
    },
    {
        path:'/userapi',
        component:UserApi
    },*/
    {
        name: 'ContactList',
        path:'/',
        component:ContactList
    },
    {
        name: 'AddContact',
        path:'/add',
        component:AddContact
    },
    {
        name: 'EditContact',
        path:'/contact/edit/:idarticulo?',
        component:EditContact
    }

]

//crear objeto de vue router  --objeto de VR
const router=createRouter({
    history:createWebHashHistory(),
    routes
})


//instancia de vue

const app=createApp(App)
app.use(router)

.mount('#app')


