<template>
     <app-layout>
       <div class="fixed z-10 inset-0 overflow-y-auto" v-show="modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">          

                <transition
                     enter-active-class="ease-out duration-300"
                    enter-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-class="opacity-100 scale-100"
                    leave-to-class="opacity-0"
                >
                   <div>
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>
                           
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>                                 
                <transition
                     enter-active-class="ease-out duration-300"
                    enter-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-class="opacity-100 scale-100"
                    leave-to-class="opacity-0"
                >
                    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <div class="grid grid-cols-6 gap-6">  
                            <div class="col-span-6">
                                <vue-monthly-picker :monthLabels="months" v-model="selectedMonth">                                                
                                </vue-monthly-picker> 
                            </div>                                                         
                            <div class="col-span-6 sm:col-span-6  mt-5" >
                                <div class="grid grid-cols-6 gap-6">                                       
                                    <div class="col-span-6 sm:col-span-3 sm:col-start-4 mt-10">
                                        <button type="button" @click="modal = !modal" class="text-xs text-white mr-3 font-bold bg-gray-500 rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-gray-600 text-sm hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                            <span class="mr-2">Cancelar</span>                                                               
                                        </button>                                                                                                
                                    </div>
                                </div>
                            </div>
                         </div>                        
                      </div>
                    </transition>                            
                   </div>
                </transition>
             </div>
            </div>
     <template #header-title>
            Lista de Compras
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
                    <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Compras</a>
                </div>
                </li>
                
            </ol>
           </nav>
           <!-- <div class="flex mr-1">           
                <jet-button @click.native="modal = !modal" class="mr-1">
                  LIBRO COMPRAS
              </jet-button>
              <jet-dropdown>
                  <template #trigger>                           
                      <jet-button>                                
                          <span> CREAR COMPRA </span>                           
                      </jet-button>                           
                  </template>
                  <template #content>                     
                      <jet-dropdown-link  :href="route('purchases.location','local')">
                           LOCAL
                      </jet-dropdown-link>
                      <jet-dropdown-link  :href="route('purchases.location','importation')">
                          IMPORTACION
                      </jet-dropdown-link>
                  </template>
              </jet-dropdown>      
           </div> -->
       </div>
        <div class="flex flex-col">          
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">          
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"> 
               <div class="flex  w-full bg-white justify-between p-3 mt-1">
                    <div class="w-2/4 mb-3">
                        <label class="block text-sm font-medium text-gray-700">Seleccione Proveedor </label>                  
                        <v-select label="name" :options="providers" @input="searchPurchases" v-model="supplier">
                        </v-select>
                    </div>  
                    <div class="w-1/3 text-right mb-3">                                                       
                        <jet-button @click.native="createPurchase">                                
                            <span><!--  <icon name='down' ></icon> --> CREAR COMPRA </span>                           
                        </jet-button>                                         
                    </div>                    
                </div>             
            <div v-show="purchases.length > 0 " class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">                            
                 <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                           fecha
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          serie
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          Tipo 
                        </th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          No. documento
                        </th>                       
                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                         proveedor
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Comp. Exentas
                        </th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Comp. Gravadas
                        </th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        iva percivido
                        </th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        total 
                        </th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        opciones 
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="bg-white hover:bg-gray-200 cursor-pointer" v-for="item in purchases"
                        :key="item.id">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                          {{item.date}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                           {{item.foil}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                          {{item.type.name}}
                        </td>
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                            {{item.dNumber}}
                        </td>
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                          {{item.supplier.name}}
                        </td>
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                           {{item.exemptP}}
                        </td>  
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                           {{item.taxedP}}
                        </td>  
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                           {{item.iva}}
                        </td>  
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                           {{item.total}}
                        </td>                         
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                          <!-- <jet-dropdown align="right" with="48">
                              <template #trigger>
                                  <button id="project-options-menu-0" aria-haspopup="true" type="button" class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                  <span class="sr-only">Open options</span>                                 
                                  <icon class="w-5 h-5" name="vertical-dots" />
                                  </button>
                              </template>
                              <template #content>
                              </template>
                          </jet-dropdown> -->
                            <div class="flex z-40">
                                  <a :href="route('companies.edit',item.id)" 
                                  class="cursor-pointer mr-3" > <icon class="text-gray-500 hover:text-cyan-700" name='edit'/></a>
                                  <a @click="Destroy(item.id)"
                                  class="cursor-pointer" > <icon class="text-gray-500 hover:text-cyan-700" name='delete-blank'/></a>
                            </div>
                        </td>
                      </tr>
                    </tbody>
                </table>  
                        
            </div>
              <div v-show="purchases.length == 0" class="mt-20">
                  <img
                  src="/svgs/no-products.svg"
                  class="w-1/3 mx-auto h-64"
                  alt=""
                  />
                  <h4 class="text-gray-500 font-semibold text-center">
                     No hay compras registradas. 
                  </h4>
              </div>
            </div>
        </div>
        </div>
   </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import Icon from '@/Shared/Icon'
import JetNavLink from '@/Jetstream/NavLink'
import VueMonthlyPicker from 'vue-monthly-picker'
import JetButton from '@/Jetstream/Button'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import VueSwal from 'vue-swal';
export default {
    data(){
        return{
            modal : false,
            months : ['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT',
                 'NOV','DEC'],
            selectedMonth : null, 
            purchasesDate : null, 
            supplier      : null,
        }
    },
    components:{
        AppLayout,
        Icon,
        JetNavLink,
        VueMonthlyPicker,
        JetButton,     
        JetDropdown,
        JetDropdownLink,
        vSelect,
        VueSwal,

    },
    props:['purchases','providers','countries'],

    methods: {
      searchPurchases(){

            this.$inertia.replace("/purchases", {
                method: "get",
                data: {                   
                    search: this.supplier.id
                }
            });      
      },
      createPurchase(){
        if(this.supplier != null){
          this.countries.forEach(element => {
              if(this.supplier.country_id == element.id){
               
                if(element.name == 'El Salvador'){
                   var location = 'local'                    
                } else{
                  var location = 'foreign'
                }
                this.$inertia.visit(route('purchases.location',{'location' : location, 'supplier_id' : this.supplier.id
                    }))
              }
          });
        }else{               
               swal({
                      title: "Seleccione Proveedor",
                      text: "se requiere un proveedor para ingresar una compra. ",
                      icon: "warning",
                     buttons: {
                        confirm: {
                         text: "OK",
                         value: true,
                         visible: true,
                         className: "bg-gray-600 hover:bg-gray-500 rounded-md",
                         closeModal: true                            
                        }
                      }
               })

              }
      }
    }
}
</script>