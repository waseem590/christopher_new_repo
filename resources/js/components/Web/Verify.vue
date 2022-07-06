<template>
    <main>
        <div class="container">
            <h1 class="mt-4 title-dashboard">Dashboard</h1>


            <div class="row">
                <div class="col-md-12 main-b">
                    <div class="row active-card">
                        <div class="col-xl-3 col-md-4 col-sm-4">
                            <div class="card card__one--wrapper text-white mb-4">
                                <div class="card-body">
                                    <div class="flex__wrapper-two">
                                        <div>
                                            <p class="card-label-one">Available Credit</p>
                                            <h3 class="card-heading-one">$0.00</h3>
                                        </div>
                                        <div>
                                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-4 col-sm-4">
                            <div class="card card__two--wrapper text-white mb-4">
                                <div class="card-body">
                                    <div class="flex__wrapper-two">
                                        <div>
                                            <p class="card-label-one">Active Offers</p>
                                            <h3 class="card-heading-one">$0.00</h3>
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
                        <div class="active-title">
                            <h1>Active Offers</h1>
                        </div>

                        <div class="active-description">
                            <div class="active-info">
                                <p>You don't have active offer</p>
                            </div>

                            <a href="" disabled>
                                <div class="active-btn"><a href="">Create New Offer</a></div>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 main-b">
                    <div class="row">

                        <div class="col-xl-12 col-md-12 ">
                            <div class="active-title-2">
                                <h1>Activity</h1>
                            </div>
                            <div class="graph__wrapper-width">
                                <div class="hide-cancel">
                                    <div class="hide-detail">
                                        <input type="checkbox" name="" id="">
                                        <p>Hide canceled Trades</p>
                                    </div>
                                </div>
                                <div class="acivity-details">
                                    <div class="activity-info">
                                        <div class="activity-shop">
                                            <div class="activity-icon"><i class="fa fa-shopping-cart"
                                                    aria-hidden="true"></i></div>
                                            <div class="activity-name">eoaoela</div>
                                        </div>
                                        <div class="activity-shop">
                                            <div class="activity-date">11.05.2022</div>
                                            <div class="activity-time">12:00pm</div>
                                        </div>
                                        <div class="activity-shop">
                                            <div class="acivity-price">$500.00</div>
                                            <div class="activity-next-icon"><a href="#"><i class="fa fa-chevron-right"
                                                        aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div v-if="phonePopup === 0" class="overlay1">
            <div class="popup_phone">
                <h2>Mobile confirmation</h2>
                <div class="edit">
                    <div class="row">
                        <div class="col-sm-6 we">
                            <p class="mb-0">We sent code to</p>
                            <h6>{{phone}}</h6>
                        </div>
                        <div class="col-sm-6 edit_link">
                            <router-link class="btn_link" to="/account-setting">Edit</router-link>
                        </div>
                    </div>
                </div>

                <div class=" col-sm-12 code">
                    <h3>Enter Your Code</h3>
                    <form class="code_form">

                        <input type="number" v-model="phoneCode.p1" ref="pi1"  @input="changePhoneTab(2)" maxlength="1" placeholder="-" required="">
                        <input type="number" v-model="phoneCode.p2" ref="pi2"  @input="changePhoneTab(3)" maxlength="1" placeholder="-" required="">
                        <input type="number" v-model="phoneCode.p3" ref="pi3"  @input="changePhoneTab(4)" maxlength="1" placeholder="-" required="">
                        <input type="number" v-model="phoneCode.p4" ref="pi4"  @input="changePhoneTab(5)" maxlength="1" placeholder="-" required="">
                        <input type="number" v-model="phoneCode.p5" ref="pi5"  @input="changePhoneTab(6)" maxlength="1" placeholder="-" required="">
                        <input type="number" v-model="phoneCode.p6" ref="pi6"  @input="changePhoneTab(1)" maxlength="1" placeholder="-" required="">

                    </form>
                    <h6 style="color: red;" v-if="v$.$error">
                            {{ v$.$errors[0].$message }}
                    </h6>
                    <h6>Expires in 5 minutes</h6>


                </div>
                <div class="pop-btn">

                    <div class="box1">
                        <a class="Verify" @click.prevent="verifyPhone()">Verify</a>
                    </div>
                    <div class="box1">
                        <a class="Resend" @click.prevent="resendPhoneOTP()">Resend Code</a>
                    </div>
                    <div class="box1 text-center">
                        <a class="Log Out" @click.prevent="logout()">Log Out</a>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="emailPopup === 0" class="overlay2">
            <div class="popup_phone">
                <h2>Email confirmation</h2>
                <div class="edit">
                    <div class="row">
                        <div class="col-sm-6 we">
                            <p class="mb-0">We sent code to</p>
                            <h6>{{email}}</h6>
                        </div>
                        <div class="col-sm-6 edit_link">
                            <router-link class="btn_link" to="/account-setting">Edit</router-link>
                        </div>
                    </div>
                </div>

                <div class=" col-sm-12 code">
                    <h3>Enter Your Code</h3>
                    <form class="code_form">

                        <input type="number" v-model="emailCode.e1" @input="changeTab(2)" ref="ei1" maxlength="1" placeholder="-" required="">
                        <input type="number" v-model="emailCode.e2" ref="ei2"  @input="changeTab(3)" maxlength="1" placeholder="-" required="">
                        <input type="number" v-model="emailCode.e3" ref="ei3"  @input="changeTab(4)" maxlength="1" placeholder="-" required="">
                        <input type="number" v-model="emailCode.e4" ref="ei4"  @input="changeTab(5)" maxlength="1" placeholder="-" required="">
                        <input type="number" v-model="emailCode.e5" ref="ei5"  @input="changeTab(6)" maxlength="1" placeholder="-" required="">
                        <input type="number" v-model="emailCode.e6" ref="ei6"  @input="changeTab(1)" maxlength="1" placeholder="-" required="">

                    </form>
                    <h6 style="color: red;" v-if="v1$.$error">
                            {{ v1$.$errors[0].$message }}
                    </h6>
                    <h6>Expires in 5 minutes</h6>


                </div>
                <div class="pop-btn">

                    <div class="box1">
                        <a class="Verify" @click.prevent="verifyEmail()">Verify</a>
                    </div>
                    <div class="box1">
                        <a class="Resend" @click.prevent="resendEmailOTP()">Resend Code</a>
                    </div>
                    <div class="box1 text-center">
                        <a class="Log Out" @click.prevent="logout()">Log Out</a>
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
    import {
        onMounted,
        ref,
        reactive
    } from 'vue'
