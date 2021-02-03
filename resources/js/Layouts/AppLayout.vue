<template>
<div class="h-screen flex overflow-hidden bg-white"> 
  <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
  <div class="lg:hidden" v-if="showSidebar">
    <div class="fixed inset-0 flex z-40">
      <!--
        Off-canvas menu overlay, show/hide based on off-canvas menu state.

        Entering: "transition-opacity ease-linear duration-300"
          From: "opacity-0"
          To: "opacity-100"
        Leaving: "transition-opacity ease-linear duration-300"
          From: "opacity-100"
          To: "opacity-0"
      -->
      <div class="fixed inset-0" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
      </div>
      <!--
        Off-canvas menu, show/hide based on off-canvas menu state.

        Entering: "transition ease-in-out duration-300 transform"
          From: "-translate-x-full"
          To: "translate-x-0"
        Leaving: "transition ease-in-out duration-300 transform"
          From: "translate-x-0"
          To: "-translate-x-full"
      -->
      <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-cyan-700">
        <div class="absolute top-0 right-0 -mr-12 pt-2">
          <button @click="showSidebar = !showSidebar" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
            <span class="sr-only">Close sidebar</span>
            <!-- Heroicon name: x -->
            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex-shrink-0 flex items-center px-4">
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/easywire-logo-cyan-300-mark-white-text.svg" alt="Workflow">
        </div>
        <div class="mt-5 flex-1 h-0 overflow-y-auto">
          <nav class="px-2">
            <div class="space-y-1">
              <a href="#" class="bg-cyan-800 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <!-- Current: "text-gray-500", Default: "text-gray-400 group-hover:text-gray-500" -->
                <!-- Heroicon name: home -->
                <svg class="text-cyan-200 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Home
                </a>

                <a href="#" class="text-white hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <!-- Heroicon name: view-list -->
                <svg class="text-cyan-200 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                My tasks
            </a>
            </div>
          </nav>
        </div>
      </div>
      <div class="flex-shrink-0 w-14" aria-hidden="true">
        <!-- Dummy element to force sidebar to shrink to fit close icon -->
      </div>
    </div>
  </div>

  <!-- Static sidebar for desktop -->
  <div class="hidden lg:flex lg:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-gray-200 pt-5 pb-0 bg-cyan-700">
      <div class="flex items-center flex-shrink-0 px-6 bg-white pt-1 pb-1">
        <img class="h-8 mt-1 w-auto" src="/svgs/recurso 3.svg" alt="Workflow">
      </div>
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="h-0 flex-1 flex flex-col overflow-y-auto">
        <!-- User account dropdown -->
        
        <!-- Navigation -->
        <nav class="px-3 mt-10">
          <div class="space-y-1">
              <template v-for="(item, index) in $page.menu">
                  <div class="space-y-1" :key="index" v-if="item.children.length">
                        <button @click="openItems(item)" class="bg-transparent text-white group w-full flex items-center pr-2 py-2 text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <!-- Expanded: "text-gray-400 rotate-90", Collapsed: "text-gray-300" -->
                            <icon name="arrow-right" class="mr-2 h-5 w-5 transform group-hover:text-gray-400 transition-colors ease-in-out duration-150"/>
                            {{ item.title }}
                        </button>
                        <!-- Expandable link section, show/hide based on state. -->

                        <div v-for="menu in menus" :key="menu.title">
                          <div class="space-y-1" v-if="menu.title == item.title && menu.showing">
                              <a :href="route(child.route)" v-for="(child, index) in item.children" :key="index" 
                              :class="route().current(item.active) ? 'bg-cyan-800' : 'bg-transparent'"
                              class="group w-full flex items-center pl-10 pr-2 py-2 text-sm font-medium text-white rounded-md">
                                  <icon class="text-cyan-200 mr-3 h-6 w-6" :name="item.icon"/>
                                  {{ child.title }}
                              </a>
                          </div>
                        </div>
                  </div>
                  <inertia-link v-else :href="route(item.route)"
                    :key="index"
                    :class="route().current(item.active) ? 'bg-cyan-800 text-white' : 'bg-transparent text-white'" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <icon class="text-cyan-200 mr-3 h-6 w-6" :name="item.icon"/>
                        {{ item.title }}
                    </inertia-link>
              </template> 
              <inertia-link v-if="$page.user.role.name == 'accountant' || $page.user.role.name == 'auditor'" :href="route('companies.show',$page.user.current_company)"
                    :class="route().current('companies.show',$page.user.current_company) ? 'bg-cyan-800 text-white' : 'bg-transparent text-white'"
                     class="group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <icon class="text-cyan-200 mr-3 h-6 w-6" name="company"/>
                        Empresa
                    </inertia-link>                              
          </div>
        </nav>
      </div>
      <div class="flex-shrink-0 flex p-4 bg-cyan-800">
        <a  v-if="$page.user.role.name == 'accountant' || $page.user.role.name == 'auditor'" :href="route('dashboard')" class="flex-shrink-0 w-full group block">
        <div class="flex items-center">
            <div>
            <img class="inline-block h-9 w-9 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </div>
            <div class="ml-3">
            <p class="text-sm font-medium text-white">
               {{$page.company.Name}}
            </p>
            <p class="text-sm font-medium text-indigo-200 group-hover:text-white">
               Cambiar Empresa
            </p>
            </div>
        </div>
        </a>
        <a  v-if="$page.user.role.name == 'admon' " :href="route('dashboard')" class="flex-shrink-0 w-full group block">
        <div class="flex items-center">
            <div>
            <img class="inline-block h-9 w-9 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </div>
            <div class="ml-3">
            <p class="text-sm font-medium text-white">
               {{$page.user.name}}
            </p>
            <p class="text-sm font-medium text-indigo-200 group-hover:text-white">
              Editar Perfil
            </p>
            </div>
        </div>
        </a>
    </div>
    </div>
  </div>
  <!-- Main column -->
  <div class="flex flex-col w-0 flex-1 overflow-hidden">
    <!-- Search header -->
    <div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:hidden">
      <!-- Sidebar toggle, controls the 'sidebarOpen' sidebar state. -->
      <button @click="showSidebar = !showSidebar" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-500 lg:hidden">
        <span class="sr-only">Open sidebar</span>
        <!-- Heroicon name: menu-alt-1 -->
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
      </button>
      <div class="flex-1 flex justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex-1 flex">
          <form class="w-full flex md:ml-0" action="#" method="GET">
            <label for="search_field" class="sr-only">Search</label>
            <div class="relative w-full text-gray-400 focus-within:text-gray-600">
              <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                <!-- Heroicon name: search -->
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
              </div>
              <input id="search_field" name="search_field" class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent focus:placeholder-gray-400 sm:text-sm" placeholder="Search" type="search">
            </div>
          </form>
        </div>
        <div class="flex items-center">
          <!-- Profile dropdown -->
          <div class="ml-3 relative">
              <jet-dropdown align="right" width="48">
                <template #trigger>
                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.user.profile_photo_url" :alt="$page.user.name" />
                    </button>
                </template>

                <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        Manage Account
                    </div>

                    <jet-dropdown-link :href="route('profile.show')">
                        Profile
                    </jet-dropdown-link>

                    <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.jetstream.hasApiFeatures">
                        API Tokens
                    </jet-dropdown-link>

                    <div class="border-t border-gray-100"></div>

                    <!-- Team Management -->
                    <template v-if="$page.jetstream.hasTeamFeatures">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Manage Team
                        </div>

                        <!-- Team Settings -->
                        <jet-dropdown-link :href="route('teams.show', $page.user.current_team)">
                            Team Settings
                        </jet-dropdown-link>

                        <jet-dropdown-link :href="route('teams.create')" v-if="$page.jetstream.canCreateTeams">
                            Create New Team
                        </jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Switch Teams
                        </div>

                        <template v-for="team in $page.user.all_teams">
                            <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                <jet-dropdown-link as="button">
                                    <div class="flex items-center">
                                        <svg v-if="team.id == $page.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <div>{{ team.name }}</div>
                                    </div>
                                </jet-dropdown-link>
                            </form>
                        </template>

                        <div class="border-t border-gray-100"></div>
                    </template>

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                        <jet-dropdown-link as="button">
                            Logout
                        </jet-dropdown-link>
                    </form>                    
                </template>
            </jet-dropdown>
          </div>
        </div>
      </div>
    </div>
    <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none bg-gray-100"  tabindex="0">
       <portal-target name="modal" multiple></portal-target>

      <!-- Page title & actions -->
      <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
          <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">              
            <slot name="header-title">
            </slot>
          </h1>
        </div>
        <div class="mt-4 flex sm:mt-0 sm:ml-4 z-10">            
            <button type="button" class=" justify-center w-full rounded-md  shadow-sm px-4 py-2 bg-gray-100 text-lg font-medium text-cyan-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true">
                   <icon class="-mr-1 ml-2 h-7 w-7" name="bell"/>                              
                </button>
             <div class="relative inline-block text-left">
              <div>
                <button @click="toolsDD = !toolsDD" type="button" class=" justify-center w-full rounded-md  shadow-sm px-4 py-2 bg-gray-100 text-lg font-medium text-cyan-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true">
                   <icon class="-mr-1 ml-2 h-7 w-7" name="settings"/>                              
                </button>
              </div>              
              <transition  enter-active-class="transition ease-out duration-100 transform"
                  enter-class="opacity-0 scale-95"
                  enter-to-class="opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75 transform"
                  leave-class="opacity-100 scale-100"
                  leave-to-class="opacity-0 scale-95"
                >
                <div v-if="toolsDD" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                  <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">                  
                     <jet-button @click="logout" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" role="menuitem">
                       Log Out
                    </jet-button>   
                    <a  v-show="$page.user.role.name == 'accountant' || $page.user.role.name == 'auditor'" :href="route('dashboard')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" role="menuitem">
                      Cambiar Empresa
                    </a>   
                                      
                    
                  </div>
                </div>
              </transition>
            </div>
        </div>
      </div>
      <!-- Pinned projects -->      
        <div >
          
          <div class="px-4 mt-6 sm:px-6 lg:px-8 ">
              <slot></slot>
          </div>    
        </div>    
    </main>
  </div>
