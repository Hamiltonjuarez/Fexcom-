<template>
    <app-layout>
        <template #header-title>
            Lista de Proveedores
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
                        <a :href="route('providers.index')" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Proveedores</a>
                    </div>
                    </li>                                   
                </ol>
            </nav> 
            <div class="mr-1">               
              <jet-nav-link :href="route('providers.create')">
                  NUEVO PROVEEDOR
              </jet-nav-link>
           </div>         
        </div> 
        <div class="flex flex-col">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">              
                 <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                           codigo
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          nit
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          ncr
                        </th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          nombre
                        </th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                         direccion
                        </th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                         telefono
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                         Actividad Comercial
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wide">
                        Opciones
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="bg-white hover:bg-gray-200 cursor-pointer" v-for="item in providers"
                        :key="item.id">
                        <td class="px-6 py-4  whitespace-nowrap text-sm text-gray-500" @click="showProvider(item.id)">
                          {{item.code}}
                        </td>
                        <td class="px-6 py-4  whitespace-nowrap text-sm text-gray-500" @click="showProvider(item.id)">
                           {{item.nit}}
                        </td>
                        <td class="px-6 py-4  whitespace-nowrap text-sm text-gray-500" @click="showProvider(item.id)">
                          {{item.ncr}}
                        </td>
                         <td class="px-6 py-4  whitespace-nowrap text-sm text-gray-500" @click="showProvider(item.id)">
                            {{item.name}}
                        </td>
                         <td class="px-6 py-4  whitespace-nowrap text-sm text-gray-500" @click="showProvider(item.id)">
                           {{item.address}}
                        </td>  
                        <td class="px-6 py-4  whitespace-nowrap text-sm text-gray-500" @click="showProvider(item.id)">
                           {{item.phone}}
                        </td>   
                        <td class="px-6 py-4  whitespace-nowrap text-sm text-gray-500" @click="showProvider(item.id)">
                           {{item.business_activitie}}
                        </td>                         
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">                          
                            <div class="flex z-40">
                                  <a :href="route('providers.edit',item.id)" 
                                  class="cursor-pointer mr-3" > <icon class="text-gray-500 hover:text-cyan-700" name='edit'/></a>
                                  <a @click="Eliminar(item.id)"
                                  class="cursor-pointer" > <icon class="text-gray-500 hover:text-cyan-700" name='delete-blank'/></a>
                            </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
            </div>
            </div>
        </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import Icon from '@/Shared/Icon'
import JetNavLink from '@/Jetstream/NavLink'
export default {
    data(){
        return{
            
        }
    },components:{
        AppLayout,
        JetNavLink,
        Icon,
    },
    props:['providers'],
    methods:{
        showProvider($provider_id){
            this.$inertia.get(route("providers.show",$provider_id))
        },
        Eliminar($provider_id){
            this.$inertia.delete(route("providers.destroy",$provider_id))
        }
    }
}
</script>