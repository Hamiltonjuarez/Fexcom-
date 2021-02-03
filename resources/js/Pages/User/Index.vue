<template>
    <app-layout>
        <template #header-title>
            Usuarios
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
                        <!-- Heroicon name: chevron-right -->
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a :href="route('users.index')" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Usuarios</a>
                    </div>
                    </li>                 
                </ol>
                </nav>
                <div class="mr-1">               
                    <jet-nav-link :href="route('users.create')" >
                        Nuevo Usuario
                    </jet-nav-link>
                </div>          
            </div>
          <div class="flex flex-col mt-10">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          Correo
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                          Fecha creación
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                         Opciones
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="bg-white hover:bg-gray-200 cursor-pointer" v-for="user in users" :key="user.id">
                        <td class="px-6 py-4  whitespace-nowrap text-sm text-gray-500" @click="showUser(user.id)">
                          {{ user.name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showUser(user.id)">
                          {{ user.email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" @click="showUser(user.id)">
                          {{ user.created_at }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" >
                            <div class="flex z-40">
                                <a :href="route('users.edit',user.id)" 
                                class="cursor-pointer mr-3" > <icon class="text-gray-500 hover:text-cyan-700" name='edit'/></a>
                                <a :href="route('users.edit',user.id)"
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
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import Icon from '@/Shared/Icon'
export default {
    components:{
        JetDropdown,
        JetDropdownLink,
        AppLayout,
        Icon,
        JetNavLink
    },
    props:['users'],

    methods:{
      showUser(userId){
        this.$inertia.visit(route('users.show',userId));
      }
    }
}
</script>