import store from '../../stores'
import { useRouter } from 'vue-router'
    export default {
        name: 'Verify',
        setup() {

            const phoneCode = reactive({
                    p1 : '',
                    p2  : '',
                    p3 : '',
                    p4  : '',
                    p5 : '',
                    p6  : '',
            })

            const emailCode = reactive({
                    e1 : '',
                    e2  : '',
                    e3 : '',
                    e4  : '',
                    e5 : '',
                    e6  : '',
            })

            const pi1 = ref(null)
            const pi2 = ref(null)
            const pi3 = ref(null)
            const pi4 = ref(null)
            const pi5 = ref(null)
            const pi6 = ref(null)

            const ei1 = ref(null)
            const ei2 = ref(null)
            const ei3 = ref(null)
            const ei4 = ref(null)
            const ei5 = ref(null)
            const ei6 = ref(null)
            
            const phonePopup = ref(1)
            const emailPopup  = ref(1)
            const phone = ref(store.getters['auth/currentUser'].phone)
            const email  = ref(store.getters['auth/currentUser'].email)
            const router = useRouter()
            const user = reactive(store.getters['auth/currentUser'])
            const rules =  {
              p1: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
              p2: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
              p3: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
              p4: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
              p5: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
              p6: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
            }
            const rules1 =  {
              e1: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
              e2: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
              e3: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
              e4: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
              e5: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
              e6: {
                    required: helpers.withMessage('Fill OTP Correctly.', required),
                },
            }
            
            const v$ = useVuelidate(rules, phoneCode)
            const v1$ = useVuelidate(rules1, emailCode)
            
            onMounted(() => {
                    if( user.is_phone_verified === 0 )
                    {
                        phonePopup.value = 0;
                        emailPopup.value = 1;
                    }
                    else if( user.is_email_verified === 0 )
                    {
                        phonePopup.value = 1;
                        emailPopup.value = 0;
                        // ei1.value.focus()
                    }
                    else
                    {
                        router.push('/dashboard')
                    }
            })

            const resendPhoneOTP = () => {
                axios.post('send-phone-verification-code').then((response) => {
                    Toast.fire({
                            text: response.data.message,
                            timer: 3000,
                            icon: 'success',
                            position: 'top-end',
                        });
                })
            } 

            const verifyPhone = () => {
                v$.value.$validate()
                if (!v$.value.$error) {
                const str = '';
                const OTP = str.concat(phoneCode.p1) + str.concat(phoneCode.p2) + str.concat(phoneCode.p3) +
                            str.concat(phoneCode.p4) + str.concat(phoneCode.p5) + str.concat(phoneCode.p6);
                
                axios.post('verify-phone-verification-code',{code : OTP}).then((response) => {
                    if(response.data.success == true)
                    {
                        Toast.fire({
                                text: response.data.message,
                                timer: 3000,
                                icon: 'success',
                                position: 'top-end',
                            });
                        updatePhone();
                        router.push('/dashboard');
                    }
                    else
                    {
                        Toast.fire({
                                text: response.data.message,
                                timer: 3000,
                                icon: 'error',
                                position: 'top-end',
                            });
                    }
                })
                }
            } 
            
            const resendEmailOTP = () => {
                axios.post('send-email-verification-code').then((response) => {
                    Toast.fire({
                            text: response.data.message,
                            timer: 3000,
                            icon: 'success',
                            position: 'top-end',
                        });
                })
            } 

            const verifyEmail = () => {
                v1$.value.$validate()
                if (!v1$.value.$error) {
                const str = '';
                const OTP = str.concat(emailCode.e1) + str.concat(emailCode.e2) + str.concat(emailCode.e3) +
                            str.concat(emailCode.e4) + str.concat(emailCode.e5) + str.concat(emailCode.e6);
                
                axios.post('verify-email-verification-code',{code : OTP}).then((response) => {
                    if(response.data.success == true)
                    {
                        Toast.fire({
                                text: response.data.message,
                                timer: 3000,
                                icon: 'success',
                                position: 'top-end',
                            });
                        updateEmail();
                        router.push('/dashboard');
                    }
                    else
                    {
                        Toast.fire({
                                text: response.data.message,
                                timer: 3000,
                                icon: 'error',
                                position: 'top-end',
                            });
                    }
                })
                }
            }  

            const updatePhone = () => {
                    localStorage.removeItem("currentUser");
                    user.is_phone_verified = 1;
                    const strUser = JSON.stringify(user);
                    localStorage.setItem("currentUser",strUser);
                    store.commit("auth/setCurrentUser",user);
                    router.push('/dashboard');
                }
            const updateEmail = () => {
                    localStorage.removeItem("currentUser");
                    user.is_email_verified = 1;
                    const strUser = JSON.stringify(user);
                    localStorage.setItem("currentUser",strUser);
                    store.commit("auth/setCurrentUser",user);
                    router.push('/dashboard');
                }

            const changeTab = (el) => {
                    switch (el) {
                        case 2:
                            var n =  emailCode.e1;
                            var digits = (""+n).split("");
                            for (let index = 1; index <= digits.length; index++) {
                                emailCode['e'+index] = '';
                                emailCode['e'+index] = digits[index-1];
                            }
                            ei2.value.focus()
                            break;
                        case 3:
                            ei2.value = '';
                            ei3.value.focus()
                            break;
                        case 4:
                            ei3.value = '';
                            ei4.value.focus()
                            break;
                        case 5:
                            ei4.value = '';
                            ei5.value.focus()
                            break;
                        case 6:
                            ei5.value = '';
                            ei6.value.focus()
                            break;
                        case 1:
                            ei6.value = '';
                            ei1.value.focus()
                            break;
                    
                        default:
                            ei1.value.focus()
                            break;
                    }
                }
                
            const changePhoneTab = (el) => {
                    switch (el) {
                        case 2:
                            var n =  phoneCode.p1;
                            var digits = (""+n).split("");
                            for (let index = 1; index <= digits.length; index++) {
                                phoneCode['p'+index] = '';
                                phoneCode['p'+index] = digits[index-1];
                            }
                            pi2.value.focus()
                            break;
                        case 3:
                            pi2.value = '';
                            pi3.value.focus()
                            break;
                        case 4:
                            pi3.value = '';
                            pi4.value.focus()
                            break;
                        case 5:
                            pi4.value = '';
                            pi5.value.focus()
                            break;
                        case 6:
                            pi5.value = '';
                            pi6.value.focus()
                            break;
                        case 1:
                            pi6.value = '';
                            pi1.value.focus()
                            break;
                    
                        default:
                            pi1.value.focus()
                            break;
                    }
                }

            const logout = () => {
                    localStorage.removeItem("currentUser");
                    store.commit("auth/removeCurrentUser");
                    router.push({name:'login'});
                }

            return {
                phone,
                email,
                phonePopup,
                emailPopup,
                resendPhoneOTP,
                resendEmailOTP,
                logout,
                verifyPhone,
                verifyEmail,
                phoneCode,
                emailCode,
                v$,
                v1$,
                changeTab,
                changePhoneTab,
                ei1,
                ei2,
                ei3,
                ei4,
                ei5,
                ei6,
                pi1,
                pi2,
                pi3,
                pi4,
                pi5,
                pi6,
            }
        }
    }

