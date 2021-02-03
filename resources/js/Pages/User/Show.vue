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
                        <div class="grid grid-cols-6 gap-6 ">  
                            <div class="col-span-6 mt-3 mb-7">
                                Seleccione Empresa y Rol 
                            </div>
                            <div class="col-span-3 ">
                                <select                                
                                v-model="company" class="form-select w-full">                                
                                    <option  v-for="item in companies" :key="item.id" :value="item.id">{{item.Name}} </option>
                                </select>           
                                
                            </div>   
                             <div class="col-span-3">
                                <select                                
                                v-model="rol" class="form-select w-full">                                
                                    <option  v-for="item in roles" :key="item.id" :value="item.id">{{item.name}} </option>
                                </select>     
                            </div>                                             
                            <div class="col-span-6 sm:col-span-6  mt-5" >
                                <div class="grid grid-cols-6 gap-6">                                       
                                    <div class="col-span-6 sm:col-span-3 flex  sm:col-start-4 mt-10">
                                        <jet-secondary-button class="mr-2 " @click.native="modal = !modal">
                                            <span class="mr-2">Cancelar</span>                                                               
                                        </jet-secondary-button>       
                                        <jet-button type="button" @click.native="addCompany" >
                                            <span class="mr-2">agregar</span>                                                               
                                        </jet-button>                                                                                                
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
            Ver Empleado
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
                        <a :href="route('companies.index')" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Empleados</a>
                    </div>
                    </li>
                    <li>
                    <div class="flex items-center">
                        
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{usuario.name}}</a>
                    </div>
                    </li>                    
                </ol>
            </nav>
             <div class="flex">
                 <div class="mr-1">               
                    <jet-button @click.native="modal = !modal" 
                   >
                        AGREGAR EMPRESA
                    </jet-button>
                </div>  
                <div class="mr-1">               
                    <jet-nav-link :href="route('users.edit',usuario.id)"
                    >
                        EDITAR USUARIO
                    </jet-nav-link>
                </div>   
            </div>     
        </div> 
        <div class="flex ">
            <div class="ml-10 mt-10 w-1/3 h-90 mr-20">
                <div class="shadow-lg p-2 h-full">                   
                    <img class="object-fill h-full w-full " src="/svgs/logoTest.svg">
                </div>
            </div>            
            <div class="flex flex-col mt-20" >               
                <span class="text-gray-600 mb-3">NOMBRE : <span class="text-black">{{usuario.name}}</span></span>
                <span class="text-gray-600 mb-3">E-MAIL : <span class="text-black">{{usuario.email}}</span></span>
                                          
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import Multiselect from 'vue-multiselect'
import JetButton from '@/Jetstream/Button'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetNavLink from '@/Jetstream/NavLink'
export default {
    props:['usuario','companies','userCompanies','roles'],
    data(){
        return{
            dialog: false,
            modal: false,
            rol : null,
            company : null, 

            request:{
                newCompany: null,
                rol: null,
            }
        }
    },
    components:{
        AppLayout,
        Multiselect,
        JetButton,
        JetSecondaryButton,
        JetNavLink
    },
    methods:{
            addCompany(account_id){           
            this.modal = false
            this.request.newCompany = this.company
            this.request.rol = this.rol
            this.$inertia.post(route('users.addaccount',this.usuario.id),this.request)
        }
    }
}
</script>