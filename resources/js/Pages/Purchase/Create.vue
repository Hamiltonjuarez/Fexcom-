<template>
    <app-layout>
        <div class="fixed z-20 inset-0 overflow-y-auto" v-show="modal">
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
                                <span class="text-gray-600 text-md">Agregar Productos a Compra</span>
                            </div>                           
                                <div class="col-span-6 sm:col-span-6  mt-5" >
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="email_address" class="block text-sm font-medium text-gray-700">Codigo de Producto </label>
                                            <input type="text" v-model="prodCode" autocomplete="email" class="form-input w-full">
                                       </div>                                       
                                        <div class="col-span-3">
                                            <label for="email_address" class="block text-sm font-medium text-gray-700">Cantidad </label>
                                            <input type="number" v-model="quantity" autocomplete="email" class="form-input w-full">
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="email_address" class="block text-sm font-medium text-gray-700">Precio Unitario </label>
                                            <input type="number" v-model="uPrice" autocomplete="email" class="form-input w-full">
                                       </div>                                                                                                                                                                  
                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="email_address" class="block text-sm font-medium text-gray-700">Descripcion de Producto </label>
                                            <textarea type="text" v-model="description" autocomplete="email" class="form-input w-full"></textarea>
                                        </div>                          
                                        <div class="col-span-6 sm:col-span-3 sm:col-start-4 mt-10 mb-15">
                                            <button type="button" @click="modal = !modal" class="text-xs mr-3 bg-gray-400 text-white font-bold rounded border-b-2  hover:bg-gray-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                                <span class="mr-2">CANCELAR</span>                                                               
                                            </button> 
                                            <button type="button" @click="addProduct"  class="text-white font-bold bg-gray-600 rounded border-b-2  hover:bg-cyan-700
                                             text-xs hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                                <span class="mr-2">AGREGAR</span>                                                               
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
           <div class="mr-1">            
             
               <a   @click="cancelPurchase"
                class="text-xs mr-3 bg-gray-400 text-white font-bold cursor-pointer mr-3
                rounded border-b-2  hover:bg-gray-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                 CANCELAR COMPRA
              </a>               
           </div>
       </div>
       <div class="w-full h-full  pt-3 overflow-y-auto flex ">
           <div class="w-2/6 mt-5 pl-10">
               <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Crear una nueva compra</h3>
                    <p class="mt-1 text-sm text-gray-600">
                      Ingrese los datos generales para crear una nueva compra, luego ingrese los productos/servicios 
                      que iran incluidos en esta compra. 
                    </p>  
                     <div class="mt-10 ">
                        <span class="text-gray-500"> Tipo de documento:  </span> <span>{{docType.name}}</span> <br>
                        <span class="text-gray-500"> Tipo de IVA:  </span> <span>{{purchase.iva}}</span> <br>
                        <span class="text-gray-500"> Proveedor:  </span> <span>{{supplier.name}}</span> <br>
                        <span class="text-gray-500"> NCR:  </span> <span>{{supplier.ncr}}</span> <br>
                         <span class="text-gray-500"> Numero de Folio/Serie:  </span> <span>{{supplier.active_foil}}</span> <br>
                         <span class="text-gray-500"> Fecha de emision:  </span> <span>{{purchase.date}}</span> <br>
                         
                     </div>                 
                </div>
           </div>
           <div class="h-full flex flex-col flex-grow w-4/6 my-5 rounded-md ml-10 bg-white shadow-md">                        
                <div class="flex item-right w-full justify-between" >     
                     <div class="mt-5">
                        <span class="ml-5 font-bold text-lg">Productos de la Compra</span>
                    </div>               
                    <div class="mt-5 mr-5 text-right">
                        <a @click="modal = !modal"
                            class="text-white cursor-pointer font-bold bg-gray-600 rounded border-b-2  hover:bg-cyan-700
                            text-xs hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                            AGREGAR PRODUCTO 
                        </a>                               
                    </div>                           
                </div>
                <div class="flex justify-around" v-if="products.length == 0" >
                   <div class="mt-18">
                       <img
                        src="/svgs/no-products.svg"
                        class="w-1/3 mx-auto h-64"
                        alt=""
                        />
                        <h4 class="text-gray-500 font-semibold text-center">
                            Agregar Productos a la Compra
                        </h4>
                   </div>
                </div>
                <div class="flex w-full" v-if="products.length != 0" >            
                    <div class="w-full h-screen mt-10 mx-5">                                    
                       <div class="rounded-md  border border-solid mx-auto">
                            <table class="min-w-full divide-y w-full divide-gray-200">
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
                                    total 
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Opciones
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="bg-white hover:bg-gray-100" v-for="item in products"
                                    :key="item.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{item.prodCode}}
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
                                    {{item.total}}
                                    </td>                         
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                         <div class="flex z-40 text-center">                                            
                                            <a @click="delProduct(item.prodCode)"
                                            class="ml-5 cursor-pointer" > <icon class="text-gray-500 hover:text-cyan-700" name='delete-blank'/></a>
                                        </div>
                                    </td>
                                </tr>                               
                                </tbody>
                            </table> 
                             <div class="flex w-full my-5 border-t pt-3">
                                <span class="w-4/5 ml-7">TOTAL </span>
                                <span class="w-1/5 mr-20"> $ {{purchaseTotal}} </span>
                            </div>                                 
                        </div> 
                         <div class=" text-right pb-20 mt-10 mb-10 ">
                           <jet-button @click.native="createPurchase" >crear venta </jet-button>
                        </div>                                                           
                    </div>
                </div>                               
           </div>
       </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import Icon from '@/Shared/Icon';