</script>
<style>
.overlay1 {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.7);
    transition: opacity 500ms;
    visibility: visible;
    opacity: 1;
} 
.overlay2 {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.7);
    transition: opacity 500ms;
    visibility: visible;
    opacity: 1;
}          
 .popup_phone {
    margin: 70px auto;
    padding: 50px;
    background: #fff;
    border-radius: 5px;
    width: 545px;
     height:565;
    position: relative;
}         
 .popup_phone h2 {
    margin-top: 0;
    color: #333;
    text-align: left;
    font-size: 20px;
}
          
 .popup_phone h3 {
    margin-top: 0;
    color: #333;
    text-align: center;
    font-size: 20px;
     padding: 10px 0px 10px 0px
}
 .popup_phone .close {
    position: absolute;
    top: 20px;
    right: 30px;
    transition: all 200ms;
    font-size: 30px;
    font-weight: bold;
    text-decoration: none;
    color: #333;
}  
          we p{
    font-size:14px;
    font-weight: 400;
    text-decoration: none;
    color: #949494;
          }
          .edit {
              background-color: #eeeeee;
                  padding: 10px 20px 10px 20px;
              border-radius: 5px;
          }
          
          .edit_link{
              text-align: right;
                  padding-top: 12px;
          } 
          
          .edit_link a{
              color: #15b0b1;
          }
 .trade-feild input {
    padding: 15px !important;
}

