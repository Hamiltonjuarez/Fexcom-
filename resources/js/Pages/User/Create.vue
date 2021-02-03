<template>
  <app-layout>
    <template #header-title>
            Crear Usuario  
        </template>
    <div class="flex mb-5 mt-1 justify-between">
          <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
              <li>
              <div>
                  <a href="#" class="text-gray-400 hover:text-gray-500">
                  <!-- Heroicon name: home -->
                  <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                  </svg>
                  <span class="sr-only">Inicio</span>
                  </a>
              </div>
              </li>
              <li>
              <div class="flex items-center">
                  <!-- Heroicon name: chevron-right -->
                  <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                  </svg>
                  <a :href="route('users.index')" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Usuarios</a>
              </div>
              </li>
               <li>
              <div class="flex items-center">
                  <!-- Heroicon name: chevron-right -->
                  <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                  </svg>
                  <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Nuevo Usuario</a>
              </div>
              </li>
              
          </ol>
          </nav>          
      </div>
    <div class="mt-10 sm:mt-10">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Nuevo Usuario </h3>
          <p class="mt-1 text-sm text-gray-600">
           Crea un nuevo usuario y asignale el rol general del mismo. 
          </p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="#" method="POST">
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-5">
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" class="form-input w-full" v-model="request.name">
                  </div>
                  <div class="col-span-6 sm:col-span-5">
                    <label for="email_address" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input type="text" v-model="request.address" autocomplete="email" class="form-input w-full">
                  </div>
                  <div class="col-span-6 sm:col-span-5">
                    <label for="email_address" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" v-model="request.password"  class="form-input w-full">
                  </div>

                  <div class="col-span-6 sm:col-span-4">
                    <label for="country" class="block text-sm font-medium text-gray-700">Rol de Usuario</label>
                    <select id="country" name="country" v-model="request.rolId"  autocomplete="country" class="form-select w-full">                    
                      <option  v-for="rol in roles" :key="rol.id" :value="rol.id">{{rol.name}} </option>
                    </select>
                  </div>               
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <jet-button @click.native="Enviar" type="button">
                crear
              </jet-button>            
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import JetButton from '@/Jetstream/Button'
export default {
  data () {
        return {        
          request:{
            name:  null,
            address: null,         
            rolId: null,
            password: null,   
          }       
        }
    },
    props:['roles'],
    components:{
      
        AppLayout,
        JetButton
        
        
    },
    methods:{
      Enviar(){
        this.$inertia.post(route('users.store'),this.request)
      }
    }
}
</script>