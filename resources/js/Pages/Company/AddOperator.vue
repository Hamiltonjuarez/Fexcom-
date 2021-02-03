<template>
    <app-layout>
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
                        <a :href="route('companies.operators',company.id)" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Operadores</a>
                    </div>
                    </li>  
                     <li>
                        <div class="flex items-center">                        
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Agregar Operador</a>
                        </div>
                    </li>                    
                </ol>
            </nav>              
        </div>
        <div class="flex mt-10">
            <div class="w-1/3 flex flex-col">
                    <span class="text-lg text-gray-700">
                       Agregar Operadores a la empresa
                    </span>
                    <span class="text-md text-gray-600 ml-3 mt-3 w-4/5">
                        Seleccione operadores del listado en el sistema 
                        y agregue a la empresa seleccionada con el rol escogido. 
                    </span>
            </div>
            <div class="grid grid-cols-6 gap-6 w-2/3 shadow-md bg-white p-5">
                <div class="col-span-6 sm:col-span-6">
                   Agregar Operadores                       
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-3 sm:col-span-3 mt-5" >
                                <label class="block text-sm font-medium text-gray-700">Usuario </label>
                                <select class="form-select w-full" v-model="accountant">                                
                                    <option  v-for="item in operators" :key="item.id" :value="item">{{item.name}} </option>
                                </select>
                            </div>
                                <div class="col-span-3 sm:col-span-3 mt-5" >
                                <label class="block text-sm font-medium text-gray-700">Rol en la Empresa </label>
                                <select class="form-select w-full" v-model="rol">                                
                                    <option  v-for="item in roles" :key="item.id" :value="item">{{item.name}} </option>
                                </select>
                            </div>
                                <div class="col-span-3 sm:col-span-3 sm:col-end-6 sm:col-start-6 mt-5 " >
                                <jet-button type="button" @click.native="addOperator">
                                    AGREGAR
                                </jet-button>
                            </div>
                            <div class="col-span-6 sm:col-span-6 border border-gray-200 rounded-md p-5">
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <div v-for="item in companyOperators"
                                    :key="item.index"
                                        class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                        </div>                                                    
                                        <div class="flex-1 min-w-0">
                                        <a href="#" class="focus:outline-none">
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            <p class="text-sm font-medium text-gray-900">
                                        {{item.accountant}}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate">
                                            {{item.rol}}
                                            </p>
                                        </a>
                                        </div>
                                            <button class="z-20" type="button" @click="removeAcountant(item.accountantId)"> <icon name="delete" /></button>
                                    </div>
                                </div>                                                                                                               
                            </div>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-3 sm:col-start-5 text-right mt-10">                                                                          
                    <jet-button type="button" v-show="companyOperators.length > 0" @click.native="saveOperators">
                        <span class="mr-2" >Agregar operadores</span>                                          
                    </jet-button>                                      
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import JetButton from '@/Jetstream/Button'
import { mapState, mapActions, mapGetters } from "vuex";
import Icon from '@/Shared/Icon'
export default {
    data(){
        return {
            accountant: null,
            rol: null,
        }
    },
    computed: {
        ...mapState({            
            companyOperators : state => state.Company.companyAccountants,           
        })
    },
    props: ['operators','company','roles'],
    components:{
        AppLayout,
        JetButton,
        Icon
    },
    methods:{
       addOperator(){
            if(this.accountant != null && this.rol != null){
                let operator = {
                'accountant' : this.accountant.name,
                'rol'  : this.rol.name,
                'rolId' : this.rol.id,
                'accountantId' : this.accountant.id
                }
                this.$store.commit("Company/addOperator",operator)
            }
        },
         removeAcountant(accountantId){
            this.$store.commit("Company/removeAccountant",accountantId)
        },
        saveOperators(){
            this.$inertia.post(route('companies.saveoperators',this.company.id),{
                operators : this.companyOperators
            })
            this.$store.commit("Company/clearOperators");
        }
    }
}
</script> 