<template>
    <app-layout>
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
                <div class="flex h-full justify-around"> 
                     <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Duca / Poliza</label>
                        <input type="text" class="form-input w-full" v-model="duca">
                    </div>             
                    <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Partida Arancelaria</label>
                        <input type="text" class="form-input w-full" v-model="tariff">
                    </div>                                                                                      
                </div>   
                 <div class="flex h-full justify-around mt-10">                                
                    <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">No. Documento</label>
                        <input type="text" class="form-input w-full" v-model="docNumber">
                    </div>    
                     <div class="w-2/5 ">
                        <label class="block text-sm font-medium text-gray-700">Total FOB </label>
                        <input type="number" class="form-input w-full" v-model="fobTotal">
                    </div>                                                                     
                </div>              
                <div class="flex h-full mt-10">               
                    <div class="w-full ml-10 mr-10">
                        <label class="block text-sm font-medium text-gray-700">Concepto del Documento</label>                                
                        <input type="text" class="form-input w-full" v-model="docConecpt">
                    </div>                                                                        
                </div> 
                <div class="flex h-full justify-around mt-10">         
                     <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Gastos de Importacion </label>
                        <input type="number" class="form-input w-full" v-model="importRise">
                    </div> 
                    <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Pais de Origen </label>
                        <input type="text" class="form-input w-full" v-model="country">
                    </div> 
                </div>             
                <div class="flex h-full justify-around mt-10">         
                     <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Fecha de Emision del Documento </label>
                        <input type="date" class="form-input w-full" v-model="documentDate">
                    </div>              
                    <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Plazo de Pago</label>
                        <select class="form-select w-full" v-model="paymenTerms">                                
                            <option value="CONTADO"> Contado </option>
                            <option value="15 DIAS">15 Dias </option>
                            <option value="30 DIAS">30 Dias </option>
                            <option value="60 DIAS">60 Dias </option>
                        </select>
                    </div>                                               
                </div>
               <!--  <div class="flex h-full justify-around mt-10">
                    <div class="w-2/5 ">
                        <label class="block text-sm font-medium text-gray-700">Porcentaje impuesto DAI </label>
                        <input type="number" class="form-input w-full" v-model="retOne">
                    </div>  
                    <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Tipo de Compra</label>
                        <select class="form-select w-full" v-model="purchasePayingConcept">                                
                            <option value="productos"> Productos </option>
                            <option value="servicios">Servicios </option>
                            <option value="adelanto">Adelanto a Pago </option>
                        </select>
                    </div>                                               
                </div> -->
                <!-- <div class="flex w-full mt-10 justify-around mb-10">                   
                   <div class="w-2/5 ">
                        <label class="block text-sm font-medium text-gray-700">Retencion del 10% </label>
                        <input type="number" class="form-input w-full" v-model="retTen">
                    </div>  
                    <div class="w-2/5">
                        <label class="block text-sm font-medium text-gray-700">Otros Inpuestos</label>
                        <input type="number" v-model="otherTaxes" class="form-input w-full">
                    </div>                                                             
                </div> -->                
            </div>
            <span class="ml-5 mt-10 text-lg">Gastos e Impuestos locales</span>
            <div class="flex justify-between ">
                <div class="h-full flex flex-col overflow-hidden flex-grow w-11/12 my-10 rounded-md  bg-white">                   
                    <div class="flex-col h-full w-full mt-5 px-10"  >                                
                        <div class="rounded-md w-full mx-auto">
                            <table class="max-w-1/2 divide-y divide-gray-200">
                                <thead class="bg-white">
                                <tr>                                    
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                      Impuesto / Gasto
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Porcentaje / Monto
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        tipo 
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        iva 
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                       Opciones
                                    </th>
                                </tr>
                                </thead>
                                <tbody>     
                                <tr class="bg-white hover:bg-gray-100 border-b" v-for="item in taxes"
                                    :key="item.id">                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{item.concept}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                      <span v-if="item.type == 'expense'">$</span> {{item.amount}}  <span v-if="item.type == 'tax'">%</span>
                                    </td> 
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span v-if="item.type == 'expense'">Gasto</span>  <span v-if="item.type == 'tax'">Impuesto</span>
                                    </td>    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span v-if="item.iva">si</span>  <span v-if="!item.iva">no</span>
                                    </td>                         
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex z-40 text-center">                                            
                                            <a @click="delProduct(item.code)"
                                            class="ml-5 cursor-pointer" > <icon class="text-gray-500 hover:text-cyan-700" name='delete-blank'/></a>
                                        </div>
                                    </td>
                                </tr> 
                                <tr class="bg-white hover:bg-gray-100 border-b">                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Contribucion Especial 
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        $ 15.93
                                    </td> 
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Impuesto
                                    </td>  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        si 
                                    </td>                       
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        
                                    </td>
                                </tr>                                     
                                <tr class="bg-white ">                                   
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <input type="text" v-model="taxName" class="form-input w-2/3" name="" id="">
                                    </td>
                                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" v-model="taxAmount" class="form-input w-2/3" name="" id="">
                                    </td> 
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                       <select class="form-select w-full" v-model="taxType">                                
                                            <option value="tax"> Impuesto </option>
                                            <option value="expense">Gasto </option>                                                                               
                                        </select>
                                    </td>  
                                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <select class="form-select w-full" v-model="expenseIva">                                
                                            <option value="1"> Si </option>
                                            <option value="0">No </option>                                                                               
                                        </select>
                                    </td>                                   
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                        <div class="flex  text-center">                                            
                                            <a @click="addTax"
                                            class="ml-5 cursor-pointer" > <icon class="text-gray-500 hover:text-cyan-700" name='add'/></a>
                                        </div>
                                    </td>                                       
                                </tr>                              
                                </tbody>
                            </table>                                
                        </div>                                                                                     
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
                            DAI 
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
                               {{item.daiPercent}}
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
                                 <select class="form-select w-full" v-model="daiPercent">                                
                                    <option value="0"> 0% </option>
                                    <option value="5">5% </option>      
                                    <option value="10"> 10% </option>
                                    <option value="15">15% </option>      
                                    <option value="20"> 20% </option>
                                    <option value="25">25% </option>      
                                    <option value="30"> 30% </option>
                                    <option value="40">40% </option>                                                                               
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
                duca         : null,
                tariff       : null,
                fobTotal     : null,
                country      : null,
                importRise   : null, 
                docConecpt  : null,    
                documentTotal : null,                
                productsStep : false, 
                settingsStep : true,  
                uPrice       : null, 
                quantity     : null, 
                description  : null, 
                code         : null,                
                taxName      : null,
                taxType      : null,
                taxAmount    : null, 
                expenseIva   : null,
                daiPercent   : null,
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
            settings : state => state.ForeignPurchase.settings,
            taxes    : state => state.ForeignPurchase.localTaxes,
            products : state => state.ForeignPurchase.products,
            purchaseTotal : state => state.ForeignPurchase.purchaseTotal,            
            totalNoIva : state => state.ForeignPurchase.total,
           
        })
    }, 
    methods:{

        setData(){
           // this.$store.commit("ForeignPurchase/clearSettings")           
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

        savePurchase(){

              var settings = {
                'supplier'      : this.supplier,               
                'terms'         : this.paymenTerms,
                'docNumber'     : this.docNumber,
                'duca'          : this.duca,
                'tariff'        : this.tariff,
                'fobTotal'      : this.fobTotal,
                'country'       : this.country,
                'importRise'    : this.importRise,                  
                'date'          : this.documentDate,               
                'docConcept'    : this.docConecpt,                                   
              } 
            
            this.$store.commit("ForeignPurchase/addSettings",settings)   
            this.settingsStep = false; 
            this.productsStep = true;          
            
        },
        changeFoil(){
            this.$store.commit("Purchase/changeFoil",this.foil)
        },

        createPurchase(){
            var request = {
                'settings' : this.settings,
                'products' : this.products,
                'taxes'    : this.taxes,               
                'purchaseTotal' : this.purchaseTotal
            }

            this.$inertia.post(route('purchases.saveforeign'),request);
            this.$store.commit("Purchase/clearSettings")
        },

        addProduct(){
            let product = {
                'code'          : this.code, 
                'description'   : this.description, 
                'uPrice'        : this.uPrice, 
                'quantity'      : this.quantity,                
                'total'         : null,  
                'daiPercent'    : this.daiPercent,    
                'dai'           : null,           
            }
            this.$store.commit("ForeignPurchase/addProduct",product)

            this.code = null 
            this.description = null 
            this.uPrice = null 
            this.quantity = null         
        },
        addTax(){
            let tax = {                
                'concept'       : this.taxName,
                'type'           : this.taxType,
                'amount'         : this.taxAmount, 
                'iva'            :this.expenseIva, 
            }
            this.$store.commit("ForeignPurchase/addTax",tax)

            this.taxName = null 
            this.taxType = null 
            this.taxAmount = null             
        },
        delProduct(prodCode){
           
             this.$store.commit("ForeignPurchase/deleteProduct",prodCode)
        },
    }

 }
</script>