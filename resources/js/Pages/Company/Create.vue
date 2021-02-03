<template>
   <app-layout>
       <template #header-title>
            Crear Empresa  
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
                        <a :href="route('companies.index')" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Empresas</a>
                    </div>
                    </li>
                    <li>
                    <div class="flex items-center">
                        <!-- Heroicon name: chevron-right -->
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Nueva Empresa</a>
                    </div>
                    </li>
                    
                </ol>
            </nav>          
        </div>        
        <div class="mt-10 sm:mt-10">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                 <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Crear Empresa</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Agregar nueva empresa y asignarle todos los datos necesarios para el funcionamiento
                            de la misma
                        </p>
                        <div class="mt-10">
                            <nav aria-label="Progress">
                                <ol class="overflow-hidden">
                                    <li class="relative pb-10">
                                    <!-- Complete Step -->
                                    <div class="-ml-px absolute mt-0.5 top-4 left-4 w-0.5 h-full bg-cyan-600" aria-hidden="true"></div>
                                    <a href="#" class="relative flex items-start group">
                                        <span v-if="generalStep == 'complete'" class="h-9 flex items-center">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-cyan-600 rounded-full group-hover:bg-cyan-800">
                                                <!-- Heroicon name: check -->
                                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                 <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </span>
                                         <span  v-if="generalStep == 'processing'" class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-cyan-600 rounded-full">
                                                <span class="h-2.5 w-2.5 bg-cyan-600 rounded-full"></span>
                                            </span>
                                        </span>
                                         <span  v-if="generalStep == 'pending'" class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                                                <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300"></span>
                                            </span>
                                        </span>
                                        <span class="ml-4 min-w-0 flex flex-col">
                                            <span class=" font-semibold uppercase tracking-wide"
                                             :class="generalStep == 'processing' ? 'text-black text-md': 'text-gray-500 text-xs'">Informnacion General</span>
                                            <span class="text-sm text-gray-500"
                                             :class="generalStep == 'processing' ? 'text-black': 'text-gray-500'">Datos generales de la nueva empresa .</span>
                                        </span>
                                    </a>
                                    </li>

                                    <li class="relative pb-10">
                                    <!-- Current Step -->
                                    <div class="-ml-px absolute mt-0.5 top-4 left-4 w-0.5 h-full bg-gray-300" aria-hidden="true"></div>
                                    <a href="#" class="relative flex items-start group" aria-current="step">
                                        <span v-if="modulesStep == 'complete'" class="h-9 flex items-center">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-cyan-600 rounded-full group-hover:bg-cyan-800">
                                                <!-- Heroicon name: check -->
                                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                 <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </span>
                                         <span  v-if="modulesStep == 'processing'" class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-cyan-600 rounded-full">
                                                <span class="h-2.5 w-2.5 bg-cyan-600 rounded-full"></span>
                                            </span>
                                        </span>
                                         <span  v-if="modulesStep == 'pending'" class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                                                <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300"></span>
                                            </span>
                                        </span>
                                        <span class="ml-4 min-w-0 flex flex-col">
                                            <span class="font-semibold uppercase tracking-wide"
                                            :class="modulesStep == 'processing' ? 'text-black text-md': 'text-gray-500 text-xs'">Modulos Habilitados</span>
                                            <span class="text-sm "  :class="modulesStep == 'processing' ? 'text-black': 'text-gray-500'">Seleccione los modulos a los cuales la empresa
                                                tendra acceso.</span>
                                        </span>
                                    </a>
                                    </li>

                                    <li class="relative pb-10">
                                    <a href="#" class="relative flex items-start group">
                                        <span v-if="legalStep == 'complete'" class="h-9 flex items-center">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-cyan-600 rounded-full group-hover:bg-cyan-800">
                                                <!-- Heroicon name: check -->
                                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                 <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </span>
                                         <span  v-if="legalStep == 'processing'" class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-cyan-600 rounded-full">
                                                <span class="h-2.5 w-2.5 bg-cyan-600 rounded-full"></span>
                                            </span>
                                        </span>
                                         <span  v-if="legalStep == 'pending'" class="h-9 flex items-center" aria-hidden="true">
                                            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                                                <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300"></span>
                                            </span>
                                        </span>
                                        <span class="ml-4 min-w-0 flex flex-col">
                                        <span class="font-semibold uppercase tracking-wide"
                                         :class="legalStep == 'processing' ? 'text-black text-md': 'text-gray-500 text-xs'">Representante Legal</span>
                                        <span class="text-sm text-gray-500"
                                         :class="legalStep == 'processing' ? 'text-black': 'text-gray-500'">Cree o seleccione un Representante 
                                         legal para la nueva empresa.</span>
                                        </span>
                                    </a>
                                    </li>
                                                                        
                                </ol>
                                </nav>
                        </div>
                    </div>
                 </div>                 
                  <div class="mt-5 md:mt-0 md:col-span-2 ">
                    <form action="#" method="POST">
                    <div class="shadow-lg sm:min-h-full overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">                
                            <div class="col-span-6" v-if="generalStep == 'processing'">
                               <div class="grid grid-cols-6 gap-6">
                                    
                                    <div class="col-span-6 sm:col-span-6">
                                    Informacion General de la Empresa
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 ">
                                        <label for="email_address" class="block text-sm font-medium text-gray-700">NIT</label>
                                        <input type="text"  @input="updateNit" v-model="form.nit" autocomplete="email" class="form-input w-full">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3 ">
                                        <label for="email_address" class="block text-sm font-medium text-gray-700">NCR</label>
                                        <input type="text" @input="updateNcr" v-model="form.ncr" autocomplete="email" class="form-input w-full">
                                    </div>
                                    <div class="col-span-6 sm:col-span-6 ">
                                        <label for="email_address" class="block text-sm font-medium text-gray-700">Razon Social</label>
                                        <input type="text" @input="updateName" v-model="form.name"  autocomplete="email" class="form-input w-full">
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="email_address" class="block text-sm font-medium text-gray-700">Nombre Comercial</label>
                                        <input type="text" @input="updateCname" v-model="form.comercialName"  autocomplete="email" class="form-input w-full">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email_address" class="block text-sm font-medium text-gray-700">Telefono</label>
                                        <input type="text" @input="updatePhone" v-model="form.phone" autocomplete="email" class="form-input w-full">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email_address" class="block text-sm font-medium text-gray-700">Giro Comercial</label>
                                        <input type="text" @input="updateActivity" v-model="form.comercialActivity" autocomplete="email" class="form-input w-full">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">Pais </label>
                                        <select class="form-select w-full" v-model="form.country_id">                                
                                            <option  v-for="item in countries" :key="item.id" :value="item.id">{{item.name}} </option>
                                        </select>
                                    </div>                                    
                                   <div class="col-span-6 sm:col-span-6">
                                        <label class="block">
                                            <span class="text-gray-700">Direccion</span>
                                            <textarea v-model="form.address" class="form-textarea mt-1 block w-full" rows="3"
                                             placeholder="Direccion fisica adonde se encuentra ubicada la empresa."></textarea>
                                        </label>
                                   </div>
                                    <div class="col-span-6 sm:col-span-3 sm:col-start-6 mt-10">
                                        <jet-button @click.native="generalComplete" type="button" >
                                           siguiente                                
                                        </jet-button>
                                        <!-- <button class="bg-gray-700 text-white font-bold rounded border-b-2 border-green-500 hover:border-gray-600 hover:bg-gray-800 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                            <span class="mr-2">Send</span>
                                           <icon name="destroy"/>
                                        </button> -->
                                    </div>
                               </div>
                            </div>
                            <div class="col-span-6 min-h-screen" v-if="modulesStep == 'processing'">
                               <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-6 mt-5">
                                         Modulos Habilitados Para la Empresa
                                    </div>
                                   <!--  <div class="col-span-6 sm:col-span-6 mt-5">
                                        <div class="flex">
                                            <div class="w-1/3 ml-24 mr-24" v-for="module in modules"
                                                :key="module.id">                                                    
                                                     <label class="inline-flex items-center mt-3">
                                                        <input type="checkbox" @click="addModule(module.id)" :value="module.id"  class="form-checkbox h-5 w-5 text-cyan-700"><span class="ml-2 text-gray-700">{{module.name}}</span>
                                                    </label>                                                  
                                            </div>                                                                                                              
                                        </div>
                                    </div> -->
                                    <div class="col-span-6 mt-5">                                      
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div v-for="module in modules" :key="module.id" class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <div class="flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                </div>                                                    
                                                <div class="flex-1 min-w-0">
                                                    <a href="#" class="focus:outline-none">
                                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                                        <p class="text-sm font-medium text-gray-900">
                                                    {{module.name}}
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate">
                                                        {{module.description}}
                                                        </p>
                                                    </a>
                                                </div>
                                                    <input id="settings-option-0" @click="addModule(module.id)"
                                                    type="checkbox" 
                                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 cursor-pointer z-20 border-gray-300">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-span-6 sm:col-span-3 mt-10 sm:col-start-6">                                  
                                        <jet-button type="button" @click.native="modulesComplete">
                                            <span class="mr-2">SIGUIENTE</span>                                           
                                        </jet-button>
                                    </div>
                                </div>
                             </div>
                              <div class="col-span-6 min-h-screen" v-if="legalStep == 'processing'">
                                <div class="grid grid-cols-6 gap-6">
                                     <div class="col-span-6 sm:col-span-3 mt-5">
                                        Representante Legal de la Empresa
                                        </div>
                                        <div class="col-span-6 sm:col-span-3 mt-5">                              
                                            <div class="mt-0">
                                                <label class="inline-flex items-center">
                                                <input type="radio" @click="newRepres" class="border-solid form-radio" name="accountType" value="personal">
                                                <span class="ml-2">Crear Nuevo</span>
                                                </label>
                                                <label class="inline-flex items-center ml-6">
                                                <input type="radio"  @change="selectRep" class="border-solid form-radio" name="accountType" value="busines">
                                                <span class="ml-2">Seleccionar Representante</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-6 mt-5" v-if="representative == 'addRep'">
                                            <div class="flex justify-between" >
                                            <div class="w-1/2">
                                                    <label for="country" class="block text-sm font-medium text-gray-700">Dui </label>
                                                    <input type="text"  v-model="form.repDui" autocomplete="email" 
                                                    class="form-input w-11/12">
                                            </div>
                                            <div class="w-1/2">
                                                <label for="country" class="block text-sm font-medium text-gray-700">Nit</label>
                                                <input type="text"  v-model="form.repNit" autocomplete="email" 
                                                class="form-input w-11/12">
                                            </div>
                                            </div>
                                            <div class="w-full mt-5">
                                                <label for="email_address" class="block text-sm font-medium text-gray-700">Nombre</label>
                                                <input type="text" v-model="form.repName" autocomplete="email" class="form-input w-full">
                                            </div>
                                            <div class="w-full mt-5">
                                                <label for="email_address" class="block text-sm font-medium text-gray-700">Cargo en Empresa</label>
                                                <input type="text" v-model="form.repPos" autocomplete="email" class="form-input w-full">
                                            </div>
                                            
                                        </div>                            
                                        <div class="col-span-6 sm:col-span-6 mt-5" v-if ="representative == 'selectRep'">
                                            <label class="block text-sm font-medium text-gray-700">Representante Legal </label>
                                            <select
                                            v-model="form.representantive_id" class="form-select w-1/2">                                
                                                <option  v-for="representative in representatives" :key="representative.id" :value="representative.id">{{representative.name}} </option>
                                            </select>
                                        </div>
                                        <div class="col-span-6 sm:col-span-3 text-right sm:col-end-7 mt-10">                                           
                                            <jet-button type="button" @click.native="legalComplete">
                                                <span class="mr-2" >CREAR EMPRESA</span>                                          
                                            </jet-button>                                          
                                        </div>
                                  </div>
                               </div>                                                                          
                        </div>
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
import { mapState, mapActions, mapGetters } from "vuex";
import Icon from "@/Shared/Icon"
import JetButton from '@/Jetstream/Button'
export default {
    data(){
        return{
           form:{
                nit:this.nit,
                address: null,
                ncr:this.ncr,
                name: this.name, 
                comercialName: this.cname,
                phone: this.phone,
                comercialActivity: this.activity,
                representantive_id: null,
                accountant_id: '',
                repName: null,
                repDui: null,
                repNit: null, 
                repPos: null, 
                excel:null,
                country_id: null

           },
           generalStep:'processing',
           modulesStep:'pending',
           legalStep: 'pending',
           contableStep: 'pending',
           i : 0, 
           formdata : new FormData(),
           loadExcel : false,
           representative : 'addRep',
           checkbox1 : false,
           cModules : [],
           accountant : null,
           rol : null,
        }
    },
    mounted(){
        this.loadingDat()
    },
    
    computed: {
        ...mapState({
            nit : state => state.Company.newCompany.nit,
            ncr : state => state.Company.newCompany.ncr,
            name : state => state.Company.newCompany.name,
            cname : state => state.Company.newCompany.cname,
            phone : state => state.Company.newCompany.phone,
            activity : state => state.Company.newCompany.activity,
            accountant_id : state => state.Company.newCompany.accountant_id,
            accounts : state => state.Company.accounts,
            companyAccountants : state => state.Company.companyAccountants,
            company : state => state.Company.serverCompany
        })
    },
    props:['accountants','representatives','modules','roles','countries'],
    components:{
        AppLayout,
        Icon,
        JetButton
    },
    methods:{

        loadingDat(){            
            this.form.nit = this.nit
            this.form.ncr = this.ncr
            this.form.name =  this.name
            this.form.comercialName =  this.cname
            this.form.phone =  this.phone
            this.form.comercialActivity =  this.activity  
            
           
            if(this.company == null){
               
                this.generalStep == 'processing';
            }else if(this.company != null && this.company.status == 'req_modules'){
                this.modulesStep = 'processing';
                this.generalStep = 'complete';
            }else if(this.company != null && this.company.status == 'req_representative'){
                this.modulesStep = 'complete';
                this.generalStep = 'complete';
                this.legalStep = 'processing';
            }else if(this.company != null && this.company.status == 'req_accounting_info'){
                this.modulesStep = 'complete';
                this.generalStep = 'complete';
                this.legalStep = 'complete';
                this.contableStep = 'processing';
            }
        },
        
        addModule(moduleId){ 

            let index = this.cModules.indexOf(moduleId);
            if (index === -1) {
                this.cModules.push(moduleId)
            } else {
            this.cModules.splice(this.modules.indexOf(moduleId), 1);
            }           
        },
        cancelCatalog(){           
            this.excel = null
             this.$store.commit("Company/cancelAccounts")
        },
        selectRep(){            
            this.representative = 'selectRep'
            this.form.repName = null
            this.form.repDui = null
            this.form.repNit = null
            this.form.repPos = null
        },

        newRepres(){
            this.representative = 'addRep'
            this.form.representantive_id = null
        },

        createCompany(){ 
            
            this.$inertia.post(route('companies.storeaccountants',this.company.id), {                
                'operators'     : this.companyAccountants,                               
            }).then(() => {           
              this.$store.commit("Company/clearData")
            });
        },
        create(){           
            this.$inertia.post(route('companies.store'),this.form);
           
        },
          onFileChange(e) {
            this.form.excel = e.target.files || e.dataTransfer.files;           
        },
        loadManual(){
            this.loadExcel = false
             this.$inertia.visit(route("companies.addmanual")) 
            
        },
        updateNit(){           
           this.$store.commit("Company/updateNit", {              
                nit: this.form.nit
            });
        },
        updateNcr(){
            this.$store.commit("Company/updateNcr",{
                ncr: this.form.ncr
            })
        },
        updateName(){
            this.$store.commit("Company/updateName",{
                name : this.form.name
            })
        },
        updateCname(){
            this.$store.commit("Company/updateCname",{
                cname : this.form.comercialName
            })
        },
        updatePhone(){
            this.$store.commit("Company/updatePhone",{
                phone : this.form.phone
            })
        },
        updateActivity(){
            this.$store.commit("Company/updateActivity",{
                activity: this.form.comercialActivity
            })
        },
        updateAccountant(){
            this.$store.commit("Company/updateAccountant",{
                accountant_id: this.form.accountant_id
            })
        },
        cancelCompany(){
            this.$store.commit("Company/cancelCompany");
            this.loadingDat();
            this.$ineria.visit(route('companies.index'));

        },
        generalComplete(){
            let company = {
                 'nit'     : this.nit,
                'ncr'     : this.ncr,
                'name'    : this.name,
                'comercialName'   : this.cname,
                'phone'   : this.phone,
                'comercialActivity' : this.activity,               
                'address'       : this.form.address,
                'country_id'    : this.form.country_id,
            }
            this.$store.commit("Company/saveCompany",company)
            this.$store.dispatch("Company/storeCompany")
            this.generalStep = 'complete'
            this.modulesStep = 'processing'
        },
        modulesComplete(){
            this.$store.commit("Company/saveModules",this.cModules)
            this.$store.dispatch("Company/storeModules")
            this.modulesStep = 'complete'
            this.legalStep = 'processing'
        },
        legalComplete(){           
            if(this.representative != null && this.representative == 'addRep'){
                     
                let legal = {
                    'name' : this.form.repName,
                    'dui'  : this.form.repDui,
                    'nit'  : this.form.repDui,
                    'position'  : this.form.repPos,
                     'repId'    : null,
                }
                this.$store.commit("Company/saveRepresentative",legal)
                this.$store.dispatch ("Company/storeRepresentative")

                this.$inertia.visit(route('companies.index')).then(() => {           
                this.$store.commit("Company/clearData")
                });

            }else if(this.representative != null && this.representative == 'selectRep'){
                let legal = {                    
                    'repId'  : this.form.representantive_id
                }
                this.$store.commit("Company/saveRepresentative",legal)
                this.$store.dispatch ("Company/storeRepresentative")

                this.$inertia.visit(route('companies.index')).then(() => {           
                this.$store.commit("Company/clearData")
                });

            }
        },
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
        showGeneral(){
            this.generalStep = 'processing';
            this.modulesStep = 'pending';
            
        },
        showModules(){
            this.modulesStep = 'processing';
            this.legalStep = 'pending';
        },
        showLegal(){
            this.legalStep = 'processing';
            this.contableStep = 'pending';
        }

    }

}
</script>