<template>
   <app-layout>
     <template #header-title>
            Lista de Empresas
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
                    <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Empresas</a>
                </div>
                </li>
                
            </ol>
           </nav>
           <div class="mr-1">               
              <jet-nav-link :href="route('companies.create')"
                class="text-white ">
                 NUEVA EMPRESA
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
                           nit
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          ncr
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          razon social
                        </th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          nombre comercial
                        </th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                         telefono
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Opciones
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="bg-white hover:bg-gray-200 cursor-pointer" v-for="item in companies"
                        :key="item.id">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                          {{item.nit}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                           {{item.ncr}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                          {{item.Name}}
                        </td>
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                            {{item.business_name}}
                        </td>
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showCompany(item.id)">
                           {{item.phone}}
                        </td>                         
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                          <!-- <jet-dropdown align="right" with="48">
                              <template #trigger>
                                  <button id="project-options-menu-0" aria-haspopup="true" type="button" class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                  <span class="sr-only">Open options</span>                                 
                                  <icon class="w-5 h-5" name="vertical-dots" />
                                  </button>
                              </template>
                              <template #content>
                              </template>
                          </jet-dropdown> -->
                            <div class="flex z-40">
                                  <inertia-link :href="route('companies.edit',item.id)" 
                                  class="cursor-pointer mr-3" > <icon class="text-gray-500 hover:text-cyan-700" name='edit'/></inertia-link>
                                  <inertia-link @click="Destroy(item.id)"
                                  class="cursor-pointer" > <icon class="text-gray-500 hover:text-cyan-700" name='delete-blank'/></inertia-link>
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
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
export default {
    data(){
        return{

        }
    },
    props:['companies'],
    components:{
        AppLayout,
         JetDropdown,
        JetDropdownLink,
        JetNavLink,
        Icon
    },
    methods:{
        Destroy(companyId){    
          
          let token = document.head.querySelector('meta[name="csrf-token"]');
          window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;     
           axios.delete(route('companies.destroy',companyId)).then(response => {
                var result = response.data 
               if(result == 'ok'){
                 this.$inertia.visit(route('companies.index'))
               }
           });
        },
        showCompany(companyId){
          this.$inertia.visit(route('companies.show',companyId))
        }
    }
}
</script>