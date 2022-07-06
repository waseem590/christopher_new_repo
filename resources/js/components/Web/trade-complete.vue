<template>
    <main>
             <div class="container">
                
                <div class="account-title match-title">
                  <h4>Trade Complete</h4>
                </div>
                <div class="row">
                  <div class="col-md-12 main-b">
                   
                     <div class="active-details">
                       <div class="management">
                        <img src="assets/img/presentation.png" alt="">
                       </div>
                       <div class="active-description">
                         <div class="active-info"><p><b>Trade Complete</b></p></div>
                         <div class="active-info"><p><b class="price-bold">${{state.price}}</b></p></div>
                         <div class="no-match-p"><p>Credited back to your merchant account</p></div>
                       </div>
                     </div>
                  </div>
                  <div class="col-md-12 main-b">
                    <div class="row">
                     <div class="experiance-box">
                       <div class="experi-details">
                         <b class="experi-data">How was your experience with ealanaj?</b>
                       </div>
                       <div class="ealanaj-icon">
                         <div class="sad1"><img src="assets/img/happiness.png" alt=""></div>
                         <div class="sad2"><img src="assets/img/sad2.png" alt=""></div>
                       </div>
                     </div>
                    </div>
                  
                  </div>
                  
                </div>
                
              </div>
          
            </main>
</template>
<script>
import { onMounted, reactive } from 'vue'
export default {
    name: 'trade-complete',
    setup(){
        const state = reactive({
            username : '',
            price : '',
        })

        onMounted(()=>{
                const offer = JSON.parse(localStorage.getItem('matched-offer'));
                if(offer){
                  axios.post('get-match-offer-user',{offerId:offer.offer.id}).then(response => {
                      localStorage.setItem('matched-offer-user',JSON.stringify(response.data))
                      state.username = response.data.username
                      state.price = offer.offer.price
                  })
                }
        })

        return {
            state
        }
    }
}
</script>