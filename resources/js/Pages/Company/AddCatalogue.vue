<template>
    <app-layout>
        <div class="fixed z-10 inset-0 overflow-y-auto" v-show="modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!--
                Background overlay, show/hide based on modal state.

                Entering: "ease-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                Leaving: "ease-in duration-200"
                    From: "opacity-100"
                    To: "opacity-0"
                -->

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
                             <div class="col-span-3 mt-5 sm:col-span-3">
                                <span class="text-gray-600 text-md">Agregar Cuenta a Catalogo </span>
                            </div>                           
                            <div class="col-span-6 sm:col-span-6  mt-5" v-if="createMethod == 'manual'">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-3">
                                                <label for="email_address" class="block text-sm font-medium text-gray-700">Codigo Cuenta </label>
                                                <input type="text" @blur="checkFather" v-model="account_code" autocomplete="email" class="form-input w-full">
                                        </div>
                                            <div class="col-span-6 sm:col-span-3">
                                            <label class="block text-sm font-medium text-gray-700">Tipo de Cuenta  </label>
                                            <select
                                            @change="changeType"
                                            v-model="account_type" class="form-select w-full">                                
                                                <option :selected="prevType === type.id"  v-for="type in types" :key="type.position" :value="type">{{type.position+"-"+type.name}} </option>
                                            </select>
                                        </div>
                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="email_address" class="block text-sm font-medium text-gray-700">Nombre de Cuenta </label>
                                            <input type="text" v-model="account_name" autocomplete="email" class="form-input w-full">
                                        </div>                                                       
                                            <div class="col-span-6 sm:col-span-3">
                                            <label class="block text-sm font-medium text-gray-700">Tipo de Cuenta de Movimientos  </label>
                                            <select
                                            v-model="detail" class="form-select w-full">                                
                                                <option  value="1">Detalle </option>
                                                <option  value="0">Acumulativa </option>
                                            </select>
                                        </div>
                                            <div class="col-span-3">
                                                <label for="email_address" class="block text-sm font-medium text-gray-700">Correlativo de Cuenta Padre </label>
                                                <input type="text" v-model="lastFather" disabled autocomplete="email" class="form-input w-full">
                                        </div>
                                        <div class="col-span-6 sm:col-span-3 sm:col-start-4 mt-20 mb-10">
                                            <div class="flex">
                                                <jet-secondary-button class="mr-2" type="button" @click.native="modal = !modal">
                                                    <span class="mr-2">Cancelar</span>                                                               
                                                </jet-secondary-button> 
                                                <jet-button class="mr-2" type="button" @click.native="addaccount">
                                                    <span>Agregar</span>                                                               
                                                </jet-button>
                                            </div>                                                           
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
                        <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Agregar Catalogo a Empresa</a>
                    </div>
                    </li>                    
                </ol>
            </nav>
           <div class="flex">
                 <button type="button" @click="addExcel" class="text-xs text-white mr-3 rounded-md font-bold bg-green-600 rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-700 text-sm hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                    <span class="mr-2">CARGAR EXCEL </span>                                                               
                </button>   
                <jet-button type="button" @click.native="addManual">
                   AGREGAR CUENTA
                </jet-button>     
            </div>      
        </div> 
        <div class="mt-10 sm:mt-10 ">
            <div class="md:grid md:grid-cols-3 md:gap-6">               
                   <div class="md:col-span-3">
                    <div class="shadow-lg h-screen border-l border-t border-gray-200  sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="px-4 mb-5 sm:px-0">
                                <h3 v-show="createMethod == 'manual'" class="text-2xl font-medium leading-6 text-gray-900">Agregar Cuentas Manualmente </h3>
                                <h3 v-show="createMethod == 'loadExcel'" class="text-2xl font-medium leading-6 text-gray-900">Cargar Desde Archivo Excel  </h3>                       
                            </div>
                            <div class="grid grid-cols-6 gap-6 "> 
                                <div class="col-span-6 sm:col-span-6">
                                     <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                           <div class="grid grid-cols-7  ">                                      
                                                <div class="col-span-6 sm:col-span-2 mt-24 sm:col-start-2" v-if="createMethod == 'loadExcel'">
                                                    <a href="/excel_template/plantilla_catalogo.xlsx" download class="w-90 flex flex-col items-center px-4 py-6 bg-white text-green-600 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-green-700" style="border:solid 1px green; color:back;">
                                                          
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" viewBox="0 0 20 20" fill="currentColor">
                                                             <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                                        </svg>                                                                                                          
                                                         <span  class="mt-2 text-base leading-normal">Descargar Plantilla Excel</span>                                                      
                                                    </a>                                                  
                                                </div>
                                                <div class="col-span-6 sm:col-span-2 sm:col-start-5  mt-24 ml-5" v-if="createMethod == 'loadExcel'">
                                                    <label class="w-90 flex flex-col items-center px-4 py-6 bg-white text-green-600 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-green-700" style="border:solid 1px green; color:back;">
                                                        
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                                                        </svg>
                                                        <span v-show="fileName == null" class="mt-2 text-base leading-normal">Seleccionar Archivo Catalogo</span>
                                                         <span v-show="fileName != null" class="mt-2 text-base leading-normal">{{this.fileName}}</span>
                                                        <input type='file' class="hidden" @change="onFileChange"/>
                                                    </label>
                                                </div>
                                           </div>
                                            <div v-show="accounts.length == 0 && createMethod == 'manual'">
                                                <img
                                                    src="/svgs/no-products.svg"
                                                    class="w-1/3 mx-auto h-64"
                                                    alt=""
                                                />
                                                <h4 class="text-gray-500 font-semibold text-center">
                                                   No se ha creado ninguna cuenta. 
                                                </h4>
                                            </div>
                                            <div v-show="accounts.length > 0 && createMethod == 'manual'" class=" shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">              
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-cyan-800">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                                        codigo
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                                        nombre
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                                        tipo de cuenta
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                                        tipo de movimiento
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                                        Cuenta padre
                                                        </th>                                                       
                                                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                                        Opciones
                                                        </th>  
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="bg-white" v-for="item in accounts"
                                                        :key="item.id">
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{item.code}}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{item.name}}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{item.type.name}}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                          {{getDetail(item.detail)}}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{item.father}}
                                                        </td>                                                       
                                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                           <button @click="deleteAcount(item.code)">  <icon name="delete"/></button>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-show="accounts.length > 0 || form.excel != null" class="col-span-3 col-start-4 mr-1 text-right ">
                                    <jet-button @click.native="createCatalogue">
                                        Guardar Catalogo 
                                    </jet-button>                                   
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
import Icon from '@/Shared/Icon'
import { mapState, mapActions, mapGetters } from "vuex"
import JetButton from '@/Jetstream/Button'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
export default {
    data(){
        return{
            account_type: null,
            fileName: null, 
            detail:null,
            account_code:null,
            account_name: null,            
            father_code: null,
            createMethod: 'manual',
            excel : null,           
            lastFather: null,            
            checkCode : 0,
            firstAccountCheck : true, 
            cTypes : [],
            modal : false,
            form: this.$inertia.form({
                '_method': 'POST',
                'excel' : null,
                'accounts' : [],
            })
        }
    },
    props:['types','company'],
     computed:{
        ...mapState({
            name: state => state.Company.newCompany.name,
            accounts: state => state.Company.accounts,
            prevType: state => state.Company.previousType,
            accountTypes : state => state.Company.accountTypes,
            digits  : state => state.Company.digits,
        })
    },
    components:{
       AppLayout, 
       Icon,
       JetButton,
       JetSecondaryButton
    },
    methods:{
        addaccount(){
            
             var firstChart = this.account_code.charAt(0);
             if(firstChart == this.account_type.position){
                    if(this.lastFather == null){
                    this.lastFather = '0' 
                }/* else if(this.lastFather){

                } */
                this.accounts.forEach(account => {
                    if(account.code == this.account_code){
                        this.checkCode = 1
                    }          
                });

                if(this.checkCode == 1){
                        alert('Codigo de cuenta ya ingresada.')
                        this.checkCode = 0
                    }else{                   
                        let account = {                
                            code: this.account_code,
                            name: this.account_name,
                            type: this.account_type,
                            father: this.lastFather,
                            detail: this.detail,               
                        }           
                        this.detail=null
                        this.account_code = null
                        this.account_name = null
                        this.account_balance = null                                        
                        this.lastFather = account.code 
                                        
                        
                        this.$store.commit("Company/addAcount", account);   
                        this.$store.commit("Company/setPrevousType",account.type)  
                        this.modal = !this.modal               
                    }
             }else{
                 alert('Tipos de cuenta no concuerdan')
             }

            
        },
         deleteAcount(accountCode){
           
            this.$store.commit("Company/deleteAccount",accountCode)
             this.getLastFather();
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
            this.form.excel = e.target.files[0] || e.dataTransfer.files[0]; 
             this.fileName = this.form.excel.name;          
        },

        changeType(){          
            if(this.prevType.position != this.account_type.position ){
                this.lastFather = '0';
            }else{
                this.getLastFather();
            }
            
        },
        getTypes(type){
            if(type.name == "ACTIVO"){
                return 1;
            }else if(type.name == "PASIVO"){
                return 2;
            }else if(type.name == "CAPITAL"){
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
                    })
            }
        },
        
        addManual(){
            this.modal= !this.modal
            this.createMethod = 'manual'
        },
        createCatalogue(){
            if(this.createMethod == 'manual'){
                this.form.accounts = this.accounts 
            }
            this.form.post(route('companies.savecatalogue',this.company.id)).then(() => {           
              this.$store.commit("Company/cancelAccounts")
            });
        },
        addExcel(){
            this.createMethod = 'loadExcel'
            this.$store.commit('Company/cancelAccounts')
        },
        getLastFather(){
             if(this.accounts.length > 0){
            var lastAcc = this.accounts[this.accounts.length-1];
            this.lastFather = lastAcc.code   
            this.account_type = this.prevType         
            }else{
                this.lastFather = 0 
            }
        },
        checkFather(){           
            var fatherAccounts = [];
            //if(this.account_code.length == this.lastFather.length ){        
                    
               if(this.accounts.length > 0 ){
                   
                    this.accounts.forEach(account => { 
                                         
                        if(this.account_code.length > account.code.length && this.account_type.position == account.type.position){
                            fatherAccounts.push(account)
                            
                        }
                    });

                    if(fatherAccounts.length > 0 ){ 

                         var backArray = []; 
                        var i = 1;   
                        var j =0;                   
                        fatherAccounts.forEach(element => {
                            var item = fatherAccounts[fatherAccounts.length-i].code
                            backArray.push(item) 
                             if(i < fatherAccounts.length){
                                i++;
                           }
                        });
                        console.log(backArray);   
                                                                           
                            backArray.forEach(element => {
                            var item = element                            
                            var codeChar = this.account_code.substring(0,item.length)
                            console.log('father '+item)
                            console.log('code '+ codeChar)
                            console.log( item.length-1)
                            if(item == codeChar && j == 0 ){
                               this.lastFather = item                              
                               j ++;
                              
                            }                        
                            //this.lastFather = item.code 
                        });
                        console.log('lastf' + this.lastFather)
                    }else{
                        this.lastFather = 0 
                    } 
               }               
        },
        getDetail(detail){
            if(detail == 0 ){
                return 'Agrupacion'
            }else{
                return 'Detalle'
            }
        },
    },
    mounted(){

        this.getLastFather();
        // this.$store.commit("Company/clearData")        
        if(this.accountTypes.length > 0){
            this.cTypes = this.accountTypes 

        }else{
            var position = null
            this.types.forEach(type => {
                if(type.name == "ACTIVO"){
                    position = 1
                }else if(type.name == "PASIVO"){
                    position = 2
                }else if(type.name == "CAPITAL"){
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
    }
}
</script>