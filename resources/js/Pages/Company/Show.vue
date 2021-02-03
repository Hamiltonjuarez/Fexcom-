<template>
   <app-layout>
     <!--   <div class="fixed z-10 inset-0 overflow-y-auto" v-show="modal">
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
                            <div class="col-span-3">
                                <select
                                @change="changeType"
                                v-model="account_type" class="form-select w-full">                                
                                    <option :selected="prevType === type.id"  v-for="type in types" :key="type.position" :value="type">{{type.position+"-"+type.name}} </option>
                                </select>  
                            </div>   
                             <div class="col-span-3">
                                dksldskdskdlsk    
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
            </div> -->
        <template #header-title>
            Ver Empresa  
        </template>
        <div class="flex mb-5 mt-1 justify-between">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                    <div>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                       
                        <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span class="sr-only">Inicio</span>
                        </a>
                    </div>
                    </li>
                    <li>
                    <div class="flex items-center">
                       
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a :href="route('companies.index')" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Empresas</a>
                    </div>
                    </li>
                    <li>
                    <div class="flex items-center">
                        
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{company.Name}}</a>
                    </div>
                    </li>                    
                </ol>
            </nav>
            <!--  <div class="mr-1">               
                <a @click="modal = !modal"
                class="cursor-pointer text-white inline-flex items-center px-4 py-2 border border-transparent 
                text-sm font-bold rounded-md shadow-sm  bg-cyan-700 hover:bg-cyan-800 focus:outline-none focus:ring-2 
                focus:ring-offset-2 focus:ring-indigo-500">
                    Agregar Operador
                </a>
            </div> --> 
            <div class="flex" v-if="company.status == 'operational' || $page.user.role.name == 'admon'">                 
                <div>
                    <jet-dropdown>
                        <template #trigger>                           
                           <jet-button>                                
                                <span><!--  <icon name='down' ></icon> --> OPCIONES</span>                           
                           </jet-button>                           
                        </template>
                        <template #content>
                            <jet-dropdown-link v-if="$page.user.role.name == 'admon'" :href="route('companies.edit',company.id)">
                                EDITAR EMPRESA
                            </jet-dropdown-link>
                            <jet-dropdown-link :href="route('companies.showcatalogue',company.id)" v-if="company.status == 'operational'">
                                VER CATALOGO
                            </jet-dropdown-link>
                            <jet-dropdown-link :href="route('company.suppliers',company.id)">
                                VER PROVEEDORES
                            </jet-dropdown-link>
                             <jet-dropdown-link v-if="$page.user.role.name =='admon'" :href="route('companies.operators',company.id)">
                               VER OPERADORES
                            </jet-dropdown-link>
                        </template>
                    </jet-dropdown>
                </div>   
            </div>         
        </div> 
        <div class="flex ">
            <div class="ml-10 mt-10 w-1/3 h-90 mr-20">
                <div class="shadow-lg p-2 h-full">                   
                    <img class="object-fill h-full w-full " src="/svgs/logoTest.svg">
                </div>
            </div>
             <div v-show="company.status != 'operational' && $page.user.role.name != 'admon'" class="w-2/3 mt-10 flex p-5 shadow-md border-b border-l border-gray-200">             
               <div class="flex w-1/2 flex-col">
                    <span class="text-lg mb-5">Configuracion Requerida</span>
                    <span class="text-sm ml-3 text-left">Se requiere de una configuracion inicial
                        para poder utilizar la empresa           

                    </span>
               </div>
               <div class="flex flex-col ">
                    <img class="object-fill h-48 w-full" src="/svgs/no-products.svg">
                    <jet-button class="mt-5 w-1/2 mx-auto" v-show="company.status == 'incomplete'" type="button" @click.native="setCompany">
                        <span class="mx-auto">CONFIGURAR EMPRESA</span>
                    </jet-button>                    
                     <!-- <a v-if="company.status != 'incomplete'  && company.status != 'addacounts'" type="button" :href="route('companies.create')"
                         class=" text-white inline-flex items-center
                        mx-auto mt-10 text-center
                        px-4 py-2 font-bold rounded-md shadow-sm                      
                        cursor-pointer text-white font-bold bg-gray-600 rounded border-b-2  hover:bg-cyan-700
                        text-xs hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                        <span class="mx-auto"> Configurar Empresa</span>
                    </a> -->
                    <jet-nav-link class="mt-5 w-1/2 mx-auto" v-show="company.status == 'addacounts'" :href="route('companies.catalogue',company.id)" >
                        <span class="mx-auto">Agregar Cuentas</span>
                    </jet-nav-link>
               </div>
            </div>
            <div class="flex flex-col mt-10" v-if="company.status == 'operational' || $page.user.role.name == 'admon'">
                <span class="text-2xl mb-5">{{company.Name}}</span>
                <span class="text-gray-600 mb-3">NIT : <span class="text-black">{{company.nit}}</span></span>
                <span class="text-gray-600 mb-3">NCR : <span class="text-black">{{company.ncr}}</span></span>
                <span class="text-gray-600 mb-3">Nombre Comercial : <span class="text-black">{{company.business_name}}</span></span>
                <span class="text-gray-600 mb-3">Telefono : <span class="text-black">{{company.phone}}</span></span>
                <span class="text-gray-600 mb-3">Direccion : <span class="text-black">{{company.address}}</span></span>
                <span class="text-gray-600 mb-3" v-if="legalRep != null">Representante Legal : <span class="text-black">{{legalRep.name}}</span></span>
                <span class="text-gray-600 mb-3">DUI : <span class="text-black">{{legalRep.dui}}</span></span>               
            </div>
        </div>
   </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import JetNavLink from '@/Jetstream/NavLink' 
import JetButton from '@/Jetstream/Button'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import Icon from '@/Shared/Icon'
export default {
    props:['company','legalRep'],
    data(){
        return{          
            modal : false,          
        }
    },
    components:{
        AppLayout,
        JetNavLink,
        JetButton,
        JetDropdown,
        JetDropdownLink,
        Icon
    },
    methods:{       
        setCompany(){
            this.$inertia.visit(route('companies.addsettings',this.company.id))
        }
    }
}
</script>