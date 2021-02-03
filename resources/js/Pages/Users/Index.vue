<template>
    <app-layout>
        <template #header-title>
            
        </template>
        <!-- This example requires Tailwind CSS v2.0+ -->
          <div class="flex flex-col">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider ">
                          Fecha creación
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="bg-white hover:bg-gray-200 cursor-pointer" v-for="user in users" :key="user.id">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                          {{ user.name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                          {{ user.email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                          {{ user.created_at }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                          <jet-dropdown align="right" with="48">
                              <template #trigger>
                                  <button id="project-options-menu-0" aria-haspopup="true" type="button" class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                  <span class="sr-only">Open options</span>
                                  <!-- Heroicon name: dots-vertical -->
                                  <icon class="w-5 h-5" name="vertical-dots" />
                                  </button>
                              </template>
                              <template #content>
                              </template>
                          </jet-dropdown>
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
import Icon from '@/Shared/Icon'
export default {
    components:{
        JetDropdown,
        JetDropdownLink,
        AppLayout,
        Icon
    },
    props:['users']
}
</script>