import { mapState, mapActions, mapGetters } from "vuex";
import JetButton from '@/Jetstream/Button';
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
/* import LocalPurchases from '../../Purchases/LocalPurchases' */
export default {
    data(){
        return{
            modal:false,
            quantity:null,
            uPrice: null,
            description: null,           
            documentType : null,
            documentDate : null,      
            prodCode    : null,     
         


        }
    },
    props:['supplier','purchase','docType'],
     computed:{
        ...mapState({            
            products  : state => state.Purchase.products,
            settings : state  => state.Purchase.settings,
            purchaseTotal : state => state.Purchase.purchaseTotal,
            totaliva : state => state.Purchase.totaliva,
            totalNoIva : state => state.Purchase.total,
            productsIva : state => state.Purchase.iva,
        })
    },
    components:{
        AppLayout,
        Icon,
        JetButton,
        vSelect
        /* LocalPurchases */
    },

    mounted(){
        //this.clearSettings();
        this.setSettings();
    },
    methods:{       
       
        addProduct(){                 
           let product = {
               'quantity'  : this.quantity,
               'uPrice'     : this.uPrice,
               'description' : this.description,              
               'prodCode'   : this.prodCode,
               'total'      : null,            
           }

           this.$store.commit("Purchase/addProduct",product);

           this.quantity = null;
           this.uPrice = null;
           this.description = null;          
           this.modal = !this.modal;

            
        },

        clearSettings(){
            this.$store.commit("Purchase/clearSettings")
            this.settingsStep = 'processing'
            this.productsStep = 'pending'
        },

        setSettings(){
            if(this.ivaType == null){
               this.$store.commit('Purchase/addIva',this.purchase.iva);

            }
        },
        delProduct(prodCode){
             this.$store.commit("Purchase/deleteProduct",prodCode)
        },
        createPurchase(){
            let request = {
                'products'      : this.products,
                'purchaseTotal' : this.purchaseTotal,
                'totaliva'      : this.totaliva,
                'totalNoIva'    : this.totalNoIva,
                'iva'           : this.productsIva,
                'purchase'      : this.purchase
            }
            this.$store.commit("Purchase/clearSettings")
            this.$inertia.post(route('purchases.store'),request)
            
        },
        changeDoc(){
           this.clearSettings();
        },
        cancelPurchase(){
            this.clearSettings();
            this.$inertia.get(route('purchases.index'))
        }

    }
}
</script>