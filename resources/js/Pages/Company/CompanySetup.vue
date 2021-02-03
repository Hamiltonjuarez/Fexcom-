<template>
    <app-layout>
        <template #header-title>
            Configurar Empresa   
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
                        <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Configurar Empresa</a>
                    </div>
                    </li>                    
                </ol>
            </nav>          
        </div> 
         <div class="mt-10 sm:mt-10">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                 <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Configuracion de la Empresa</h3>
                        <p class="mt-1 text-sm text-gray-600">
                           Configurar datos generales para poder realizar la funcionalidad contable 
                           de la empresa seleccionada.
                        </p>                        
                    </div>
                 </div>  
                  <div class="md:col-span-2">
                        <div class="shadow-lg sm:min-h-full overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">                                                    
                                    <div class="col-span-6" v-show="catalogStep == 'processing'"><!-- step 1 -->                                        
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 mt-5 sm:col-span-6">
                                                <span class="text-gray-600">Configuracion de Parametros del Catalogo de la Empresa. </span>
                                            </div>
                                             <div class="col-span-6 mt-5 sm:col-span-3">
                                                <label for="email_address" class="block text-sm font-medium text-gray-700">Numero de digitos de cuentas de mayor de la empresa</label>
                                                <input type="number" v-model="mainAccountsDigits" class="form-input w-1/2">
                                            </div>  
                                            <div class="col-span-6 mt-5 sm:col-span-6">
                                                <span class="text-gray-600">Orden de Tipos de Cuenta del Catalogo. </span>
                                            </div>                                          
                                            <div class="col-span-6  sm:col-span-4">
                                                <div class="col-span-6 sm:col-span-6 pt-2 px-3 border-b border-gray-200 rounded-md shadow-md">
                                                    <div v-for="type in cTypes " :key="type.id" class="grid grid-cols-6" >
                                                       <span class="col-span-3 mt-1">{{type.name}}</span> 
                                                       <input type="number"
                                                        @input="setTypeOrden( $event.target.value,type.id)"
                                                        :value="getTypes(type)" :placeholder="getTypes(type)"
                                                        :disabled="type.name == 'ACTIVO' || type.name == 'PASIVO' || type.name == 'CAPITAL' "                                                       
                                                        class="form-input col-span-3 col-start-5 w-full">    <br>                                                    
                                                    </div>
                                                </div>
                                            </div>                                         
                                        </div>
                                        <div class="col-span-6 sm:col-span-6 mt-10 text-right mr-10">
                                             <jet-button type="button" @click.native="catalogeComplete">
                                               SIGUIENTE
                                            </jet-button>
                                        </div>
                                    </div>  
                                    <div class="col-span-6" v-show="contableStep == 'processing'"> <!-- step 2 -->
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                Configuracion de Parametros Contables 
                                            </div>
                                            <div class="col-span-4 mb-5">
                                                <label for="email_address" class="block text-sm font-medium text-gray-700">Periodo Inicial de Contabilidad</label>
                                                <vue-monthly-picker :monthLabels="months" v-model="selectedMonth">                                                
                                                </vue-monthly-picker>                                         
                                            </div>
                                            <div class="col-span-4">
                                               <label class="block text-sm font-medium text-gray-700">Seleccione Auditor</label>
                                                <select class="form-select w-full" v-model="auditor ">                                
                                                    <option  v-for="item in auditors " :key="item.id" :value="item">{{item.name}} </option>
                                                </select>
                                            </div>   
                                            <div class="col-span-6 sm:col-span-6 mt-10 mb-10 text-right mr-10">
                                                  <jet-secondary-button type="button" @click.native="showCatalogue"
                                                    class="text-xs mr-3 bg-gray-400 text-white font-bold rounded border-b-2
                                                    hover:bg-gray-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                                     REGRESAR
                                                </jet-secondary-button>
                                                <jet-button type="button" @click.native="send"
                                                class="text-white font-bold bg-gray-600 rounded border-b-2  hover:bg-cyan-700
                                                text-xs hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                                   GUARDAR
                                                </jet-button>                                               
                                            </div>                                         
                                        </div>
                                    </div>                                 
                                </div>
                            </div>
                        </div>                        
                  </div>
            </div>
         </div>        
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import VueMonthlyPicker from 'vue-monthly-picker'
import JetButton from '@/Jetstream/Button'
import JetNavLink from '@/Jetstream/NavLink'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import { mapState, mapActions, mapGetters } from "vuex"
import Icon from '@/Shared/Icon'
export default {
    data(){
        return{
           
            mainAccountsDigits : '',            
            firstAccountCheck : true, 
            cTypes : [],
            selectedMonth: null,
            auditor: null,
            catalogStep : 'processing',
            contableStep : 'pending',
            months : ['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT',
            'NOV','DEC']
        }
    },
    props:['types','auditors','company'],
    components:{
        AppLayout,
        Icon,
        VueMonthlyPicker,
        JetButton,
        JetNavLink,
        JetSecondaryButton
    },
    mounted(){
        if(this.accounts.length > 0){
            var lastAcc = this.accounts[this.accounts.length-1];
            this.lastFather = lastAcc.code            
        }else{
            this.lastFather = 0 
        }
        if(this.accountTypes.length > 0){
            this.cTypes = this.accountTypes           

        }else{
            var position = null
            this.types.forEach(type => {
                if(type.name == "ACTIVO"){
                    position = 1
                }else if(type.name == "PASIVO"){
                    position = 2
                }else if(type.name == "PATRIMONIO"){
                    position = 3
                }else{
                    position = null
                }
                this.cTypes.push({
                    'name': type.name,
                    'id'  : type.id,
                    'position'  : position
                });
            });
        }

        if(this.digits > 0 ){
            this.mainAccountsDigits = this.digits 
        }
      /*   this.cancelaccounts() */
    },
    methods:{        
        deleteacount(accountCode){           
            this.$store.commit("Company/deleteAccount",accountCode)
        },
        cancelaccounts(){             
             this.$inertia.visit(route('companies.create')).then(() => {           
            this.$store.commit("Company/cancelAccounts")
            });
        },
        addCatalog(){
            this.$inertia.visit(route('companies.create'))
        },
        onFileChange(e) {
            this.excel = e.target.files[0] || e.dataTransfer.files[0];           
        },
        changeType(){
            this.lastFather = '0';
        },
        getTypes(type){
            if(type.name == "ACTIVO"){
                return 1;
            }else if(type.name == "PASIVO"){
                return 2;
            }else if(type.name == "PATRIMONIO"){
                return 3;
            }
           
        },
        setTypeOrden(index, id){            
           var item = this.cTypes.find(item => item.id === id);
           item.position = index
        },
        catalogeComplete(){
            var typesOrderChecker = 0 
            this.cTypes.forEach(type => {
                if(type.position == null){
                    typesOrderChecker = 1 
                }
            });
            if(typesOrderChecker == 0 && this.mainAccountsDigits > 0){
                this.$store.commit("Company/setCatalogueSetings",{
                    'digits':this.mainAccountsDigits,
                    'types' : this.cTypes
                    });
                this.catalogStep = "complete";
                this.contableStep = 'processing';
            }

        },  
        showCatalogue(){
             this.catalogStep = "processing";
             this.contableStep = 'pending';
        },
        send(){
            if(this.auditor != null && this.selectedMonth != null){
                this.$inertia.post(route('companies.savesettings',this.company.id),{
                    'account_types': this.cTypes,
                    'digits_number' : this.digits,
                    'contability_date' : this.selectedMonth, 
                    'auditor'  : this.auditor,
                }).then(() => {           
              this.$store.commit("Company/clearData")
            })
            }
        }   
    },
    computed:{
        ...mapState({
            name: state => state.Company.newCompany.name,
            accounts: state => state.Company.accounts,
            
            accountTypes : state => state.Company.accountTypes,
            digits  : state => state.Company.digits,
        })
    }
}
</script>