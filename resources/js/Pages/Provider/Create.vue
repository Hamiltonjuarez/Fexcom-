<template>
  <app-layout>
      <template #header-title>
            Crear Proveedor 
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
                  <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Nuevo Proveedor</a>
              </div>
              </li>
              
          </ol>
          </nav>          
      </div>
    <div class="mt-10 sm:mt-10">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Nuevo Proveedor </h3>
          <p class="mt-1 text-sm text-gray-600">
           Crea un nuevo Proveedor con todos sus datos
          </p>
        </div>
      </div>      
      <div class="mt-5 md:mt-0 md:col-span-2 ">
         <form action="#" method="POST">
            <div class="shadow-lg sm:min-h-full overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-6 gap-6">                           
                      <div class="col-span-6 sm:col-span-3">
                            Informacion General del Proveedor
                      </div>               
                      <div class="col-span-3 sm:col-span-3 ">
                          <div class="mt-0">
                            <label class="inline-flex items-center">
                              <input type="radio" @click="contributing" checked class="border-solid form-radio" name="accountType" value="personal">
                              <span class="ml-2">Contribullente</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                              <input type="radio" @click="noContributor" class="border-solid form-radio" name="accountType" value="busines">
                              <span class="ml-2">No Contribullente</span>
                            </label>
                          </div>  
                      </div>    
                      <div class="col-span-3 sm:col-span-1 ">
                          <label for="email_address" class="block text-sm font-medium text-gray-700">Codigo</label>
                          <input type="text"   autocomplete="email" class="form-input w-full" v-model="request.code">
                      </div>    
                      <div class="col-span-2 sm:col-span-3">
                          <label for="email_address" class="block text-sm font-medium text-gray-700">NIT</label>
                          <input type="text"   autocomplete="email" class="form-input w-full" v-model="request.nit">
                      </div>
                      <div v-if="request.contributor" class="col-span-1 sm:col-span-2 ">
                          <label for="email_address" class="block text-sm font-medium text-gray-700">NCR</label>
                          <input type="text"  autocomplete="email" v-model="request.ncr" class="form-input w-full">
                      </div>
                      <div class="col-span-1 sm:col-span-6 ">
                          <label for="email_address" class="block text-sm font-medium text-gray-700">Nombre</label>
                          <input type="text"   autocomplete="email" v-model="request.name" class="form-input w-full">
                      </div>
                      <div class="col-span-1 sm:col-span-3">
                            <label class="block text-sm font-medium text-gray-700">Pais </label>
                            <select class="form-select w-full" v-model="request.country_id">                                
                                <option  v-for="item in countries" :key="item.id" :value="item.id">{{item.name}} </option>
                            </select>
                            paises                           
                            
                      </div>
                      <div class="col-span-1 sm:col-span-3">
                          <label for="email_address" class="block text-sm font-medium text-gray-700">Telefono</label>
                          <input type="text"  autocomplete="email" v-model="request.phone" class="form-input w-full">
                      </div>
                      <div class="col-span-1 sm:col-span-3">
                          <label for="email_address" class="block text-sm font-medium text-gray-700">Tipo de Proveedor</label>
                          <select class="form-select w-full" v-model="request.type">                                
                                <option value="small">Pequeño </option>
                                <option value="medium">Mediano </option>
                                <option value="big">Grande </option>
                            </select>
                      </div>
                      <div v-if="request.contributor" class="col-span-1 sm:col-span-3">
                          <label for="email_address" class="block text-sm font-medium text-gray-700">Serie aprovada por Hacienda</label>
                          <input type="text"  autocomplete="email" v-model="request.foil" class="form-input w-full">
                      </div> 
                      <div class="col-span-1 sm:col-span-3">
                          <label for="email_address" class="block text-sm font-medium text-gray-700">Giro comercial</label>
                          <input type="text"  autocomplete="email" v-model="request.business_activitie" class="form-input w-full">
                      </div>
                      <div class="col-span-1 sm:col-span-6">
                          <label for="email_address" class="block text-sm font-medium text-gray-700">Direccion</label>
                          <input type="text"   autocomplete="email" v-model="request.email" class="form-input w-full">
                      </div>                                  
                </div>
            </div>

              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <jet-button @click.native="Enviar" type="button" class="mb-3">
                <span class="mr-2">GUARDAR PROVEEDOR</span>
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
            code: null,
            nit:  null,
            ncr: null,         
            name: null,
            email: null,  
            phone: null, 
            business_activitie: null,             
            country_id : null,
            foil       : null, 
            type       : null,
            contributor : true,
          }       
        }
    },
    props:['countries'],
    components:{
        AppLayout,
        JetButton,
    },
    methods:{
      Enviar(){
        if(!this.request.contributor ){
          this.request.ncr = 'no disponible';
        }
        this.$inertia.post(route('providers.store'),this.request)
      },
      contributing(){
        this.request.contributor = true;
      },
      noContributor(){
         this.request.contributor = false;
      }
    }
}
</script>