<template>
    <app-layout>
        <v-row class="mt-5">            
            <v-col class="ml-7">
                <span class="text-md-h6"><a class="black--text" :href="route('companies.index')">Empresas</a> /<span class="grey--text">Agregar Proveedor</span></span>
            </v-col>            
        </v-row>
        <v-row>
            <v-col class="ml-14 col-md-3">
                <span class="text-md-h5">Agregar Nueva Empresa</span><br> <br>
                <p class="">Agrega una nueva empresa en el registro de empresas y le asigna un contador a la misma.</p>
            </v-col>
            <v-col class="offset-md-1 col-md-7" justify="center"> 
                <v-card>
                    <!-- <v-row>
                        <v-col>
                            <v-progress-linear
                            color="light-blue"
                            height="20"
                            class="mx-auto"
                            style="width:80%"
                            value="10"
                            striped
                            ></v-progress-linear>
                        </v-col>
                    </v-row> -->
                    <v-row>
                        <v-col class="text-center mt-5 mb-5">
                           
                            <v-btn
                                class="green white--text"
                                small
                                @click="select"
                               >
                                Seleccionar proveedor
                            </v-btn>
                            <v-btn class="blue accent-4 white--text"
                            small
                            >
                                Crear proveedor
                            </v-btn>
                        </v-col>
                    </v-row>
                     <v-divider class="mx-4"></v-divider>
                     <v-row v-if="selectprovider">
                         <v-col class="offset-md-1">   
                             <v-card width="100%" elevation="0" > 
                                 <v-row>
                                     <v-col class="ml-9 col-md-5">
                                        <label for="" class="grey--text mb-1">Seleecione Proveedor</label>
                                        <select name="" id="" style="width:90%; border-bottom:1px solid blue" v-model="request.provider_id">
                                            <option value="" class="grey--text"> Seleccione Contador </option>
                                            <option v-for="item in providers" :value="item.id" :key="item.name" >
                                                {{item.name}}
                                            </option>
                                        </select>
                                     </v-col>
                                      <v-col class="col-md-5">
                                         <v-text-field
                                            label="Digite codigo de cuenta de proveedor " 
                                             prepend-icon="mdi-clipboard-list-outline "      
                                             v-model="request.account"                                                                         
                                            required
                                        ></v-text-field>
                                     </v-col>
                                 </v-row>
                                 <v-row>
                                      <v-col class="ml-9 col-md-5">
                                          <label for="" class="grey--text mb-5">Seleccione inicio de credito</label>
                                          <v-date-picker v-model="request.picker"
                                          color="blue accent-4"></v-date-picker>
                                      </v-col>
                                      <v-col class="col-md-5">
                                           <v-text-field
                                                label="Digite plazo de pago con proveedor " 
                                                prepend-icon="mdi-clock "      
                                                v-model="request.lapse"                                                                         
                                                required
                                            ></v-text-field>
                                      </v-col>
                                 </v-row>
                                 <v-row>
                                     <v-col class="text-right mr-7">
                                         <v-btn class=" mr-3 blue accent-4 white--text" @click="sendprovider">Agregar</v-btn>
                                         <v-btn class="grey lighten-2">Cancelar</v-btn>
                                     </v-col>
                                </v-row>                                
                             </v-card>
                         </v-col>
                     </v-row>
                </v-card>
            </v-col>
        </v-row>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
export default {
    data(){
        return {
            selectprovider:false,
            addprovider:false,           
            request:{
                provider_id: null,
                company_id: this.company.id,
                account: null,
                lapse: null,
                picker:null,
            }
        }
    },
    components:{
        VuetifyAppLayout
    },
    props:['company','providers'],
    methods:{
        select(){
            this.selectprovider = true, 
            this.addprovider = false
        },
        sendprovider(){
            this.$inertia.post(route('companies.storeprovider'),this.request)
        }
    }   
}
</script>