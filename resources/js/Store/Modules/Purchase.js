import Axios from 'axios'

const getDefaultState = () => {
    return {
      products : [],
      settings : null,
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
    
    addProduct(state, product) { 
      
     if(product.iva == 'excento' || product.iva == 'excluido' ){       
       var mul = product.quantity * product.uPrice
       var fixed = mul.toFixed(2)
      product.total = fixed 
      var sumatory = parseFloat(+state.total + +product.total)
      state.total = sumatory.toFixed(2)
      var totalSumatory = parseFloat(+state.purchaseTotal + +product.total)
      state.purchaseTotal = totalSumatory.toFixed(2)

     }else{       
       var mul =  product.quantity * product.uPrice      
       var iva = mul * 0.13   
       
       var fixed = (mul + iva ).toFixed(2);
       product.total = fixed;
       var sumatory = parseFloat(+state.totaliva + +product.total)
       state.totaliva = sumatory.toFixed(2)
       var productIva = parseFloat(+state.iva + +iva)
       state.iva = productIva
       var totalSumatory = parseFloat(+state.purchaseTotal + +product.total  )
       state.purchaseTotal = totalSumatory.toFixed(2)
     }
      state.products.push(product)
    },

    addSettings(state, settings){
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
              if(element.iva != 'gravado'){
                sub = + state.total - +element.total
                state.total = sub.toFixed(2)
                
              }else{
                var sub = +state.totaliva - +element.total
                state.totaliva = sub.toFixed(2)
              }
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