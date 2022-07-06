<template>
  <main>

    <div class="container">

      <div class="account-title match-title">
        <h4>Trade Methods</h4>
      </div>
      <div class="row">
        <div class="col-md-12 main-b">
          <div class="row active-card">
            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="card card__one--wrapper text-white mb-4">
                <div class="card-body">
                  <div class="flex__wrapper-two">
                    <div>
                      <p class="card-label-one">Merchant Account</p>
                      <h3 class="card-heading-one">byrdman</h3>
                    </div>
                    <div>
                      <i class="fa fa-credit-card" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="card card__two--wrapper text-white mb-4">
                <div class="card-body">
                  <div class="flex__wrapper-two">
                    <div>
                      <p class="card-label-one">Active Offers</p>
                      <h3 class="card-heading-one">$500.00</h3>
                    </div>
                    <div>
                      <i class="fa fa-credit-card" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="active-details">

            <div class="active-description">

              <div class="no-match-p method">
                <p>Activity more methods will increase your chances of finding a match</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 main-b">
          <div class="row">
            <div class="email-feild">
              <!-- <label for="price"> Amount</label> -->
              <select  v-model="state.user_id" style="width: 100%;padding: 20px;border-radius: 30px;outline: none;border: 1px solid rgb(241, 238, 238);">
                    <option value="">Select User</option>
                    <option v-for="user in users" v-bind:value="user.id" :key="user.id">{{user.username}}</option>
              </select>
              
              <div class="icon"><img :src="'images/user.png'" alt=""></div>
              
            </div>
            <span style="width: 100%; display: flex; justify-content: start; color: red; margin-left: 50px;" v-if="v$.user_id.$error"> 
                {{ v$.user_id.$errors[0].$message }}
              </span>
            <div class="email-feild">
              <!-- <label for="price"> Amount</label> -->
              <input type="number" name="price" id="price" v-model="state.price" placeholder="Amount" required>
              
              <div class="icon"><img :src="'images/user.png'" alt=""></div>
              
            </div>
            <span style="width: 100%; display: flex; justify-content: start; color: red; margin-left: 50px;" v-if="v$.price.$error"> 
                {{ v$.price.$errors[0].$message }}
              </span>
            <div class="col-xl-12 col-md-12 ">

              <div class="no-match-btn con">
                  <div class="btn1"><button class="btn btn-primary" @click="addFunds()">Add Funds</button></div>
                </div>

            </div>
          </div>

        </div>

      </div>

    </div>

  </main>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {
    required,
    helpers
} from "@vuelidate/validators";
import { useRouter,useRoute } from 'vue-router'
import store from '../../stores'
import {
  ref,
    reactive,
    computed,
    onMounted,
    onBeforeMount
} from "vue";
export default {
  name: 'AddFunds',
    setup() {
        const users = ref([])
        const route = useRoute()
        const router = useRouter()
        const user = reactive(store.getters["auth/currentUser"])
        const state = reactive({
            price: '',
            user_id: ''
        })

        const rules =  {
              price: {
                    required: helpers.withMessage('The Amount field is required', required),
                },
              user_id: {
                    required: helpers.withMessage('The User field is required', required),
                },
        }

        
        const v$ = useVuelidate(rules, state)

        onBeforeMount(() => {
                getUsers()
        })

        onMounted(()=>{
                if(user.is_phone_verified === 0)
                {
                    router.push('/verify/phone')
                }
                else if(user.is_email_verified === 0)
                {
                    router.push('/verify/email')
                }
        })


        

        const addFunds = async () => {
                v$.value.$validate();
                if(!v$.value.$error){
                axios.post('add-funds',state)
                    .then((response) => {
                        if(response.data.success == true)
                        {
                            // state.price = '';
                            // state.user_id = '';
                            router.push('/dashboard')
                            Toast.fire({
                                text: response.data.message,
                                timer: 2000,
                                icon: 'success',
                                position: 'top-end',
                            });
                        }
                    })
                }
            }

        const getUsers = async () => {
                axios.get('users',state)
                    .then((response) => {
                        users.value = response.data
                    })
               
            }

        return {
            state,
            v$,
            addFunds,
            users
        }
    },

}
</script>
