<template>
  <app-layout>
      <template #header-title>
            Editar Proveedor 
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
                  <a :href="route('providers.index')" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Proveedor</a>
              </div>
              </li>
               <li>
              <div class="flex items-center">
                  <!-- Heroicon name: chevron-right -->
                  <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                  </svg>
                  <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Editar Proveedor</a>
              </div>
              </li>
              
          </ol>
          </nav>          
      </div>
    <div class="mt-10 sm:mt-10">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Editar Proveedor </h3>
          <p class="mt-1 text-sm text-gray-600">
           Editar la informacion del proveedor seleccionado. 
          </p>
        </div>
      </div>
      
      <div class="mt-5 md:mt-0 md:col-span-2 ">
                    <form action="#" method="POST">
                    <div class="shadow-lg sm:min-h-full overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6"> 
                          
               <div class="col-span-6 sm:col-span-6">
                 Informacion General del Proveedor
               </div>
               <div class="col-span-3 sm:col-span-1 ">
                        <label for="email_address" class="block text-sm font-medium text-gray-700">CODIGO</label>
                        <input type="text"  v-model="form.code" autocomplete="email" class="form-input w-full" >
                    </div>    
                     <div class="col-span-2 sm:col-span-3 ">
                        <label for="email_address" class="block text-sm font-medium text-gray-700">NIT</label>
                        <input type="text"  v-model="form.nit" autocomplete="email" class="form-input w-full" >
                    </div>
                     <div class="col-span-1 sm:col-span-2 ">
                        <label for="email_address" class="block text-sm font-medium text-gray-700">NCR</label>
                        <input type="text"  v-model="form.ncr" autocomplete="email"  class="form-input w-full">
                     </div>
                    <div class="col-span-1 sm:col-span-6 ">
                        <label for="email_address" class="block text-sm font-medium text-gray-700">NOMBRE</label>
                        <input type="text" v-model="form.name"  autocomplete="email"  class="form-input w-full">
                    </div>
                    <div class="col-span-1 sm:col-span-6">
                         <label for="email_address" class="block text-sm font-medium text-gray-700">CORREO ELECTRONICO</label>
                        <input type="text" v-model="form.email"  autocomplete="email"  class="form-input w-full">
                     </div>
                    <div class="col-span-1 sm:col-span-3">
                        <label for="email_address" class="block text-sm font-medium text-gray-700">TELEFONO</label>
                        <input type="text" v-model="form.phone"  autocomplete="email" class="form-input w-full">
                    </div>
                    <div class="col-span-1 sm:col-span-3">
                        <label for="email_address" class="block text-sm font-medium text-gray-700">GIRO COMERCIAL</label>
                        <input type="text"  v-model="form.business_activitie" autocomplete="email" class="form-input w-full">
                    </div>
                    <div class="col-span-1 sm:col-span-6">
                        <label for="email_address" class="block text-sm font-medium text-gray-700">CONTACTO </label>
                        <input type="text"  v-model="form.contact" autocomplete="email"  class="form-input w-full">
                    </div>   
              </div>
            </div>

            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <jet-button @click="Enviar" type="button">
               <span class="mr-2">EDITAR PROVEEDOR</span>
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
          form:{
                code: this.provider.code,
                nit:  this.provider.nit,
                ncr: this.provider.ncr,         
                name: this.provider.name,
                email: this.provider.address,  
                phone: this.provider.phone, 
                business_activitie: this.provider.business_activitie,  
                contact: this.provider.contact,  
          }
        }
    },
    props:['roles',
           'provider'
    ],
    components:{
        AppLayout,
        JetButton
    },
    methods:{
      Enviar(){
        this.$inertia.put(route('providers.update',this.provider.id),this.form)
      }
    }
}
</script>