</div>

</template>
<script>
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import Icon from '@/Shared/Icon'
import JetNavLink from '@/Jetstream/NavLink'
import { mapState, mapActions, mapGetters } from "vuex";
export default {
    components:{
        JetDropdown,
        JetDropdownLink,
        Icon,
        JetNavLink
    },
    data() {
        return {
            showSidebar: false,
            showItems: false,
            activeitem: '',
            menu: [],
            toolsDD : false 
        }
    },
    methods:{
        logout() {
            axios.post(route('logout').url()).then(response => {
                window.location = '/';
            })
        },
        openItems(item){       
           this.$store.commit("Layout/toggleItems", item);
            this.activeitem = item.index
            this.showItems = !this.showItems
        },
        currentItems(item){
            this.menus.forEach(element => {
                if(element.title == item.title){
                  if(element.showing){
                      return true ; 
                  }
                } 
            });
            //return this.activeitem == index && this.showItems
        },
        mapMenus(){
          this.$store.commit("Layout/clearMenus")
          this.$page.menu.forEach(item => {
             var newMenu = {
              title : item.title,
              showing : false, 
             }
              this.$store.commit("Layout/addMenu", newMenu);
          });
        }
    },
    mounted(){
      this.mapMenus();
    },
    computed: {
        ...mapState({           
            menus : state => state.Layout.menus
        })
    },
}
</script>