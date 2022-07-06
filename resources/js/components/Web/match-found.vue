<template>
  <main>
             <div class="container">
                
                <div class="account-title match-title">
                  <h4>Match Found</h4>
                </div>
                <div class="row">
                  <div class="col-md-12 main-b">
                   
                     <div class="active-details">
                       <div class="management">
                        <img src="assets/img/stay-home.png" alt="">
                       </div>
                       <div class="active-description">
                         <div class="active-info"><p><b>Waiting for {{username}}</b></p></div>
                        
                         <div class="no-match-p"><p>We're waiting for {{username}} to come online</p></div>
                       </div>
                       <div class="mtch-btn"><a href="">{{countDown}}</a></div>
                     </div>
                  </div>
                  
                  
                </div>
                
              </div>
          
            </main>
</template>

<script>
import { ref } from '@vue/reactivity'
import { useRouter } from 'vue-router'
import { onMounted,onBeforeMount,reactive } from '@vue/runtime-core'

export default {
  name: 'match-found',
    setup() {
        const username = ref('')
        const countDown = ref('00:00')
        const router = useRouter()
        const isLogin  = ref(0)

        onMounted(()=>{
                const offer = JSON.parse(localStorage.getItem('matched-offer'));
                  if(offer){
                  axios.post('get-match-offer-user',{offerId:offer.offer.id}).then(response => {
                      localStorage.setItem('matched-offer-user',JSON.stringify(response.data))
                      console.log(response.data)
                      username.value = response.data.username
                      isLogin.value = response.data.isLogin
                  })
                }
                else{
                  router.push('/dashboard')
                }
        })

        onBeforeMount(() =>{
            countDownTimer()
        })
        const countDownTimer = () => {
                const interval = setInterval(function () {
                var d = new Date();
                var seconds = d.getMinutes() * 60 + d.getSeconds(); //convet 00:00 to seconds for easier caculation
                var fiveMin = 60 * 5; //five minutes is 300 seconds!
                var timeleft = fiveMin - seconds % fiveMin; // let's say 01:30, then current seconds is 90, 90%300 = 90, then 300-90 = 210. That's the time left!
                var result = parseInt(timeleft / 60) + ':' + timeleft % 60; //formart seconds into 00:00 
                if(isLogin.value == 1)
                {
                    router.push('/trade-in-process')
                }
                if(result == '0:1')
                {
                    router.push('/match-request')
                }
                countDown.value = result;

            }, 1000)
            }


        return {
            username,
            countDown
        }
    }

}
</script>
