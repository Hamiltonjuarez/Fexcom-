import Axios from 'axios'

const getDefaultState = () => {
    return {
      products : [],
      settings : null,
      localTaxes :[],
      total : 0,
      totaliva : 0, 
      iva : 0,
      purchaseTotal : 0,      
      newFoil : false, 
    }
}


const state = getDefaultState();

const actions = {
   
}

//mutations
const mutations = {

    addTax(state,tax){

        var amount = 0;       
        if(tax.type == 'tax'){
            var isTax = String(tax.amount);            
            if(!isTax.includes('.')){
              tax.amount = tax.amount / 100 
            }            
        }
        state.localTaxes.push(tax);      
    },
    
    addProduct(state, product) { 

      var mul = product.quantity * product.uPrice
      var fixed = mul.toFixed(2)
      product.daiPercent =   product.daiPercent * 0.01;
      product.dai = (mul * product.daiPercent) + mul



      product.total = fixed 
      var sumatory = parseFloat(+state.total + +product.total)
      state.total = sumatory.toFixed(2)
      var totalSumatory = parseFloat(+state.purchaseTotal + +product.total)
      state.purchaseTotal = totalSumatory.toFixed(2)

      state.products.push(product)
    },

    addSettings(state, settings){
      console.log(settings);
        state.settings = settings
    },

    clearSettings(state){
      Object.assign(state, getDefaultState());
    },
    deleteProduct(state,prodCode){
      state.products.forEach(element => {
        if(element.code == prodCode){               
            var index = state.products.indexOf(element)
            if(index > -1){
                var purTotal = +state.purchaseTotal - +element.total
                state.purchaseTotal = purTotal.toFixed(2)           
              
               state.products.splice(index,1)                
            }
        }
    });
    },

    addIva(state,iva){
      state.ivaType = iva
    },

    changeFoil(state,foil){
      state.settings.foil = foil
      state.newFoil = true 
    }

    
   
}

export default {
    namespaced: true,
    state,    
    actions,
    mutations
  }