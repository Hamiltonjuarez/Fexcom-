<template>
    <app-layout>
         <!-- <jet-dialog-modal :show='show'>
              <template #title>
                 <span class="font-extrabold text-md">INFORMACION DE LA COMPRA</span>
              </template>
              <template #content>
                <span class="text-gray-800 font-bold text-sm ml-10">INFORMACION GENERAL </span>
                <div class="flex flex-col ml-20">
                    <div class="flex">
                         <span class="text-gray-700 mr-3">Numero de documento: </span> <span>{{docNumber}}</span>
                    </div>
                     <div class="flex">
                         <span class="text-gray-700 mr-3">Fecha de emision: </span> <span>{{documentDate}}</span>
                    </div>
                     <div class="flex">
                         <span class="text-gray-700 mr-3">Plazo de pago: </span> <span>{{paymenTerms}}</span>
                    </div>
                     <div class="flex">
                         <span class="text-gray-700 mr-3">Tipo de IVA:</span> <span>{{iva}}</span>
                    </div>  
                </div>
                <span class="text-gray-800 font-bold text-sm ml-10 mt-15">INFORMACION DEL PROVEEDOR </span>
                <div class="flex flex-col ml-20" v-if="supplier != null">
                    <div class="flex">
                         <span class="text-gray-700 mr-3" >NCR: </span> <span v-if="showProvider">{{supplier.ncr}}</span>
                    </div>
                     <div class="flex">
                         <span class="text-gray-700 mr-3">NIT: </span> <span v-if="showProvider">{{supplier.nit}}</span>
                    </div>
                     <div class="flex">
                         <span class="text-gray-700 mr-3">Nombre: </span> <span v-if="showProvider">{{supplier.name}}</span>
                    </div>
                     <div class="flex">
                         <span class="text-gray-700 mr-3">Serie/Folio activo:</span> <span v-if="showProvider">{{supplier.active_foil}}</span>
                    </div>  
                </div>
                <div class="flex flex-col ml-20" v-if="excludedName != null">
                    <div class="flex">
                         <span class="text-gray-700 mr-3">Nombre: </span> <span>{{excludedName}}</span>
                    </div>
                     <div class="flex">
                         <span class="text-gray-700 mr-3">NIT: </span> <span>{{excludedNIT}}</span>
                    </div>                    
                </div>
               
              </template>
              <template #footer class="flex">                  
                <jet-secondary-button @click.native="show = !show" class="mr-1">
                    cancelar
                </jet-secondary-button>
                <jet-button @click.native="createPurchase">
                      guardar
                  </jet-button>
              </template>
         </jet-dialog-modal> -->
         <template #header-title>
           Crear Compra
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
                    <a :href="route('purchases.index')" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Compras</a>
                </div>
                </li>      
                 <li>
                 <div class="flex items-center">
                    <!-- Heroicon name: chevron-right -->
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Crear Compra</a>
                </div>
                </li>                
            </ol>
           </nav>
        </div>
         <div class="w-full h-full  pt-3 flex" v-if="settingsStep">
           <div class="w-2/6 mt-5 pl-10">
               <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Crear una nueva compra</h3>
                    <p class="mt-1 text-sm text-gray-600">
                      Ingrese los datos generales para crear una nueva compra, luego ingrese los productos/servicios 
                      que iran incluidos en esta compra. 
                    </p>                   
                </div>
                <div class="w-full bg-white rounded-md px-5 py-3 shadow-md mt-5">
                    <span class="text-gray-900 font-bold">Informacion del Proveedor</span>
                    <div class="flex flex-col">
                        <div class="flex mt-3 ml-10">
                             <span class="text-gray-500">NCR:</span> <span class="text-gray-700 ml-5">{{supplier.ncr}}</span>
                        </div>
                         <div class="flex mt-3 ml-10">
                             <span class="text-gray-500">NIT:</span> <span class="text-gray-700 ml-5">{{supplier.nit}}</span>
                        </div>
                         <div class="flex mt-3 ml-10">
                             <span class="text-gray-500">Nombre:</span> <span class="text-gray-700 ml-5">{{supplier.name}}</span>
                        </div>
                         <div class="flex mt-3 ml-10">
                             <span class="text-gray-500">Giro:</span> <span class="text-gray-700 ml-5">{{supplier.business_activitie}}</span>
                        </div>
                         <div class="flex mt-3 ml-10" v-if="supplier.contributor">
                             <span class="text-gray-500">Serie/Folio:</span> <span class="text-gray-700 ml-5">{{supplier.active_foil.foil}}</span>
                        </div>                       
                    </div>
                </div>
           </div>
          <div class="h-full flex flex-col flex-grow w-4/6 my-5 rounded-md ml-10 bg-white shadow-md">
            <span class="mt-5 ml-5 text-lg">Informacion General del Documento</span>
            <div class="flex-col h-full w-full mt-10">                
                <div class="flex h-full " :class="supplier.contributor ? 'justify-around' : 'ml-10'">               
                    <div class="w-2/5" v-if="supplier.contributor">
                        <label  class="block text-sm font-medium text-gray-700">Tipo de Documento </label>                                
                         <select class="form-select w-full" v-model="documentType">                                
                            <option v-for="item in invoices" :key="item.id" :value="item"> {{item.name}} </option>                           
                        </select>
                    </div>  
                    <div :class="supplier.contributor ? 'w-2/5' : 'w-1/2'">
                        <label class="block text-sm font-medium text-gray-700">No. Documento</label>
                        <input type="text" class="form-input w-full" v-model="docNumber">
                    </div>                                                                      
                </div> 
                <div class="flex h-full mt-10" :class="supplier.contributor ? 'justify-around' : 'ml-10'">               
                    <div class="w-2/5" v-if="supplier.contributor">
                        <label class="block text-sm font-medium text-gray-700">Serie/Folio Asignada por Hacienda </label>                                
                         <input type="text" class="form-input w-full" v-model="foil" @input="changeFoil">
                    </div>  
                     <div   :class="supplier.contributor ? 'w-2/5' : 'w-1/2'">
                        <label class="block text-sm font-medium text-gray-700">Fecha de Emision del Documento </label>
                        <input type="date" class="form-input w-full" v-model="documentDate">
                    </div>                                                                    
                </div>   
                <div class="flex h-full mt-10">               
                    <div class="w-full ml-10 mr-10">
                        <label class="block text-sm font-medium text-gray-700">Concepto del Documento</label>                                
                        <input type="text" class="form-input w-full" v-model="docConecpt">
                    </div>                                                                        
                </div>              
                <div class="flex h-full justify-around mt-10">    
                    <div class="w-2/5 ">
                        <label class="block text-sm font-medium text-gray-700">Total de la Compra </label>
                        <input type="number" class="form-input w-full" v-model="documentTotal">
                    </div>                  
                    <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Seleccione Plazo de Pago</label>
                        <select class="form-select w-full" v-model="paymenTerms">                                
                            <option value="CONTADO"> Contado </option>
                            <option value="15 DIAS">15 Dias </option>
                            <option value="30 DIAS">30 Dias </option>
                            <option value="60 DIAS">60 Dias </option>
                        </select>
                    </div>                                               
                </div>
                <div class="flex h-full justify-around mt-10">
                     <div class="w-2/5 ">
                        <label class="block text-sm font-medium text-gray-700">Percepcion del 1% </label>
                        <input type="number" class="form-input w-full" v-model="retOne">
                    </div>  
                    <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Seleccione Tipo de Compra</label>
                        <select class="form-select w-full" v-model="purchasePayingConcept">                                
                            <option value="productos"> Productos </option>
                            <option value="servicios">Servicios </option>
                            <option value="adelanto">Adelanto a Pago </option>
                        </select>
                    </div>                                               
                </div>
                <div class="flex w-full mt-10 justify-around mb-10">
                    <!-- <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Tipo de IVA</label>
                        <select class="form-select w-full" v-model="iva">                                
                            <option value="gravado"> GRAVADO </option>
                            <option value="excento">EXCENTO </option>
                            <option value="excluido">EXCLUIDO </option>                                   
                        </select>
                    </div> -->   
                   <div class="w-2/5 ">
                        <label class="block text-sm font-medium text-gray-700">Retencion del 10% </label>
                        <input type="number" class="form-input w-full" v-model="retTen">
                    </div>  
                    <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Otros Inpuestos</label>
                        <input type="number" v-model="otherTaxes" class="form-input w-full">
                    </div>                                                             
                </div>                
            </div>
            <div class="w-full text-right">
                <jet-button class="mx-10 my-5" @click.native="savePurchase">
                    Siguiente 
                </jet-button>
            </div>
        </div>        
      </div>     
      <div class="h-full flex flex-col overflow-hidden flex-grow w-11/12 my-10 rounded-md ml-15 bg-white shadow-md" v-if="productsStep">
            <span class="mt-5 ml-5 text-lg">Agregar Productos </span>
            <div class="flex-col h-full w-full mt-5 px-10"  >                                
                <div class="rounded-md w-full mx-auto">
                    <table class="max-w-1/2 divide-y divide-gray-200">
                        <thead class="bg-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            codigo
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            descripcion
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            cantidad 
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            precio U.
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Tipo de compra.
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            total 
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Opciones
                            </th>
                        </tr>
                        </thead>
                        <tbody>     
                        <tr class="bg-white hover:bg-gray-100 border-b" v-for="item in products"
                            :key="item.id">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{item.code}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{item.description}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{item.quantity}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{item.uPrice}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{item.iva}}
                            </td> 
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{item.total}}
                            </td>                         
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex z-40 text-center">                                            
                                    <a @click="delProduct(item.code)"
                                    class="ml-5 cursor-pointer" > <icon class="text-gray-500 hover:text-cyan-700" name='delete-blank'/></a>
                                </div>
                            </td>
                        </tr>                                     
                        <tr class="bg-white ">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <input type="text" v-model="code" class="form-input w-2/3" name="" id="">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <input type="text" v-model="description" class="form-input w-2/3" name="" id="">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <input type="number" v-model="quantity" class="form-input w-2/3" name="" id="">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <input type="number" v-model="uPrice" class="form-input w-2/3" name="" id="">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <select class="form-select w-full" v-model="productType">                                
                                    <option value="gravado"> GRAVADO </option>
                                    <option value="excento">EXCENTO </option>
                                    <option value="excluido">EXCLUIDO </option>                                   
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                0 
                            </td> 
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                <div class="flex  text-center">                                            
                                    <a @click="addProduct"
                                    class="ml-5 cursor-pointer" > <icon class="text-gray-500 hover:text-cyan-700" name='add'/></a>
                                </div>
                            </td>                                       
                        </tr>                              
                        </tbody>
                    </table> 
                    <div class="flex w-full my-5 border-t pt-3">
                        <span class="w-4/5 ml-7 font-bold">TOTAL </span>
                        <span class="w-1/5 mr-20 font-bold"> $ {{purchaseTotal}} </span>
                    </div>                                 
                </div> 
                <div class=" text-right mt-10 mb-5 ">
                    <jet-button @click.native="createPurchase" >crear venta </jet-button>
                </div>                                                                   
           </div>
      </div>
    </app-layout>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout';
    import Icon from '@/Shared/Icon';
    import JetButton from '@/Jetstream/Button';
    import vSelect from "vue-select";
    import "vue-select/dist/vue-select.css";
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import { mapState, mapActions, mapGetters } from "vuex";
  export default {
        data(){
            return{               
                documentType : null, 
                paymenTerms : null,
                docNumber   : null,
                foil        : null,                                                       
                documentDate : null,
                otherTaxes  : 0,              
                retTen      : 0, 
                retOne      : 0, 
                docConecpt  : null,    
                documentTotal : null, 
                purchasePayingConcept : null,     
                productsStep : false, 
                settingsStep : true,  
                uPrice       : null, 
                quantity     : null, 
                description  : null, 
                code         : null, 
                productType  : null, 
            }
        },
        props: ['supplier','invoices'],
        components:{
        AppLayout,
        Icon,
        JetButton,
        vSelect,
        JetDialogModal,
        JetSecondaryButton,          
    },   
     mounted(){
        this.setData()
    },
    
    computed: {
        ...mapState({           
            settings : state => state.Purchase.settings,
            products : state => state.Purchase.products,
            purchaseTotal : state => state.Purchase.purchaseTotal,
            totaliva : state => state.Purchase.totaliva,
            totalNoIva : state => state.Purchase.total,
            productsIva : state => state.Purchase.iva,
        })
    }, 
    methods:{

        setData(){
           // this.$store.commit("Purchase/clearSettings")
           if(!this.supplier.contributor){
               this.documentType = this.invoices.find(element => element.name ="Factura Sujeto Excluido");
           }
            if(this.settings != null){
                this.foil         = this.settings.foil                
                this.documentType = this.settings.docType
                this.paymenTerms  = this.settings.terms
                this.docNumber    = this.settings.docNumber
                this.foil         = this.settings.foil
                this.retTen       = this.settings.tenRetention
                this.retOne       = this.settings.oneRetention                
                this.documentDate   = this.settings.date
                this.otherTaxes   = this.settings.otherTaxes
                this.docConecpt   = this.settings.docConcept
                this.purchasePayingConcept = this.settings.purchaseType
                this.documentTotal  = this.settings.total

                this.settingsStep = false
                this.productsStep = true 
            }else{
                if(this.supplier.contributor){
                    this.foil = this.supplier.active_foil.foil
                }else{
                    this.foil = 0 
                }
            }
        },

        setFoil(){           
            if(this.supplier != null){
                this.oldFoil = this.supplier.active_foil
                this.provName = this.supplier.name
            }
        },
        close(){
            this.show = !this.show
        },

        savePurchase(){

            if(this.documentType != null && this.paymenTerms != null && this.docNumber != null && this.documentDate != null){

              var settings = {
                'supplier'      : this.supplier,
                'docType'       : this.documentType,
                'terms'         : this.paymenTerms,
                'docNumber'     : this.docNumber,
                'foil'          : this.foil, 
                'tenRetention'  : this.retTen, 
                'oneRetention'  : this.retOne,           
                'date'          : this.documentDate,
                'otherTaxes'    : this.otherTaxes, 
                'docConcept'    : this.docConecpt,
                'purchaseType'  : this.purchasePayingConcept,
                'total'         : this.documentTotal
              }  
             
            this.$store.commit("Purchase/addSettings",settings)
             }

             if(this.purchasePayingConcept == 'productos'){
                 this.settingsStep = false 
                 this.productsStep = true 
             }else{
                 this.createPurchase();
             }
             
            
        },
        changeFoil(){
            this.$store.commit("Purchase/changeFoil",this.foil)
        },

        createPurchase(){
            var request = {
                'settings' : this.settings,
                'products' : this.products,
                'totalIva' : this.totaliva,
                'totalNoIva' :  this.totalNoIva,
                'purchaseTotal' : this.purchaseTotal
            }

            this.$inertia.post(route('purchases.savelocal'),request);
            this.$store.commit("Purchase/clearSettings")
        },

        addProduct(){
            let product = {
                'code'          : this.code, 
                'description'   : this.description, 
                'uPrice'        : this.uPrice, 
                'quantity'      : this.quantity,
                'iva'           : this.productType,
                'total'         : null, 
                'totalIva'      : null,
            }
            this.$store.commit("Purchase/addProduct",product)

            this.code = null 
            this.description = null 
            this.uPrice = null 
            this.quantity = null 
            this.productType = null         
        },
        delProduct(prodCode){
           
             this.$store.commit("Purchase/deleteProduct",prodCode)
        },
    }

 }
</script>