.code input {
        width: 53px;
    height: 50px;
    padding: 11px;
    border-radius: 10px;
    outline: none;
    border: 1px solid #bfbfbf;
    margin-left: 10px;
}
.code_form {
 display: flex;
justify-content: center;
          }
.code h3{
 text-align: center
          }           
      .code code_form{
              text-align: center
          }
          .code{
              width: 100%
          }          
 .code h6{
     font-size: 14px;
    font-weight: 300;
     color: ##a3a3a3;
     text-align:center;
     padding: 10px 0px 10px 0px
     
          } 
 .Verify {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 60px;
    background: #e6e6e6;
    border-radius: 4px;
    text-decoration: none;
    color: #b1b1b1;
    font-size: 20px;
    font-weight: 500;
    border-radius: 10px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease-out;
    width: 350px;
    margin: auto;
}         
 .Verify:hover {
    background-color: transparent;
    border: 1px solid #e6e6e6;
    transition: all .5s ease-in-out;
    color: #adadad;
    text-decoration: none;
}         
  .Resend {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 60px;
    background: transparent;
    border-radius: 4px;
    text-decoration: none;
    color: #00aaab;
    font-size: 20px;
    font-weight: 500;
    border: 1px solid #00aaab;
    border-radius: 10px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease-out;
    width: 350px;
    margin: auto;
}         
 .Resend:hover {
    background-color: transparent;
    border: 1px solid #e6e6e6;
    transition: all .5s ease-in-out;
    color: #adadad;
    text-decoration: none;
}         
          
  @media(min-width:320px) and (max-width:575px) {
	  .popup_phone
	  {
		  width: 98%;
		  padding-left: 43px;
	  }
	 .Verify {

    width: 80%;
}
	  .Resend
	   {

    width: 80%;
		   padding: 12px 12px;
}
		  }
.code input {
    width: 53px;
    height: 50px;
    padding: 11px;
    border-radius: 10px;
    outline: none;
    border: 1px solid #bfbfbf;
    margin-left: 10px;
    text-align: center;
}
       /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}   
     </style>