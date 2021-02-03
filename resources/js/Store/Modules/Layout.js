import Axios from 'axios'

const getDefaultState = () => {
    return {
       
       menus:[],
       testing : false
    }
}
const state = getDefaultState();

const actions = {
    ActionName({commit}){
        //axios then 
        //commit 
    }
}

const mutations = {
    
    toggleItems(state, item) {      
        state.menus.forEach(element => {
            if(element.title == item.title){               
               element.showing = !element.showing
            }
        });
    },
    addMenu(state,menu){       
        state.menus.push(menu)
    },
    clearMenus(state){       
        state.menus = [];
    }
}


export default {
    namespaced: true,
    state,    
    actions,
    mutations
  }