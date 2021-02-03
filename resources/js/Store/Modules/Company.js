import Axios from 'axios'

const getDefaultState = () => {
    return {
       newCompany:{
           nit : null,
           ncr : null, 
           name : null, 
           cname : null, 
           phone : null,
           activity : null, 
           accountant_id : null, 

       },
       accounts:[],
       companyAccountants : [],
       previousType : '',
       accountTypes : [],
       digits : 0,
       company : null,
       serverCompany : null,
       modules : [],
       representative : null,
    }
}


const state = getDefaultState();

const actions = {
    storeCompany({commit, state}){
        axios.post(`/storeCompany`, state.company).then(        
            response => {
            commit('setCreatedCompany', response.data)           
        })
    },
    storeModules({commit, state}){
        axios.post(`/storeModules`, {
            params:{
                modules: state.modules,
                company_id : state.serverCompany.id
            }
        }).then(        
            response => {           
                if(response.status == 200){
                    alert("modulos guardados")
                    commit('setCreatedCompany', response.data)
                }
                      
        })
    },
    storeRepresentative({commit, state}){
      
        axios.post(`/storeRepresentative`, {
            params:{
                representative: state.representative,
                company_id : state.serverCompany.id
            }
        }).then(        
            response => {           
                if(response.status == 200){                             
                    commit('setCreatedCompany', response.data) 
                }
                      
        })
    },
}

//mutations
const mutations = {
    
    updateNit(state, {nit}) {      
      state.newCompany.nit = nit
    },
    updateNcr(state, {ncr}) {      
    state.newCompany.ncr = ncr
    },
    updateName(state, {name}) {      
    state.newCompany.name = name
    },
    updateCname(state, {cname}) {      
    state.newCompany.cname = cname
    },
    updatePhone(state, {phone}) {      
    state.newCompany.phone = phone
    },
    updateActivity(state, {activity}) {      
    state.newCompany.activity = activity
    },
    updateAccountant(state, {accountant_id}) {      
    state.newCompany.accountant_id = accountant_id
    },
    addAcount(state,account){
        state.accounts.push(account)
        function compare(a, b) {
            if (a.code < b.code)
              return -1;
            if (a.code > b.code)
              return 1;
            return 0;
          }
          state.accounts.sort(compare);
    },
    deleteAccount(state,accountCode){      
        state.accounts.forEach(element => {
            if(element.code == accountCode){               
                var index = state.accounts.indexOf(element)
                if(index > -1){
                    state.accounts.splice(index,1)
                }
            }
        });
    },
    cancelAccounts(state){        
        state.accounts = [];       
    },
    cancelCompany(state){
        Object.assign(state, getDefaultState());
    },
    addOperator(state,accountant){
            state.companyAccountants.push(accountant)
    },
    removeAccountant(state,accountantId){
        state.companyAccountants.forEach(element => {
            if(element.accountantId == accountantId){              
                var index = state.companyAccountants.indexOf(element)
                if(index > -1){
                    state.companyAccountants.splice(index,1)
                }
            }
        });
    },
    clearData(state){
        Object.assign(state, getDefaultState());
    },
    setPrevousType(state,previousType){
        state.previousType = previousType
    },

    setCatalogueSetings(state,{digits,types}){
           state.accountTypes = types;
           state.digits = digits;
    },
    saveCompany(state,company){
        state.company = company
    },
    setCreatedCompany(state,company){
        state.serverCompany = company
    },
    saveModules(state,modules){
        state.modules = modules
    },
    saveRepresentative(state,representative){
        state.representative = representative
    },
    clearOperators(state){
        state.companyAccountants = [];
    }
   
}

export default {
    namespaced: true,
    state,    
    actions,
    mutations
  }